
<script src="<?php echo base_url('assets/js/ajax.js'); ?>"></script>

<script type='text/javascript'>
var baseURL= "<?php echo base_url();?>";
var videoId= "<?php echo $videoId?>";
var userLogged= "<?php echo $userLogged?>";
var userTo= "<?php echo $uploadedBy?>";
var totalComments= "<?php echo $totalComments?>";

</script>

<div class="watchLeftColumn">
<video class='videoPlayer' id="videoPlayer" controls autoplay muted>
                    <source src=<?php echo base_url($filePath); ?> type='video/mp4'>
                    Your browser does not support the video tag
</video>

                <div class='videoInfo'>
                    <h1><?php echo $title; ?></h1>

                    <div class='bottomSection'>
                        <span class='viewCount'><?php echo $views ; ?>  views</span>
                        
                        <div class="controls">
                                
                        <button class='likeButton' onclick="like(this)">
                            <img src="<?php echo $likeImage ?>">
                            <span class='text'><?php echo $likes ; ?></span>
                        </button>   
                              
                        <button class='dislikeButton' onclick="dislike(this)">
                            <img src="<?php echo $dislikeImage ?>">
                            <span class='text'><?php echo $dislikes ; ?></span>
                        </button>

                         </div>

                    </div>
                </div>

                <div class='secondaryInfo'>
                    <div class='topRow'>
                    <a href=<?php echo base_url('profile?username='.$userTo); ?>>    
                    <img src='<?php echo base_url($picture); ?>' class='profilePicture'>
                    </a>

                        <div class='uploadInfo'>
                            <span class='owner'>
                            <a href=<?php echo base_url('profile?username='.$userTo); ?>>
                                <?php echo $uploadedBy ; ?>
                                </a>
                            </span>
                            <span class='date'>Published on <?php echo $uploadDate ; ?></span>
                        </div>
                        <div id="subscribeId" class='subscribeButtonContainer'>
                        <button class='<?php echo $styleButton ; ?>' onclick="subscribe(this)" >
                            <span id='subscriptor'><?php echo $textButton ; ?></span>
                        </button>
                        </div>
                        &nbsp&nbsp
                        <div id="download" class='downloadButtonContainer'>
                        <form action="<?php echo base_url('watch/download'); ?>" method="post">
                        <input type="hidden" value=<?php echo $filePath ; ?> name="filePath" />
                            <button type="submit"  class="download button">
                            <span id='down'>DOWNLOAD</span>
                            </button>
                        </form>
                        </div>


                    </div>

                    <div class='descriptionContainer'>
                        
                    </div>
        
                </div>

                <div class='commentSection'>

                    <div class='header'>
                        <span class='commentCount'><?php echo  $totalComments." Comments" ; ?></span>

                        <div class='commentForm'>
                            <img src='<?php echo base_url($this->session->userdata('picture')?$this->session->userdata('picture'):'assets/images/maleuser.png'); ?>' class='profilePicture'>
                        
                            <textarea class='commentBodyClass' placeholder='Add a public comment'></textarea>
                            <button class='postComment' onclick="postComment(this)">
                            <span class='text'>COMMENT</span>
                            </button>
                            
                        </div>
                        

                    </div>


                    <div class='comments'>
                        
                    