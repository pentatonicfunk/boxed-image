<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Boxed Image Convert</title>

    <meta property="og:title" content="Boxed Image Converter Without Cropping" />
    <meta property="og:site_name" content="ImgBoxer"/>
    <meta property="og:url" content="http://boxed.kuncoro.id" />
    <meta property="og:description" content="The simplest way to create boxed image, Without Cropping" />
    <meta property="fb:app_id" content="289936593494" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="http://boxed.kuncoro.id/assets/img/maxresdefault.jpg"/>


    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="assets/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

    </nav>

    <div id="page-wrapper" style="margin: 0">
        <div class="row">
            <div class="col-md-6">
                <div class="center-block">
                    <h3>Upload</h3>
                </div>

                <div class="alert alert-danger" role="alert" style="display: none">
                </div>

                <div class="progress">
                    <div class="upload-progress progress-bar progress-bar-striped active" role="progressbar"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        Upload Progress
                    </div>
                </div>

                <input id="fileupload" type="file" name="files" data-url="upload.php">
                <hr/>

                <div class="text-center center-block">
                    <a href="#" data-toggle="modal" data-target="#modalImgSource">
                        <img src="" alt="" class="img-thumbnail img-responsive img-source" style="display: none">
                    </a>
                </div>

                <hr>
                <form class="form-horizontal box-form" style="display: none">
                    <div class="input-group">
                        <span class="input-group-addon">width</span>
                        <input type="text" class="form-control" aria-label="Width in pixel" name="width" value="640">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group demo2">
                        <span class="input-group-addon">background color</span>
                        <input type="text" value="#eeefff" class="form-control" name="color"/>
                        <span class="input-group-addon coloraddon"><i></i></span>
                    </div>
                    <br/>
                    <input type="submit" class="form-control btn btn-success" name="submit" value="Box It !">
                </form>


            </div>
            <div class="col-md-6">
                <div class="center-block">
                    <h3>Result</h3>
                </div>


                <div id="oloader"></div>

                <div class="text-center center-block">

                    <div class="media res-media" style="display: none">
                        <div class="media-left">
                            <a href="#" data-toggle="modal" data-target="#modalImgResult">
                                <img src="" alt="" class="img-result" style="display: none">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Click The Picture to See in Full Resution</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="modalImgSource" tabindex="-1" role="dialog" aria-labelledby="modalImgSource">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalImgSource">Image Source</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center center-block">
                        <img src="" alt="" class="img-thumbnail img-responsive img-source-big" style="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalImgResult" tabindex="-1" role="dialog" aria-labelledby="modalImgResult">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalImgResult">Image Result</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center center-block">
                        <img src="" alt="" class="img-thumbnail img-responsive img-result-big" style="">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-primary share-link" target="_blank">Get Sharable Link</a>
                    <a href="#" type="button" class="btn btn-success down-link">Download</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="assets/js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="assets/js/sb-admin-2.js"></script>

<script src="assets/js/jquery.ui.widget.js"></script>
<script src="assets/js/jquery.iframe-transport.js"></script>
<script src="assets/js/jquery.fileupload.js"></script>
<script src="assets/js/bootstrap-colorpicker.js"></script>
<script src="assets/js/jquery.oLoader.min.js"></script>
<script>
    $(function () {

        $('.demo2').colorpicker({
            component: '.coloraddon'
        });
        var imageName = false;
        $('#fileupload').fileupload({
            dataType: 'json',
            submit: function (e, data) {
                $('.alert-danger').hide();
                $('.img-source').hide();
                $('.img-result').hide();
                $('.res-media').hide();
                $('.upload-progress').css(
                    'width',
                    0 + '%'
                );
                $('.box-form').hide();
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (file.error) {
                        $('.alert-danger').text(file.error);
                        $('.alert-danger').show();
                    } else {
                        imageName = file.name;
                        $('.img-source').attr('src', file.thumbnailUrl + '?_' + $.now());
                        $('.img-source-big').attr('src', file.url + '?_' + $.now());
                        $('.img-source').show();

                        //show form
                        $('.box-form').show();
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('.upload-progress').css(
                    'width',
                    progress + '%'
                );
            }
        });

        $('.box-form').submit(function (e) {
            console.log('submit');
            var width = $('input[name=width]').val();
            var color = $('input[name=color]').val();
            if (!width) {
                $('.alert-danger').text('Invalid width');
                $('.alert-danger').show();
                return false;
            }
            if (!color) {
                $('.alert-danger').text('Invalid color');
                $('.alert-danger').show();
                return false;
            }
            if (!imageName) {
                $('.alert-danger').text('Invalid Image');
                $('.alert-danger').show();
                return false;
            }
            //submit
            $.ajax({
                type: "POST",
                url: '/box.php',
                data: {
                    width: width,
                    color: color,
                    image_name: imageName
                },
                success: function (data) {
                    console.log(data);
                    if (data.error) {
                        $('.alert-danger').text(data.error);
                        $('.alert-danger').show();
                    } else {
                        $('.alert-danger').hide();
                        $('.img-result').attr('src', data.thumbnailUrl + '?_' + $.now());
                        $('.img-result-big').attr('src', data.url + '?_' + $.now());
                        $('.share-link').attr('href', data.shareLink);
                        $('.down-link').attr('href', data.downLink);
                        $('.img-result').show();
                        $('.res-media').show();
                    }

                },
                dataType: 'json',
                beforeSend: function (xhr, settings) {
                    $('#oloader').oLoader({
                        backgroundColor: '#f00',
                        image: 'assets/img/loader.gif',
                        fadeInTime: 500,
                        fadeOutTime: 1000,
                        fadeLevel: 0.5
                    });
                },
                complete: function (xhr, status) {
                    $('#oloader').oLoader('hide');
                }
            });

            return false;
        });
    });
</script>
</body>
</html>