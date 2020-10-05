
<div class="settingsContainer column">

    <div class="formSection">
        <div class="message">
        </div>

        <form action=<?php echo base_url('editProfile/edit'); ?> method='POST' enctype='multipart/form-data'>
                                <span class='title'>User details</span>

            <div class='form-group'>
                <input class='form-control' type='text' placeholder='First name' name='firstName' value="<?php echo $firstName; ?>" required>
            </div>
            <div class='form-group'>
                <input class='form-control' type='text' placeholder='Last name' name='lastName' value="<?php echo $lastName; ?>" required>
            </div>
            <div class='form-group'>
                <input class='form-control' type='email' placeholder='Email' name='email' value="<?php echo $email; ?>" required>
            </div>
            <button type='submit' class='btn btn-primary' name='saveDetailsButton'>Save</button>

        </form>

    </div>

<div class="formSection">
        <div class="message">
        </div>
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

        <form action=<?php echo base_url('editProfile/changePassword'); ?> method='POST' enctype='multipart/form-data'>
                            <span class='title'>Update password</span>

        <div class='form-group'>
            <input class='form-control' type='password' placeholder='Old Password' name='oldpassword' required>
        </div>

        <div class='form-group'>
            <input class='form-control' type='password' placeholder='New Password' name='newpasswrod' required>
        </div>

        <div class='form-group'>
            <input class='form-control' type='password' placeholder='Confirm New Password' name='confirmpassword' required>
        </div>

        <button type='submit' class='btn btn-primary' name='savePasswordButton'>Change Password</button>

        </form>


</div>