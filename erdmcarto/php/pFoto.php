<?php  

$file_1 = 'https://gallant-driscoll.198-71-62-113.plesk.page/fotosZapopan/Ortofoto%202016/1114326623_1.png';
$file_headers_1 = @get_headers($file_1);
if(!$file_headers_1 || $file_headers_1[0] == 'HTTP/1.1 404 Not Found') {
    echo 'NO existe';
}
else {
    echo 'si existe';
}















?>









