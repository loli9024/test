function like(button) {
    
    if(userLogged==null ||userLogged=='' ) {
        alert("Please, sign in to complete this action");
        return;
    }

    $.post(baseURL+"watch/likes", {videoId: videoId, userLogged: userLogged})
        .done(function(data) {
        
        var likeButton = $(button);
        var dislikeButton = $(button).siblings(".dislikeButton");

        likeButton.addClass("active");
        dislikeButton.removeClass("active");

        var result = JSON.parse(data);
        

        
        if(result.likes < 0) {
            likeButton.removeClass("active");
            likeButton.find("img:first").attr("src", baseURL+"assets/images/like.png");
        }
        else {
            likeButton.find("img:first").attr("src", baseURL+"assets/images/like-active.png")
        }
        updateLikesValue(likeButton.find(".text"), result.likes);
        updateLikesValue(dislikeButton.find(".text"), result.dislikes);

        dislikeButton.find("img:first").attr("src", baseURL+"assets/images/dislike.png");
    });
}

function dislike(button) {
    
    if(userLogged==null ||userLogged=='' ) {
        alert("Please, sign in to complete this action");
        return;
    }

    $.post(baseURL+"watch/dislikes", {videoId: videoId, userLogged: userLogged})
        .done(function(data) {

            var dislikeButton = $(button);
            var likeButton = $(button).siblings(".likeButton");
    
            dislikeButton.addClass("active");
            likeButton.removeClass("active");
    
            var result = JSON.parse(data);
            
        
        if(result.dislikes < 0) {
            dislikeButton.removeClass("active");
            dislikeButton.find("img:first").attr("src", baseURL+"assets/images/dislike.png");
        }
        else {
            dislikeButton.find("img:first").attr("src", baseURL+"assets/images/dislike-active.png")
        }
        updateLikesValue(likeButton.find(".text"), result.likes);
        updateLikesValue(dislikeButton.find(".text"), result.dislikes);
        likeButton.find("img:first").attr("src", baseURL+"assets/images/like.png");

    });
}

function updateLikesValue(element, num) {
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}

function subscribe(button) {
    
    if(userLogged==null ||userLogged=='' ) {
        alert("Please, sign in to complete this action");
        return;
    }

    if(userTo == userLogged) {
        alert("You can't subscribe to yourself");
        return;
    }

    $.post("watch/subscribe", { userTo: userTo, userLogged: userLogged })
    .done(function(count) {
        
        if(count != null) {
            $(button).toggleClass("subscribe unsubscribe");

            var buttonText = $(button).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED";
            $(button).text(buttonText);
        }
        else {
            alert("Something went wrong");
        }

    });
}

function download() {
    
  
    $.post("watch/download", { })
    .done(function(count) {
        
       

    });
}

function postComment(button){

    if(userLogged==null ||userLogged=='' ) {
        alert("Please, sign in to complete this action");
        return;
    }
    var textarea = $(button).siblings("textarea");
    var commentText = textarea.val();
    textarea.val("");
    alert("pic+ "+pic);

    if(commentText) {

        $.post("watch/postComment", { commentText: commentText, postedBy: userLogged, 
            videoId: videoId})
        .done(function(commentId){
            
            var today = new Date();
            var dd = today.getDate();
            var mm = ("0" + (today.getMonth() + 1)).slice(-2); 
            var yyyy = today.getFullYear();
            var hour = ("0" + (today.getHours())).slice(-2); 
            var minutes = ("0" + (today.getMinutes())).slice(-2);
            var seconds = ("0" + (today.getSeconds())).slice(-2);

            var datePosted=yyyy+"-"+mm+"-"+dd+" "+hour+":"+minutes+":"+seconds;
            countComments=$(button).parent().siblings(".commentCount");
            var total=parseInt(totalComments)+1;
            countComments.text(total+" Comments");

              $(button).parent().parent().siblings(".comments").prepend(
                
                '<div class="itemContainer"> '+
                    ' <div class="comment"> '+
                    ' <a href="profile?username='+userLogged+'"> '+
                            ' <img src="'+pic+'" class="profilePicture"> '+
                    " </a> "+

                        "<div class='mainContainer'> "+

                            "<div class='commentHeader'> "+ 
                                "<a href='profile?username="+userLogged+"'> "+
                                    "<span class='username'>"+userLogged+"</span> "+
                                "</a> "+
                                "<span class='timestamp'>"+datePosted+"</span> "+
                            "</div> "+

                            "<div class='body'> "+
                            commentText
                            +"</div> "+
                        "</div>" +

                    " </div> "+
                    "<div class='controls' id="+commentId+">"+
    "<button class='likeButton' onclick='likeComment(this)' >"+
                            "<img class='likeImg' src='"+baseURL+'assets/images/like.png'+"'>"+
                            "<span  class='text'>0</span>"+
    "</button>  "+
    "<button class='dislikeButton' onclick='dislikeComment(this)'>"+
                            "<img class='dislikeImg' src='"+baseURL+'assets/images/dislike.png'+"'>"+
                            "<span  class='text'>0</span>"+
                            "</button>  "+
                        "</div>"+


                    "</div> "

               
);

        });

    }
    else {
        alert("You can't post an empty comment");
    }
}
function toggleReply(button) {
    if(userLogged==null ||userLogged=='' ) {
        alert("Please, sign in to complete this action");
        return;
    }

    var parent = $(button).closest(".itemContainer");
    var commentForm = parent.find(".commentForm").first();

    commentForm.toggleClass("hidden");
}

function likeComment(button) {
    if(userLogged==null ||userLogged=='' ) {
        alert("Please, sign in to complete this action");
        return;
    }

   var commentId=$(button).parent().attr('id');
   
    $.post("watch/likeComment", { commentId: commentId, videoId: videoId, userLogged:userLogged })
    .done(function(numToChange) {
        
        var likeButton = $(button);
        var dislikeButton = $(button).siblings(".dislikeButton");

        likeButton.addClass("active");
        dislikeButton.removeClass("active");
        
        
        
        var likesCount = $(button).find(".text");
        var dislikesCount =$(button).siblings(".dislikeButton").find(".text");

        var dislikeImg=$(button).siblings(".dislikeButton").find(".dislikeImg").attr('src'); 
        var url=baseURL+"assets/images/dislike-active.png"
        
        if(dislikeImg==url)
        {
            updateLikesValue(dislikesCount, -numToChange);
            updateLikesValue(likesCount, numToChange);
        }else{
            updateLikesValue(likesCount, numToChange);
        }

        if(numToChange < 0) {
            likeButton.removeClass("active");
            likeButton.find("img:first").attr("src", baseURL+"assets/images/like.png");
        }
        else {
            likeButton.find("img:first").attr("src", baseURL+"assets/images/like-active.png");
        }

        dislikeButton.find("img:first").attr("src", baseURL+"assets/images/dislike.png");
    });
}

function dislikeComment(button) {
    if(userLogged==null ||userLogged=='' ) {
        alert("Please, sign in to complete this action");
        return;
    }

    var commentId=$(button).parent().attr('id');
    
     $.post("watch/dislikeComment", { commentId: commentId, videoId: videoId, userLogged:userLogged })
     .done(function(numToChange) {
         
         var dislikeButton = $(button);
         var likeButton = $(button).siblings(".likeButton");
 
         dislikeButton.addClass("active");
         likeButton.removeClass("active");
        
        var dislikesCount = $(button).find(".text");
        
        var likeImg=$(button).siblings(".likeButton").find(".likeImg").attr('src');
        
        var url=baseURL+"assets/images/like-active.png"
        
        var dislikesCount = $(button).find(".text");
        var likesCount =$(button).siblings(".likeButton").find(".text");
       
        
        if(likeImg==url)
        {
            updateLikesValue(likesCount, -1);
            updateLikesValue(dislikesCount, numToChange);
        }else{
            updateLikesValue(dislikesCount, numToChange);
        }
 
         if(numToChange < 0) {
             dislikeButton.removeClass("active");
             dislikeButton.find("img:first").attr("src", baseURL+"assets/images/dislike.png");
         }
         else {
             dislikeButton.find("img:first").attr("src", baseURL+"assets/images/dislike-active.png")
         }
 
         likeButton.find("img:first").attr("src", baseURL+"assets/images/like.png");
     });
 }
 

function updateLikesValue(element, num) {
    var likesCountVal = element.text() || 0;
    element.text(parseInt(likesCountVal) + parseInt(num));
}