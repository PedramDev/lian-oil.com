<?php
namespace Logger;

function Log($message){
    $path = LOGGER_DIR_PATH . 'logger.log';
    
    $message = time() . '        ' . $message ."     \r\n";
    file_put_contents($path, $message, FILE_APPEND);
}

?>