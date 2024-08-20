<?php

include_once("../Post_class.php");

// يتم إنشاء غرض من صف البوست و إستدعاء تابع الحذف
$delete_post = new Post();
$delete_post->delete();

?>

