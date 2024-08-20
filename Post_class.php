<?php

include_once('Database_class.php');
include_once('trait_post.php');

// صف يرث من صف القاعدة من أجل توصيف تنفيذ التوابع صمنه
class Post extends Database {

    use traitPost; 

    public $title; 
    public $content; 
    public $author; 
    public $created_at; 
    public $updated_at; 
    
    //تم نتقل توصيف التوابع إلى trait

    //تابع باني لإنشاء الاتصال بقاعدة البيانات
    public function __construct() {
        $this->connect();
    }
    //تابع عرض البوستات كاملا
    public function listAll(){
        $this->viewAll();
    }
    //تابع أضافة بوست
    public function create($title,$content,$author,$created_at,$updated_at){
        $this->insert($title,$content,$author,$created_at,$updated_at);
    }
    //تابع عرض بوست محدد
    public function read($id){
        $this->view_post($id);
    }
    //تابع التعديل على بوست
    public function update($id,$title,$content,$author,$updated_at){
        $this->edit($id,$title,$content,$author,$updated_at);
    }
    //تايع حذف بوست
    public function delete(){
       $this->destroy();
    }
    //تابع هادم
    public function __destruct(){}
}

?>