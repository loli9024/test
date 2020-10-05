</div>
</div>

<div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                    <div class='section'>
                        <span>Details</span>
                    
                    <div class='values'>
                    <span>Name: <?php echo $firstName." ".$lastName; ?></span>
                    <span>Username: <?php echo $userTo; ?></span>
                    <span>Subscribers: <?php echo $subscribers; ?></span>
                    <span>Total views: <?php echo $views; ?></span>
                    <span>Sign up date: <?php echo $signUpDate; ?></span>
                    </div>

                   
                </div>

                </div>
                    <div class='tab-pane fade' id='picture' role='tabpanel' aria-labelledby='about-tab'>
                    <div class='content' >
                    <!-- Dropzone -->
                    <form action="<?= base_url('index.php/Picture/fileupload') ?>" class="dropzone" id="fileupload">
                    </form> 
                    </div>
                    
                    <div class='buttonContainer'>
                        <div class='buttonItem'>    
                        <div id="download" class='downloadButtonContainer'>
                        <form action="<?php echo base_url('profile?username='.$userTo); ?>" method="post">
                            <button type="submit"  class="download button">
                            <span id='down'>UPLOAD</span>
                            </button>
                        </form>
                    </div>
                        </div>
                        
                    </div>
                    
                    </div>
        </div>

</div>