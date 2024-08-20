<?php

include_once("../Validation_class.php");
include_once('../Post_class.php');

//إحضار قيم البوست على حسب الId
if(isset($_GET['edit_post'])) {
    $id = $_GET['edit_post'];

    $database = new Post();
    $connection = $database->connect();

    $stmt = $connection->prepare("SELECT * FROM posts WHERE id = '$id'");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // التحقق من أن المنشور موجود
    if (!$row) {
        header('Location: list_post.php?error=post_not_found');
        exit();
    }
} else {
    header('Location: list_post.php');
    exit();
}

//التحقق من وصول عملية تعديل من تمط post---------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["edit_post"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_POST["author"];
    $updated_at = $_POST["updated_at"];

    //تعريف غرض من صف ال validation و ارسال كل مدخل لتابعه المخصص لتحقق من صحته
    $edit_post = new Validation();

    $title = $edit_post->set_edit_title($title, $id);
    $content = $edit_post->set_edit_content($content, $id);
    $author = $edit_post->set_edit_author($author, $id);

    //في حال نجاح عمليات التحقق يتم إنشاء غرض من صف البوست و إستدعاء تابع التعديل
    if ($title && $content && $author) {
        $update_post = new Post();
        $update_post->update($id, $title, $content, $author, $updated_at);
        header('Location: list_post.php?edit_success');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Post</title>
</head>
<body class="container mt-5">

    <h2 class="mb-4">Edit Post Form</h2>

    <button class="btn btn-primary mb-4">
        <a href="list_post.php" class="text-white text-decoration-none">Back</a>
    </button>

    <!-- طباعة رسائل الخطأ القادمة من صف ال Validation -->
    <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php
                switch($_GET['error']) {
                    case 1: echo 'Post already exists'; break;
                    case 2: echo 'The title is required'; break;
                    case 3: echo 'The title must contain only letters'; break;
                    case 4: echo 'The content is required'; break;
                    case 5: echo 'The content must contain only letters'; break;
                    case 6: echo 'The author is required'; break;
                    case 7: echo 'The author must contain only letters'; break;
                    case 'post_not_found': echo 'Post not found'; break;
                }
            ?>
        </div>
    <?php endif; ?>
    
   <!-- فورم التعديل -->
    <form action="" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input type="text" class="form-control" id="content" name="content" value="<?php echo $row['content']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>" required>
        </div>

        <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">

        <button type="submit" class="btn btn-primary" name="edit_post">Update Post</button>
    </form>
</body>
</html>