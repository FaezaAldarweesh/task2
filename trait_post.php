<?php

trait traitPost { 
    //تابع عرض البوستات كاملا ----------------------------------------------------------------------------------------------------------------
    public function viewAll() { ?>
        <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>title</th>
                <th>content</th>
                <th>author</th>
                <th>created at</th>
                <th>updated at</th>
                <th>view post</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>

        <?php
        $stmt = $this->connection->prepare("SELECT * FROM posts");
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
            <tbody>
                <tr>
                    <td><?php echo $row['title'] ?></td>
                    <td><?php echo $row['content'] ?></td>
                    <td><?php echo $row['author'] ?></td>
                    <td><?php echo $row['created_at'] ?></td>
                    <td><?php echo $row['updated_at'] ?></td>
                    <td><a href="view_post.php?view_post=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View Post</a></td>
                    <td><a href="edit_post.php?edit_post=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit Post</a></td>
                    <td><a href="delete_post.php?delete_post=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete Post</a></td>
                </tr>    
            </tbody>
        <?php } } ?>  
        </table>
    <?php }

    //تابع أضافة بوست -----------------------------------------------------------------------------------------------------------------------
    public function insert($title,$content,$author,$created_at,$updated_at) {
        $stmt = $this->connection->prepare("INSERT INTO posts (title, content, author, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss",$title ,$content ,$author ,$created_at ,$updated_at);
        $stmt->execute();
        header("Location:list_post.php");
    }

    //تابع عرض بوست محدد --------------------------------------------------------------------------------------------------------------------
    public function view_post($id) {
        return $this->connection->query("SELECT * FROM posts WHERE id = $id");
    }

    //تابع التعديل على بوست ----------------------------------------------------------------------------------------------------------------
    public function edit($id,$title,$content,$author,$updated_at) {
        $stmt = $this->connection->prepare("UPDATE posts SET title = ? , content = ? , author = ?, updated_at = ? WHERE id = '$id'");
        $stmt->bind_param("ssss",$title ,$content ,$author ,$updated_at);
        $stmt->execute();
        header("Location:list_post.php");
    }
    
    //تايع حذف بوست --------------------------------------------------------------------------------------------------------------------------
    public function destroy() {
        if(isset($_GET['delete_post'])) {
            $id = $_GET['delete_post'];
            $stmt = $this->connection->prepare("DELETE FROM posts WHERE id = '$id'");
            $stmt->execute();
            header("Location:list_post.php");
        }
    }
}

?>