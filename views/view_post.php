<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>View Post</title>
</head>
<body class="container mt-5">

    <h2 class="mb-4">Post Details</h2>

    <button class="btn btn-primary mb-4"><a href="list_post.php" class="text-white text-decoration-none">Back</a></button>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>

        <?php
        if(isset($_GET['view_post']))
            $id = $_GET['view_post'];

        include_once('../Post_class.php');
        $database = new Post();
        $connection = $database->connect();

        $sql = $connection->query("SELECT * FROM posts WHERE id = '$id' ");
        while($row = $sql->fetch_assoc()){
        ?>

        <tbody>
            <tr>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['content'] ?></td>
                <td><?php echo $row['author'] ?></td>
                <td><?php echo $row['created_at'] ?></td>
                <td><?php echo $row['updated_at'] ?></td>   
            </tr>    
        </tbody>
        
    <?php } ?>  
    </table>
</body>
</html>
