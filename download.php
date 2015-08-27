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

function output_file($Source_File, $Download_Name, $mime_type='')
{
    /*
   $Source_File = path to a file to output
   $Download_Name = filename that the browser will see
   $mime_type = MIME type of the file (Optional)
   */
    if(!is_readable($Source_File)) die('File not found or inaccessible!');

    $size = filesize($Source_File);
    $Download_Name = rawurldecode($Download_Name);

    /* Figure out the MIME type (if not specified) */
    $known_mime_types=array(
        "pdf" => "application/pdf",
        "csv" => "application/csv",
        "txt" => "text/plain",
        "html" => "text/html",
        "htm" => "text/html",
        "exe" => "application/octet-stream",
        "zip" => "application/zip",
        "doc" => "application/msword",
        "xls" => "application/vnd.ms-excel",
        "ppt" => "application/vnd.ms-powerpoint",
        "gif" => "image/gif",
        "png" => "image/png",
        "jpeg"=> "image/jpg",
        "jpg" =>  "image/jpg",
        "php" => "text/plain"
    );

    if($mime_type==''){
        $file_extension = strtolower(substr(strrchr($Source_File,"."),1));
        if(array_key_exists($file_extension, $known_mime_types)){
            $mime_type=$known_mime_types[$file_extension];
        } else {
            $mime_type="application/force-download";
        };
    };

    @ob_end_clean(); //off output buffering to decrease Server usage

    // if IE, otherwise Content-Disposition ignored
    if(ini_get('zlib.output_compression'))
        ini_set('zlib.output_compression', 'Off');

    header('Content-Type: ' . $mime_type);
    header('Content-Disposition: attachment; filename="'.$Download_Name.'"');
    header("Content-Transfer-Encoding: binary");
    header('Accept-Ranges: bytes');

    header("Cache-control: private");
    header('Pragma: private');
    header("Expires: Thu, 26 Jul 2012 05:00:00 GMT");

    // multipart-download and download resuming support
    if(isset($_SERVER['HTTP_RANGE']))
    {
        list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
        list($range) = explode(",",$range,2);
        list($range, $range_end) = explode("-", $range);
        $range=intval($range);
        if(!$range_end) {
            $range_end=$size-1;
        } else {
            $range_end=intval($range_end);
        }

        $new_length = $range_end-$range+1;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range-$range_end/$size");
    } else {
        $new_length=$size;
        header("Content-Length: ".$size);
    }

    /* output the file itself */
    $chunksize = 1*(1024*1024); //you may want to change this
    $bytes_send = 0;
    if ($Source_File = fopen($Source_File, 'r'))
    {
        if(isset($_SERVER['HTTP_RANGE']))
            fseek($Source_File, $range);

        while(!feof($Source_File) &&
            (!connection_aborted()) &&
            ($bytes_send<$new_length)
        )
        {
            $buffer = fread($Source_File, $chunksize);
            print($buffer); //echo($buffer); // is also possible
            flush();
            $bytes_send += strlen($buffer);
        }
        fclose($Source_File);
    } else die('Error - can not open file.');

    die();
}


$base_id = $_GET['base_id'];
$id = $_GET['id'];

try {
    if (!$base_id || !$id)
        throw new Exception('Wrong Parameter');

    $highResFile = get_full_url() . '/files/' . $base_id . '/boxed/' . $id;
    $thumbFile = get_full_url() . '/files/' . $base_id . '/boxed/thumbnail' . $id;

    if (!is_file($highResFile) || !is_file($thumbFile))
        throw new Exception('File Not Found');


    output_file($highResFile, $id);

} catch (Exception $e) {
    header('Location: 404.html');
    exit();
}