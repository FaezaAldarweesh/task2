<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Posts</title>
</head>
<body class="container">
        
    <h2 class="my-4">Post Table</h2>
    
    <button class="btn btn-primary mb-4"><a href="create_post.php" class="text-white text-decoration-none">Create Post</a></button>

    <?php
    include_once("../Post_class.php");

    //إنشاء غرض من صف البوست و إستدعاء تابع العرض
    $view_post = new Post();
    $view_post->listAll();
    ?>

</body>
</html>
