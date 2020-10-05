
<div class="videoSection">
<a href=<?php echo base_url('watch?id='.$id); ?>>
                    <div class='videoGridItem'>

                    <div class='thumbnail'>
                    <img src=<?php echo base_url('assets/images/Thumbnail.png'); ?>>
                    
                </div>
                    <div class='details'>
                    <h3 class='title'><?php echo $title?></h3>
                    <span class='username'><?php echo $uploadedBy?></span>
                    <div class='stats'>
                        <span class='viewCount'><?php echo $views?> views - </span>
                        <span class='timeStamp'><?php echo $uploadDate?></span>
                    </div>
                    <span class='description'><?php echo $description?></span>
                </div>
                    </div>
                </a>

                </div>

