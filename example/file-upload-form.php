<?php

require_once __DIR__.'/ImPro/image-processor.php';

if(isset($_POST['upload_gambar'])){
    $image = new \ImPro\Image\placer(__DIR__.'/storage/');
    $result = $image->post('upload_gambar');
    if($result['status']['success']){
        echo $result['reason']."\n";
    }else{
        echo $result['reason']."\n";
    }
}

?>
<form action="." method="POST" enctype="multipart/form-data">
    <input type="file" name="upload_gambar" accept="image/*">
    <input type="submit" value="submit">
</form>
