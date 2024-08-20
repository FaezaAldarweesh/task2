<?php

include_once('Post_class.php');

// صف من أجل تحقيق عملية ال validation على المدخلات 
// استخدمت أسلوب التغليف من أجل عدم الوصول للخصائص مباشرة و التعديل عليها إلا بشروظ محددة
class Validation {
    private $title;
    private $content;
    private $author;

    //توابع تفيد في تصفية المدخلات من أي تعليمات أو محارف إشارات
    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //validation على عنوان البوست بحيث التحقق من أن العنوان لا يعود بقيمة فارغة أو أن يكون مدخل سابقا و أن يحوي فقط على أحرف مع معالجة رسائل الخطأ في كل عملية
    public function set_title($title){
        if (isset($_POST["title"]) && !empty($_POST["title"])) {
            $title = $this->test_input($_POST["title"]);

            if(!preg_match("/^[\p{L}\s]+$/u", $title)){
                header('Location:create_post.php?error=3');
                exit();
            }

            $database = new Post();
            $connection = $database->connect();

            $stmt = $connection->prepare("SELECT * FROM posts WHERE title = '$title'");
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                header('Location:create_post.php?error=1');
                exit();
            }
        } else {
            header('Location:create_post.php?error=2');
            exit();
        }

        return $title;
    }

    //validation على محتوى البوست بحيث التحقق من أن المحتوى لا يعود بقيمة فارغة و أن يحوي فقط على أحرف مع معالجة رسائل الخطأ في كل عملية
    public function set_content($content){
        if (isset($_POST["content"]) && !empty($_POST["content"])) {
            $content = $this->test_input($_POST["content"]);

            if(!preg_match("/^[\p{L}\s]+$/u", $content)){
                header('Location:create_post.php?error=5');
                exit();
            }
        } else {
            header('Location:create_post.php?error=4');
            exit();
        }

        return $content;
    }

    //validation على كاتب البوست بحيث التحقق من أن الكاتب لا يعود بقيمة فارغة و أن يحوي فقط على أحرف مع معالجة رسائل الخطأ في كل عملية
    public function set_author($author){
        if (isset($_POST["author"]) && !empty($_POST["author"])) {
            $author = $this->test_input($_POST["author"]);

            if(!preg_match("/^[\p{L}\s]+$/u", $author)){
                header('Location:create_post.php?error=7');
                exit();
            }
        } else {
            header('Location:create_post.php?error=6');
            exit();
        }

        return $author;
    }

    //validation على تعديل عنوان البوست بحيث التحقق من أن الكاتب لا يعود بقيمة فارغة و أن يحوي فقط على أحرف مع معالجة رسائل الخطأ في كل عملية
    public function set_edit_title($title, $id){
        if (isset($_POST["title"]) && !empty($_POST["title"])) {
            $title = $this->test_input($_POST["title"]);

            if(!preg_match("/^[\p{L}\s]+$/u", $title)){
                header("Location:edit_post.php?edit_post=$id&error=3");
                exit();
            }

            $database = new Post();
            $connection = $database->connect();

            $stmt = $connection->prepare("SELECT * FROM posts WHERE title = '$title' AND id != '$id'");
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                header("Location:edit_post.php?edit_post=$id&error=1");
                exit();
            }
        } else {
            header("Location:edit_post.php?edit_post=$id&error=2");
            exit();
        }

        return $title;
    }

    //validation على تعديل محتوى البوست بحيث التحقق من أن المحتوى لا يعود بقيمة فارغة و أن يحوي فقط على أحرف مع معالجة رسائل الخطأ في كل عملية
    public function set_edit_content($content, $id){
        if (isset($_POST["content"]) && !empty($_POST["content"])) {
            $content = $this->test_input($_POST["content"]);

            if(!preg_match("/^[\p{L}\s]+$/u", $content)){
                header("Location:edit_post.php?edit_post=$id&error=5");
                exit();
            }
        } else {
            header("Location:edit_post.php?edit_post=$id&error=4");
            exit();
        }

        return $content;
    }

    //validation على تعديل كاتب البوست بحيث التحقق من أن الكاتب لا يعود بقيمة فارغة و أن يحوي فقط على أحرف مع معالجة رسائل الخطأ في كل عملية
    public function set_edit_author($author, $id){
        if (isset($_POST["author"]) && !empty($_POST["author"])) {
            $author = $this->test_input($_POST["author"]);

            if(!preg_match("/^[\p{L}\s]+$/u", $author)){
                header("Location:edit_post.php?edit_post=$id&error=7");
                exit();
            }
        } else {
            header("Location:edit_post.php?edit_post=$id&error=6");
            exit();
        }

        return $author;
    }
}
?>
