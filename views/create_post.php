<?php

include_once("../Validation_class.php");

//التحقق من وصول عملية إضافة من تمط post
if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST["add_post"]))){

    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_POST["author"];
    $created_at = $_POST["created_at"];
    $updated_at = $_POST["updated_at"];

    //تعريف غرض من صف ال validation و ارسال كل مدخل لتابعه المخصص لتحقق من صحته
    $create_post = new Validation();

    $create_post->set_title($title);
    $create_post->set_content($content);
    $create_post->set_author($author);

    //في حال نجاح عمليات التحقق يتم إنشاء غرض من صف البوست و إستدعاء تابع الإضافة
    if($create_post){
        $insert_post = new Post();
        $insert_post->create($title,$content,$author,$created_at,$updated_at);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Post</title>
</head>
<body class="container mt-5">

    <h2 class="mb-4">Add Post Form</h2>

    <button class="btn btn-primary mb-4"><a href="list_post.php" class="text-white text-decoration-none">Back</a></button>

    <!-- طباعة رسائل الخطأ القادمة من صف ال Validation -->
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php
                switch($_GET['error']) {
                    case 1: echo 'Post already exists'; break;
                    case 2: echo 'The title post is required'; break;
                    case 3: echo 'The title post must contain only letters'; break;
                    case 4: echo 'The content post is required'; break;
                    case 5: echo 'The content post must contain only letters'; break;
                    case 6: echo 'The author post is required'; break;
                    case 7: echo 'The author post must contain only letters'; break;
                }
            ?>
        </div>
    <?php endif; ?>
    <!-- فورم الإضافة -->
    <form action="" method="POST" class="border p-4 rounded bg-light">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input type="text" class="form-control" name="content">
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" name="author">
        </div>

        <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">

        <button type="submit" name="add_post" class="btn btn-primary">Add Post</button>

    </form>

</body>
</html>





