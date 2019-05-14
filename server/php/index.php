<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

//error_reporting(E_ALL | E_STRICT);
if ($_GET['file'] && isset($_GET['file'])) {
    $file = getcwd().'/'.$_GET['file'];
    if (is_file($file)) {
        unlink($file); // delete the file
    }
}
require('UploadHandler.php');
$upload_handler = new UploadHandler();
