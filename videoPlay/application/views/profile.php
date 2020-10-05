
    <link href='<?= base_url() ?>resources/dropzone.css' type='text/css' rel='stylesheet'>
    <script src='<?= base_url() ?>resources/dropzone.js' type='text/javascript'></script>
    
<script src="<?php echo base_url('assets/js/ajax.js'); ?>"></script>

<script type='text/javascript'>
var baseURL= "<?php echo base_url();?>";
var userLogged= "<?php echo $userLogged?>";
var userTo= "<?php echo $userTo?>";

    // Add restrictions
    Dropzone.options.fileupload = {
      acceptedFiles: 'image/*',
      maxFilesize: 3 // MB
    };

</script>

<div class='profileContainer'>
                <div class='coverPhotoContainer'>
                    <img src="<?php echo base_url('assets/images/cover.jpg'); ?>" class='coverPhoto'>
                    </div>
                <div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img class='profileImage' src='<?php echo base_url($this->session->userdata('picture')); ?>'>
                        <div class='userInfo'>
                            <span class='title'><?php echo $firstName." ".$lastName; ?></span>
                            <span class='subscriberCount'><?php echo $subscribers." - Subscribers "; ?></span>
                        </div>
                    </div>

                    <div class='buttonContainer'>
                        <div class='buttonItem'>    
                        <div id="download" class='downloadButtonContainer'>
                        <form action="<?php echo base_url('EditProfile'); ?>" method="post">
                            <button type="submit"  class="download button">
                            <span id='down'>EDIT PROFILE</span>
                            </button>
                        </form>
                    </div>
                        </div>
                        
                    </div>
                   
                </div>
                <ul class='nav nav-tabs' role='tablist'>
                    <li class='nav-item'>
                    <a class='nav-link active' id='videos-tab' data-toggle='tab' 
                        href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' 
                        aria-controls='about' aria-selected='false'>ABOUT</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link' id='about-tab' data-toggle='tab' href='#picture' role='tab' 
                        aria-controls='picture' aria-selected='false'>PICTURE</a>
                    </li>
                </ul>
                <div class='tab-content channelContent'>
                    <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                    
                    <div class='videoGrid'>
                    