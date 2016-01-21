<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home editor</title>

  <!-- Latest compiled and minified CSS & JS -->
  <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/'); ?>/bootstrap/css/bootstrap.min.css">
  <script src="<?php echo base_url('assets/'); ?>/bootstrap/js/jquery-2.1.4.min.js"></script>
  <script src="<?php echo base_url('assets/'); ?>/bootstrap/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>/style.css">
</head>
<body>
  <div style="margin-top:100px;" class="container-fluid">
    <div class="row">
    <a style="margin-left:100px;" href="<?php echo base_url('text/editor'); ?>" class="btn btn-default">Tambah Post</a>
    <hr>

      <div class="col-md-4">
        <div class="list-group">
          <a href="#" class="list-group-item disabled">
            New Posts
          </a>
          <?php foreach($posts as $post): ?>
            <a href="#" data-id="<?php echo $post->id; ?>" class="list-group-item detail-item"><?php echo $post->title; ?></a>
          <?php endforeach; ?>

        </div>
      </div>
      <div class="col-md-8">
        <h2 id="title"></h2>
        <div id="content">

        </div>

      </div>



    </div>
  </div>
</div>
<script>
  $(document).ready(function(){

    var base = '<?php echo base_url(); ?>';

    $('.detail-item').on('click', function(){
        var id = $(this).attr('data-id');

        $.ajax({
          url: base+'/text/detail/'+id ,
          dataType: 'json',
          cache: true,
          success: function(data){
           

            $('#title').html(data.title);
            $('#content').html(data.content);
          }
        })
    });
  });
</script>

</body>
</html>