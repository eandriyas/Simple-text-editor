<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
</div>
<div class="modal-body" style="">
    <div class="row">

        <div class="col-md-8">
            <div>

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Upload File</a></li>
                <li role="presentation"  class="active"><a href="#media" aria-controls="media" role="tab" data-toggle="tabajax">Media Library</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane" id="upload">
                    <br>
                    <form id="uploadImage" action="<?php echo site_url('text/upload') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="file">Pilih gambar</label>
                            <input type="file" name="userfile[]" class="multi with-preview" multiple />


                        </div>

                        <input id="submit-button" class="btn btn-primary" type="submit" value="Upload">
                    </form>
                    <div id="output"></div>
                </div>
                <div role="tabpanel" class="tab-pane active" id="media">
                    <strong>Media</strong>
                    <div class="row">
                        <div id="dataImage">

                        </div>
                        

                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <strong>Data detail image</strong>
        <form action="">
            <div class="form-group">
                <label for="">URL</label>
                <input id="urlImage" type="text" class="form-control" disabled value="">
            </div>
            <div class="form-group">
                <label for="">Title</label>
                <input id="titleImage" type="text" class="form-control" value="">
            </div>

        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button id="insertPost" type="button" class="btn btn-primary" data-dismiss="modal">Insert to post</button>
</div>

<script>
    $(document).ready(function(){


        var base = '<?php echo base_url(); ?>';
        $.ajax({
          url: base+"text/get_image",
          cache: false,
          dataType: 'json',
          success: function(data){

            var image = data;
            for(var i =0; i<image.length; i++){
                var url = image[i].url;
                var title = image[i].title;
                var id = image[i].id;
                $('#dataImage').append('<div style="margin-top:20px;" class="col-xs-4 col-md-2"><a href="#" class="thumbnail" data-id="'+id+'" data-url="'+url+'" data-title="'+title+'"><img class="image-thumb" style="width:150px;height:150px;" src="'+url+'" alt="'+title+'"></a></div>');

            }
        }
    });
        $('#uploadImage').on('submit', function(e){
            e.preventDefault();
            $('#output').html('<div style="padding:10px"><img src="<?php ?>" alt="Please Wait"/> <span>Mengunggah...</span></div>');
            $(this).ajaxSubmit({
                target: '#output',
                success: function(){
                    $('#uploadImage').reset();
                    // $('#uploadImage').hide();
                    $('[data-toggle="tabajax"').tab('show');
                    $('#dataImage>div').remove();
                    var url =  '<?php echo base_url(); ?>/text/get_image';
                    $.getJSON(url, function(data){
                    // $(target).html(data);
                    var image = data;

                    for(var i =0; i<image.length; i++){
                        var url = image[i].url;
                        var title = image[i].title;
                        var id = image[i].id;
                        $('#dataImage').append('<div style="margin-top:20px;" class="col-xs-4 col-md-2"><a href="#" class="thumbnail" data-id="'+id+'" data-url="'+url+'" data-title="'+title+'"><img class="image-thumb" style="width:150px;height:150px;" src="'+url+'" alt="'+title+'"></a></div>');

                    }
                });
                   

                    
                }
            });
                });
$('#insertPost').on('click', function(){


    var check = $('.thumbnail').hasClass('add');
    $('.thumbnail.add').each(function(){
        var title = $(this).attr('data-title');
        var url = $(this).attr('data-url');
        var image = "<img style='width:100px;' src="+url+" alt="+title+" >";
        tinymce.get('Editor').execCommand('insertHTML', true, image);
    });

    $('#output>div').remove();
});

$('[data-toggle="tabajax"]').on('click', function(){
    var url =  '<?php echo base_url(); ?>/text/get_image';
    var target = $(this).attr('href');
    $.getJSON(url, function(data){
            // $(target).html(data);
            $('#dataImage>div').remove();
            var image = data;

            for(var i =0; i<image.length; i++){
                var url = image[i].url;
                var title = image[i].title;
                var id = image[i].id;
                $('#dataImage').append('<div style="margin-top:20px;" class="col-xs-4 col-md-2"><a href="#" class="thumbnail" data-id="'+id+'" data-url="'+url+'" data-title="'+title+'"><img class="image-thumb" style="width:150px;height:150px;" src="'+url+'" alt="'+title+'"></a></div>');

            }
        });

    $(this).tab('show');
    return false;
});




});

</script>
<script>
    $('body').on('click','.thumbnail', function(){
        var base = '<?php echo base_url(); ?>';
        var id = $(this).attr('data-id');
        if($(this).hasClass('add')){
            $(this).removeClass('add');
        } else{
           $(this).addClass('add');
           $.ajax({
            url: base+'/text/get_one_image/'+id ,
            dataType: 'json',
            cache: false,
            success: function(json){
                $('#urlImage').val(json.url);
                $('#titleImage').val(json.title);
            }
        })
       }

   });
</script>
<style>
    .thumbnail{
        transition:0.2s ease-in-out;
    }
    .add{
        border:5px solid rgb(62, 110, 216);
        padding: 0px;

    }
</style>