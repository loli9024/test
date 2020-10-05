<script src="<?php echo base_url('assets/js/ajax.js'); ?>"></script>

<script type='text/javascript'>
var baseURL= "<?php echo base_url();?>";
var videoId= "<?php echo $videoId?>";
var userLogged= "<?php echo $userLogged?>";
var pic= "<?php echo $pic ?>";


</script>

<div class='itemContainer'>
    <div class='comment'>
                    <a href=<?php echo base_url('profile?username='.$postedBy); ?>>
                            <img src="<?php echo base_url($commentPic); ?>"  class='profilePicture'>
                    </a>

                        <div class='mainContainer'>

                            <div class='commentHeader'>
                                <a href=<?php echo base_url('profile?username='.$postedBy); ?>>
                                    <span class='username'><?php echo $postedBy; ?></span>
                                </a>
                                <span class='timestamp'><?php echo $datePosted; ?></span>
                            </div>

                            <div class='body'>
                                <?php echo $body; ?>
                            </div>
                        </div>

                    

    </div>
    <div class='controls' id="<?php echo $commentId ?>">
    <button class='null' onclick='toggleReply(this)'>
        <span class='text'>Reply</span>
     </button>
    <button class='likeButton' onclick="likeComment(this)" >
                            <img class='likeImg' src="<?php echo $commentLikeImage ?>">
                            <span  class='text'><?php echo $commentLikes ; ?></span>
    </button>  
    <button class='dislikeButton' onclick="dislikeComment(this)">
                            <img class='dislikeImg' src="<?php echo $commentDislikeImage ?>">
                            <span class='text'><?php echo $commentDislikes ; ?></span>
                        </button>
                        </div>
    
</div>
