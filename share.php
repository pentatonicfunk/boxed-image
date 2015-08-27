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

    $highResFile = dirname(__FILE__) . '/files/' . $base_id . '/boxed/' . $id;
    $thumbFile = dirname(__FILE__) . '/files/' . $base_id . '/boxed/thumbnail/' . $id;

    $highResUrl = get_full_url() . '/files/' . $base_id . '/boxed/' . $id;
    $thumbUrl= get_full_url() . '/files/' . $base_id . '/boxed/thumbnail/' . $id;

    $downLink = get_full_url() . '/download.php?base_id=' . urlencode($base_id) . '&id=' . urlencode($id);
    $shareLink = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

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
    <meta property="og:url" content="<?php echo $shareLink ?>" />
    <meta property="og:description" content="The simplest way to create boxed image, Without Cropping" />
    <meta property="fb:app_id" content="289936593494" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />

    <meta property="og:image" content="<?php echo $highResUrl ?>"/>


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

    <style>
        ul.share-buttons{
            list-style: none;
            padding: 0;
        }

        ul.share-buttons li{
            display: inline;
        }
        </style>

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
                        <img src="<?php echo $thumbUrl ?>" alt="" class="img-thumbnail img-responsive img-source" style="">
                </div>

                <hr>
                <div class="text-center center-block">
                    <img src="<?php echo $highResUrl ?>" alt="" class="img-thumbnail img-responsive img-source" style="">
                </div>
                <hr>
                <ul class="share-buttons">
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($shareLink)?>&t=<?php echo urlencode($shareLink)?>" title="Share on Facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><img src="images/flat_web_icon_set/color/Facebook.png"></a></li>
                    <li><a href="https://twitter.com/intent/tweet?source=<?php echo urlencode($shareLink)?>&text=<?php echo urlencode($shareLink)?>&via=pentatonicfunk" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><img src="images/flat_web_icon_set/color/Twitter.png"></a></li>
                    <li><a href="https://plus.google.com/share?url=<?php echo urlencode($shareLink)?>" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img src="images/flat_web_icon_set/color/Google+.png"></a></li>
                    <li><a href="http://www.tumblr.com/share?v=3&u=<?php echo urlencode($shareLink)?>&t=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><img src="images/flat_web_icon_set/color/Tumblr.png"></a></li>
                    <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($shareLink)?>&description=" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;"><img src="images/flat_web_icon_set/color/Pinterest.png"></a></li>
                    <li><a href="https://getpocket.com/save?url=<?php echo urlencode($shareLink)?>&title=" target="_blank" title="Add to Pocket" onclick="window.open('https://getpocket.com/save?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img src="images/flat_web_icon_set/color/Pocket.png"></a></li>
                    <li><a href="http://www.reddit.com/submit?url=<?php echo urlencode($shareLink)?>&title=" target="_blank" title="Submit to Reddit" onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img src="images/flat_web_icon_set/color/Reddit.png"></a></li>
                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($shareLink)?>&title=&summary=&source=<?php echo urlencode($shareLink)?>" target="_blank" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img src="images/flat_web_icon_set/color/LinkedIn.png"></a></li>
                    <li><a href="http://wordpress.com/press-this.php?u=<?php echo urlencode($shareLink)?>&t=&s=" target="_blank" title="Publish on WordPress" onclick="window.open('http://wordpress.com/press-this.php?u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><img src="images/flat_web_icon_set/color/Wordpress.png"></a></li>
                    <li><a href="https://pinboard.in/popup_login/?url=<?php echo urlencode($shareLink)?>&title=&description=" target="_blank" title="Save to Pinboard" onclick="window.open('https://pinboard.in/popup_login/?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img src="images/flat_web_icon_set/color/Pinboard.png"></a></li>
                    <li><a href="mailto:?subject=&body=:%20<?php echo urlencode($shareLink)?>" target="_blank" title="Email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;"><img src="images/flat_web_icon_set/color/Email.png"></a></li>
                </ul>
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
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-51711528-12', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>