<?php session_start();

$result = array(
    'url' => '',
    'error' => false,
);
try {
    if (!$_SESSION['file_name'])
        throw new Exception('No Image Selected');

    $width = $_POST['width'];
    $color = $_POST['color'];

    if (!$width || !is_int($width) || $width > 2048)
        throw new Exception('Invalid Width');

    preg_match('^#(?:[0-9a-fA-F]{3}){1,2}$', $color, $matches);
    if (!$matches)
        throw new Exception('Invalid Background Color');

    $imageOri = dirname(__FILE__) . '/files/' .  session_id() . '/' . $_SESSION['file_name'];


    $result['width'] = $width;
    $result['color'] = $color;
} catch (Exception $e) {
    $result['error'] = $e->getMessage();
}

header('Content-type: application/json');
echo json_encode($result);


