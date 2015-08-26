<?php session_start();

require('UploadHandler.php');
$upload_handler = new UploadHandler(
    array(
        'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
        'user_dirs'         => true,
        'print_response'    => false,
    )
);

//get default
$responseFromUploader = $upload_handler->get_response();
$files = $responseFromUploader['files'];
$absPath = false;
foreach ($files as $file) {
    $absPath = $file->name;
}


header('Content-type: application/json');
echo json_encode($upload_handler->get_response());