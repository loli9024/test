
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>

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
            <a href='index.php'>
                <img src=<?php echo base_url('assets/images/youtube2.png'); ?> title="logo" alt="Site logo">VideoPlay
            </a>   
                <h3>Sign Up</h3>
                <span>to continue to VideoPlay</span>
            </div>
            <?php echo form_open('signUp/signUp'); ?>
            <div class="loginForm">

            <?php
                if($this->session->flashdata('message'))
                {
                    echo '
                    <div class="alert alert-danger">
                        '.$this->session->flashdata("message").'
                    </div>
                    ';
                }
                else if($this->session->flashdata('info'))
                {
                    echo '
                    <div class="alert  alert-success">
                        '.$this->session->flashdata("info").'
                    </div>
                    ';
                }
                ?>
                <?php echo validation_errors(); ?>

                <form action="signUp.php" method="POST">
                    
                <input type="text" name="firstName" placeholder="First name" value="<?php echo set_value('firstName'); ?>" autocomplete="off" required>

                <input type="text" name="lastName" placeholder="Last name" autocomplete="off" value="<?php echo set_value('lastName'); ?>" required>

                <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?php echo set_value('username'); ?>" required>

                <input type="email" name="email" placeholder="Email" autocomplete="off" value="<?php echo set_value('email'); ?>" required>
                
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <input type="password" name="password2" placeholder="Confirm password" autocomplete="off" required>

                <input type="submit" name="submitButton" value="SUBMIT">

                
                </form>


            </div>

            <a class="signInMessage" href=<?php echo base_url('signIn'); ?>>Already have an account? Sign in here!</a>
        
        </div>
    
    </div>




</body>
</html>