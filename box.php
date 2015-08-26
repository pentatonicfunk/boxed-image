<?php session_start();

$result = array(
    'url'   => '',
    'error' => false,
);
try {
    if (!$_SESSION['file_name'])
        throw new Exception('No Image Selected');

    $width = (int)$_POST['width'];
    $color = $_POST['color'];


    if (!$width || $width > 2048)
        throw new Exception('Invalid Width');

    if (!preg_match('/^#[a-f0-9]{6}$/i', $color))
        throw new Exception('Invalid Background Color');

    $hex = str_replace("#", "", $color);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }

    $imageOri = dirname(__FILE__) . '/files/' . session_id() . '/' . $_SESSION['file_name'];

    $path_info = pathinfo($imageOri);
    $extension = $path_info['extension'];

    // Get sizes
    list($widthOri, $heightOri) = @getimagesize($imageOri);

    $newDimX = $widthOri;

    if ($heightOri > $widthOri)
        $newDimX = $heightOri;

    if (!$widthOri && !$heightOri)
        throw new Exception('Image is Not Valid Image');

    $extension = strtolower($extension);
    if ($extension == "gif") {
        $img = imagecreatefromgif($imageOri);
    } else if ($extension == "png") {
        $img = imagecreatefrompng($imageOri);
    } else {
        $img = imagecreatefromjpeg($imageOri);
    }


    $background = imagecreatetruecolor($newDimX, $newDimX);
    $backgroundColor = imagecolorallocate($background, $r, $g, $b);
    imagefill($background, 0, 0, $backgroundColor);

    $sourceX = ceil(($newDimX - $widthOri) / 2);
    $sourceY = ceil(($newDimX - $heightOri) / 2);

    imagecopy($background, $img, $sourceX, $sourceY, 0, 0, $widthOri, $heightOri);


    $image_p = imagecreatetruecolor($width, $width);
    imagecopyresampled($image_p, $background, 0, 0, 0, 0, $width, $width, $newDimX, $newDimX);

    if (!is_dir(dirname(__FILE__) . '/files/' . session_id() . '/boxed/'))
        mkdir(dirname(__FILE__) . '/files/' . session_id() . '/boxed/', 0777, true);

    if ($extension == "gif") {
        $res = imagegif($image_p, dirname(__FILE__) . '/files/' . session_id() . '/boxed/' . $_SESSION['file_name']);
    } else if ($extension == "png") {
        $res = imagepng($image_p, dirname(__FILE__) . '/files/' . session_id() . '/boxed/' . $_SESSION['file_name'], 96);
    } else {
        $res = imagejpeg($image_p, dirname(__FILE__) . '/files/' . session_id() . '/boxed/' . $_SESSION['file_name'], 96);
    }




    if (!$res)
        throw new Exception('Failed To Create Boxed Image');


    $result['url'] = get_full_url() . '/files/' . session_id() . '/boxed/' . $_SESSION['file_name'];
    $result['width'] = $width;
    $result['color'] = $color;
} catch (Exception $e) {
    $result['error'] = $e->getMessage();
}

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

header('Content-type: application/json');
echo json_encode($result);





