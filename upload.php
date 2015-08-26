<?php session_start();

require('UploadHandler.php');
$upload_handler = new UploadHandler(
    array(
        'accept_file_types' => '/\.(gif|jpe?g|png)$/i'
    )
);

//header('Content-type: application/json');
//
//echo json_encode(array(
//
//                 ));