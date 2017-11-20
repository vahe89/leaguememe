<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
        <style>
            .delete{
                background: white;
                border-radius: 100%; 
                margin-left: -8px; 
                cursor: pointer;
            }
            .thumb {
                height: 75px;
                border: 1px solid #000;
                margin: 10px 5px 0 0;
            }
        </style>
    </head>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header with-border">
            <h1>
                <?php echo isset($content_header) ? $content_header : "Leaguememe"; ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><?php echo isset($left) ? $left : "leaguememe"; ?></li>
            </ol>
        </section>
        <!--    <hr/> -->
        <section class="content">
            <div class="row">
                <div class="col-lg-2">
                </div>

                <div class="col-lg-8">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Patch Notes</h3>
                        </div><!-- /.box-header -->
                        <?php
                        $message = $this->session->flashdata('message');
                        if ($message != '') {
                            ?>
                            <center>
                                <div class="alert alert-success alert-dismissable" style="width: 40%">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>
                                        <?php echo $message; ?>
                                    </strong> 
                                </div> 
                            </center> 
                        <?php } ?> 

                        <div style="width: 96%; margin: auto;">
                            <label for="required">Patch Note Title:</label>
                            <input type="text" name="edit_patchnotes_title" id="edit_patchnotes_title" value="<?php echo $patch_data['patch_title'] ?>" size="32" class="validate[required] form-control edit_patchnotes_title"/>	
                        </div> 

                        <!-- form start -->
                        <form class="form uniformForm validateForm"  id="edit_patchnotes_form" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <?php
                                foreach ($patch_section as $ps) {
                                    $sid = $ps['pSecdata']->sect_id;
                                    ?>
                                    <a class="remove_savedSec fa fa-remove pull-right" href="javascript:void(0);" id="<?php echo $sid; ?>" style="margin-top: -8px; margin-right: -5px; color: red;"></a>
                                    <div class="panel panel-default mar-b-10" id="remSecdiv_<?php echo $sid; ?>">
                                        <div class="edit_patchNote_form" value="<?php echo $sid; ?>">
                                            <div class="form-group">
                                                <label for="required">Patch Note Name:</label>
                                                <div class="field">
                                                    <input type="text" name="edit_patchnotes_name" value="<?php echo $ps['pSecdata']->patch_name; ?>" id="edit_patchnotes_name" size="32" class="validate[required] form-control edit_patchnotes_name"/>	
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label for="required">Patch Note Description:</label>
                                                <div class="field"> 
                                                    <textarea name="edit_patchnote_desc" id="edit_patchnote_desc" class="validate[required] form-control edit_patchnote_desc"><?php echo $ps['pSecdata']->patch_description; ?></textarea>	
                                                </div>
                                            </div> 

                                            <div class="col-md-12">
                                                <?php
                                                foreach ($ps['pImgdata'] as $parent_image) {
                                                    ?>
                                                    <div class="col-md-2" style="border: 2px solid gray;margin:2px;padding: 10px;">
                                                        <a href="javascript:void(0)" onclick="delete_img(this, '<?php echo $parent_image['id'] ?>')"><i class="fa fa-times"></i></a>
                                                        <img src='<?php echo base_url() ?>uploads/patch_notes/<?php echo $parent_image['filename'] ?>' class="img-responsive" style="height: 100px;"> 
                                                    </div>
                                                    <?php
                                                }
                                                ?> 
                                            </div>

                                            <div class="form-group" id="fileupload">
                                                <label for="required">Patch Note Image:</label>
                                                <div class="field">
                                                    <input type="file" id="files" class="flToupload" name="files[]" multiple accept="image/*" onchange="readURL(this)"/> 	
                                                    <output id="list" class="list"></output>
                                                </div> 
                                            </div>  
                                        </div>
                                    </div>
                                <?php } ?>

                                <div id="inline_more_notes" class="inline_more_notes">

                                </div>

                                <div id="add_another" style="margin-bottom: 20px;">
                                    <a href="javascript:void(0);" class="btn btn-default"><i class="fa fa-plus-circle" style="color: #17ae97; margin-right: 10px;"></i>Add another</a>
                                </div>
                                
                                <div id="loaderUpd" style="text-align: center; display: none;"></div>

                                <!-- .form-group -->
                                <div class="actions">						
                                    <a id="submit" class="btn btn-primary">Submit</a>
                                </div><!-- .actions -->
                            </div>
                        </form>  

                    </div>
                </div>    
                <div class="col-lg-2">
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            var count = 1;
            $("#add_another").click(function () {
                count++;

                var htlData = "<div class='edit_patchNote_form' value='new'><div class='form-group'><label for='required'>Patch Note Name:</label><div class='field'><input type='text' name='edit_patchnotes_name' id='edit_patchnotes_name' size='32' class='validate[required] form-control edit_patchnotes_name'/></div></div>\n\
                        <div class='form-group'><label for='required'>Patch Note Description:</label><div class='field'><textarea name='edit_patchnote_desc' id='edit_patchnote_desc' class='validate[required] form-control edit_patchnote_desc'></textarea></div></div>\n\
                         <div class='form-group' id='fileupload'><label for='required'>Patch Note Image:</label><div class='field'><input type='file' id='files' name='files[]' class='flToupload' multiple accept='image/*' onchange='readURL(this)'/><output id='list' class='list'></output></div></div></div>";

                $(".inline_more_notes").append('<a class="remove_div fa fa-remove pull-right" href="javascript:void(0);" id="' + count + '" style="margin-top: -8px; margin-right: -5px; color: red;"></a><div class="panel panel-default mar-b-10" id="remdiv_' + count + '">' + htlData + '</div>');

            });
        });

        $(document).on('click', '.remove_div', function () {
            var id = $(this).attr('id');
            document.getElementById('remdiv_' + id).remove();
            $(this).remove();
        });

        $(document).on('click', '.remove_savedSec', function () {
            var confDel = "Are you sure you want to delete this section";
            if (confirm(confDel) == true) {

                var id = $(this).attr('id');
                document.getElementById('remSecdiv_' + id).remove();
                $.ajax({
                    type: 'POST',
                    url: base_url + "admin/patch_note/delete_section",
                    data: {
                        secId: id,
                    },
                    success: function (data, textStatus, jqXHR) {
                        $(this).remove();
                    }
                });

            }
        });

        $('body').on('click', '.delete', function () {
            $(this).parent().remove();
        });

        function delete_img(obj, id) {
            var delImg = "Are you sure you want to delete this image";
            if (confirm(delImg) == true) {

                $.ajax({
                    type: 'POST',
                    url: base_url + "admin/patch_note/delete_img",
                    data: {
                        id: id
                    },
                    success: function (data, textStatus, jqXHR) {
                        $(obj).parent().remove();
                    }
                })

            }
        }

        $("#submit").click(function () {
            $('#edit_patchnotes_form').find('.error').remove();
            var err = "";
            var fData = [];
            $('.edit_patchnotes_title').parent().find('.error').remove();
            var ptitle = $("#edit_patchnotes_title").val();
            if ($.trim(ptitle) == "") {
                $('.edit_patchnotes_title').parent().append("<p class='error'>Please enter Patch notes title</p>");
               err = "error";
                return false;
            } else {
              err = "success";
            }

//            var chCls = $('#edit_patchnotes_form').hasClass("edit_patchNote_form");

            if ($(".edit_patchNote_form").length !== 0) {

                $(".edit_patchNote_form").each(function (i, v) {

                    var imgdata = [];
                    var allData = [];
                    var secid = $(this).attr("value");
                    allData.push(secid);
                    var pnn = $(this).find('.edit_patchnotes_name').val();

                    if ($.trim(pnn) == "") {
                        $(this).find('.edit_patchnotes_name').parent().append("<p class='error'>Please enter Patch notes name</p>");
                       err = "error";
                        return false;
                    } else {
                       allData.push(pnn);
                        err = "success";
                    }

                    var pnd = $(this).find('.edit_patchnote_desc').val();
                    allData.push(pnd);

                    var thumb = $(this).find('.thumb');
                    thumb.each(function (i, v) {
                        imgdata.push($(this).attr('src'));
                    });

                    if (secid == 'new') {
                        if (imgdata.length === 0) {
                            $(this).find('.flToupload').parent().append("<p class='error'>Please choose image </p>");
                            err = "error";
                            return false;
                        } else {
                            allData.push(imgdata);
                            err = "success";
                        }
                    } else {
                        if (imgdata.length != '0') {
                            allData.push(imgdata);
                            err = "success";
                        }
                    }

                    fData.push(allData);

                });
            } else {
                alert("Please add sections");
                err = "error";
                return false;
            }

            if (err == "success") {
                
                var bu = base_url + "assets/public/img/loader.gif";
                $("#loaderUpd").show();
                $("#loaderUpd").html('<img src="' + bu + '">');
                
                $.ajax({
                    type: 'POST',
                    url: base_url + "edit_patch_notes/" + <?= $patch_id ?>,
                    data: {
                        aldata: fData,
                        ptitle: ptitle,
                    },
                    success: function (data, textStatus, jqXHR) {
                        window.location.href = base_url + "edit_patch_notes/" + <?= $patch_id ?>;
                    }
                })
            }
        });

        function readURL(evt) {
            var abc = "";
            var files = evt.files; // FileList object
            abc += 1;
            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                // Only process image files.
                if (!f.type.match('image.*')) {
                    alert("Plese select image only");
                    continue;
                }

                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        var hData = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/><i class="fa fa-times delete" style="color:red"><i>'].join('');

                        $(evt).parent(".field").find(".list").append("<span>" + hData + "</span>");
                    };
                })(f);
                $('#files').find('.error').remove();
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
        }
    </script>
