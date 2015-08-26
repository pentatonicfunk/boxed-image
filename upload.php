<?php session_start();
$_SESSION['file_name'] = false;
require('UploadHandler.php');
$upload_handler = new UploadHandler(
    array(
        'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
        'user_dirs'         => true,
        'print_response'    => false,
        'image_versions'    => array(
            // The empty image version key defines options for the original image:
            '' => array(
                // Automatically rotate images based on EXIF meta data:
                'auto_orient' => true
            ),
            'thumbnail' => array(
                'max_width'  => 200,
                'max_height' => 200,
            ),
        ),

    )
);

//get default
$responseFromUploader = $upload_handler->get_response();
$files = $responseFromUploader['files'];
$absPath = false;
foreach ($files as $file) {
    $_SESSION['file_name'] = $file->name;
}


header('Content-type: application/json');
echo json_encode($upload_handler->get_response());