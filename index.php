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

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="assets/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

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

                    <p class="bg-danger" style="display: none"></p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>

                    <input id="fileupload" type="file" name="files" data-url="upload.php">

                    <img src="" alt="" class="img-thumbnail img-responsive img-source" style="display: none">

                </div>
                <div class="col-md-6">
                    <div class="center-block">
                        <h3>Result</h3>
                    </div>
                </div>
            </div>
    </div>
    <!-- /#page-wrapper -->

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
<script>
    $(function () {
        $('#fileupload').fileupload({
            dataType: 'json',
            submit : function(e, data) {
                $('.bg-danger').hide();
                $('.img-source').hide();
                $('.progress-bar').css(
                    'width',
                    0 + '%'
                );
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (file.error) {
                        $('.bg-danger').text(file.error);
                        $('.bg-danger').show();
                    } else {
                        $('.img-source').attr('src', file.url);
                        $('.img-source').show();
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('.progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        });
    });
</script>
</body>
</html>