<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Text editor</title>

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/'); ?>/bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url('assets/'); ?>/bootstrap/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>/jquery.form.js"></script>
    <script src="<?php echo base_url('assets/'); ?>/jQuery.MultiFile.min.js"></script>
    <script>tinymce.init({
      selector: 'textarea',
      height: 500,
      theme: 'modern',
      plugins: [
      'advlist autolink lists link charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons',
      image_advtab: true,
      templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
      '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
      '//www.tinymce.com/css/codepen.min.css'
      ],
       relative_urls: false,
        remove_script_host: false

  });</script>
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>/style.css">
</head>
<body>
    <div style="margin-top:100px;" class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo base_url('text/modal'); ?>" id="addImage" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#uploadImageModal">
                  Add image
              </a>
              <hr>
              <form action="<?php echo base_url('text/simpan') ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" class="form-control" name="title">
                  </div>
                  <textarea name="content" id="Editor" style="min-height: 200px;"></textarea>
                  <hr>
                  <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Simpan">
                  </div>
              </form>
          </div>
          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" style="width:90%;" role="document">
                <div class="modal-content" style="border-radius:0;">

                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function(){


        $('#addImage').on('click', function(){
            jQuery('#uploadImage').reset();
            $('#uploadImage').show();


        });
        
    });


</script>
</body>
</html>