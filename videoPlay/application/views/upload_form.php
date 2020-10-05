<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>
<?php echo form_open_multipart(base_url('upload/do_upload'));?>
</br>
        <div class='form-group'>
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
        
                        <label for='video'>Select your Video</label>
                        <input  type='file' class='form-control-file' name='video' required>
                    </div>
                    <div class='form-group'>
                        <input class='form-control' type='text' placeholder='Title' name='title' required>
                    </div>
                    <div class='form-group'>
                    <textarea class='form-control' name='description' placeholder='Description' rows='3'></textarea>
                    </div>
                    <div class='form-group'>
                        <select class='form-control' name='privacity' id='privacity'>
                            <option value=0>Public</option>
                            <option value=1>Private</option>
                        </select>
                    </div>
   <select name="category" id="category" class="form-control input-lg" required>
    <option value="">Select category</option>
    <?php
    foreach($category as $row)
    {
     echo '<option value="'.$row->id.'">'.$row->name.'</option>';
    }
    ?>
   </select>
   </br>

<input type="submit" value="Upload" class='btn btn-primary' onclick="showLoading()"/>

</form>
<script>
function showLoading() {
    $("#loading").modal("show");
}
</script>

<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <img src="<?php echo base_url('assets/images/loading.gif'); ?>">
      </div>

    </div>
  </div>
</div>


</body>
</html>