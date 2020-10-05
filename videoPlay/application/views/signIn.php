
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" type="text/css" rel="stylesheet" />
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

</head>
<body>

<div class="signInContainer">

<div class="column">

    <div class="header">
    <a href=>
        <img src=<?php echo base_url('assets/images/youtube2.png'); ?>>
                VideoPlay
        </a>
        <h3>Sign In</h3>
        <span>to continue to VideoPlay</span>
    </div>
    <?php echo form_open('signIn/login'); ?>
    <div class='loginForm' >

               

                <?php
                if($this->session->flashdata('message'))
                {
                    echo '
                    <div class="alert alert-danger">
                        '.$this->session->flashdata("message").'
                    </div>
                    ';
                }
                ?>

                <input type="text" name="username" placeholder="Username" id='username' value="<?php echo get_cookie('username'); ?>"
                    required autocomplete="off">
                    <input type="password" name="password" placeholder="Password" value="<?php echo get_cookie('password'); ?>" required>
                    <p>Remember Me: <input name="remember" type="checkbox" <?php echo get_cookie('remember') ? 'checked="checked"' : ''; ?>/></p>
                    <p id="captImg"><?php echo $captchaImg; ?></p>
                    <p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>

                    Enter the code : 
                    <input type="text" name="captcha" value="" required autocomplete="off"/>
                    <input type="submit" name="submit" value="SUBMIT"/>

 

            </div>

           
    <a class="signInMessage" href=<?php echo base_url('signUp'); ?>>Need an account? Sign up here!</a>
    <a class="signInMessage" href=<?php echo base_url('forgotPassword'); ?>>Forgot your password
    </a>

   

</div>

</div>

<!-- captcha refresh code -->
<script>
$(document).ready(function(){
    $('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'signIn/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});
</script>

</body>
</html>