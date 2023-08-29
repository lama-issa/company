<?php
function handleStringInputs($string){
    return strip_tags(trim($string));
}
//trim:بتشيل السبيس عن يمين ويسار السترنج
//strip_tags:اذا بعثت بالفورم الانبت على شكل تاغ <h2>lama</h2> رح يشيل التاغ 
?>