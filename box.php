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
    $result['width'] = $width;
    $result['color'] = $color;
} catch (Exception $e) {
    $result['error'] = $e->getMessage();
}

header('Content-type: application/json');
echo json_encode($result);


