<?php session_start();
function get_full_url()
{
    $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
        !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;

    return
        ($https ? 'https://' : 'http://') .
        (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] . '@' : '') .
        (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'] .
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER['SERVER_PORT']))) .
        substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
}


$base_id = $_GET['base_id'];
$id = $_GET['id'];

try {
    if (!$base_id || !$id)
        throw new Exception('Wrong Parameter');

    $highResFile = get_full_url() . '/files/' . $base_id . '/boxed/' . $id;
    $thumbFile = get_full_url() . '/files/' . $base_id . '/boxed/thumbnail' . $id;

    $downLink = get_full_url() . '/download.php?base_id=' . urlencode($base_id) . '&id=' . urlencode($id);

    if (!is_file($highResFile) || !is_file($thumbFile))
        throw new Exception('File Not Found');

} catch (Exception $e) {
    header('Location: 404.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Boxed Image Convert Shared</title>

    <meta property="og:title" content="Boxed Image Converter Without Cropping" />
    <meta property="og:site_name" content="ImgBoxer"/>
    <meta property="og:url" content="http://boxed.kuncoro.id" />
    <meta property="og:description" content="The simplest way to create boxed image, Without Cropping" />
    <meta property="fb:app_id" content="289936593494" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:image" content="<?php echo $highResFile ?>"/>


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
            <div class="col-md-12">
                <div class="center-block">
                    <h3>Shared Images</h3>
                </div>

                <div class="text-center center-block">
                        <img src="<?php echo $thumbFile ?>" alt="" class="img-thumbnail img-responsive img-source" style="">
                </div>

                <hr>
                <div class="text-center center-block">
                    <img src="<?php echo $highResFile ?>" alt="" class="img-thumbnail img-responsive img-source" style="">
                </div>
                <hr>
                <a href="<?php echo $downLink ?>" class="btn btn-success btn-lg">Download</a>

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
<script src="assets/js/bootstrap-colorpicker.js"></script>
<script src="assets/js/jquery.oLoader.min.js"></script>
<script>
    $(function () {
    });
</script>
</body>
</html>