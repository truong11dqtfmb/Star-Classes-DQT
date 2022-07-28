<?php
include_once('../../Database/config.php');
if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
}

$title = $price = $decription = $introduce = $content = $author_name = $author_introduce = '';

$sql = "SELECT * FROM product WHERE product_id = $id";
$result = $con->query($sql);
$row_up = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $thumbnail = $_FILES['thumbnail']['name'];
    $author_thumbnail = $_FILES['author_thumbnail']['name'];
    $price = $_POST['price'];
    $decription = $_POST['decription'];
    $cartegory_id = $_POST['cartegory_id'];
    $introduce = $_POST['introduce'];
    $content = $_POST['content'];
    $author_name = $_POST['author_name'];
    $author_introduce = $_POST['author_introduce'];

    if ($thumbnail == '' || empty($thumbnail) || $author_thumbnail == '' || empty($author_thumbnail)) {
        $thumbnail = $row_up['thumbnail'];
        $author_thumbnail = $row_up['author_thumbnail'];

        $sql_update = sprintf(
            "UPDATE product SET title = '%s', price = %d, decription = '%s',cartegory_id = %d, introduce = '%s', 
                content = '%s', author_name = '%s', author_introduce = '%s' , update_at = '%s'  
        WHERE product_id = %d",
            $title,
            $price,
            $decription,
            $cartegory_id,
            $introduce,
            $content,
            $author_name,
            $author_introduce,
            date('Y-m-d H:i:s'),
            $id
        );
    } else {
        $thumbnail = $_FILES['thumbnail']['name'];
        $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
        move_uploaded_file($thumbnail_tmp, '../uploads/' . $thumbnail);

        $author_thumbnail = $_FILES['author_thumbnail']['name'];
        $author_thumbnail_tmp = $_FILES['author_thumbnail']['tmp_name'];
        move_uploaded_file($author_thumbnail_tmp, '../uploads/' . $author_thumbnail);
        $sql_update = sprintf(
            "UPDATE product SET title = '%s', price = %d, 
        thumbnail = '%s', decription = '%s',cartegory_id = %d,
        introduce = '%s', content = '%s', author_name = '%s', author_thumbnail = '%s', author_introduce = '%s' ,
        update_at = '%s'  
        WHERE product_id = %d",
            $title,
            $price,
            $thumbnail,
            $decription,
            $cartegory_id,
            $introduce,
            $content,
            $author_name,
            $author_thumbnail,
            $author_introduce,
            date('Y-m-d H:i:s'),
            $id
        );
    }

    $query = mysqli_query($con, $sql_update);
    header('Location: product_list.php');
}
?>


<?php
include_once("../_header_product.php");
?>
<h1 class="text-center">PRODUCT EDIT</h1>
<div class="container" style="margin-top: auto; width: 100%;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Cartegory Name </label>
            <select name="cartegory_id" class="form-control">
                <option>--Mời bạn chọn--</option>
                <?php
                $sql_cartegory = "SELECT * FROM cartegory";
                $result_cartegory = mysqli_query($con, $sql_cartegory);

                while ($row_cartegory = mysqli_fetch_assoc($result_cartegory)) {
                    if ($row_cartegory['cartegory_id'] == $row_up['cartegory_id']) {
                        echo '<option value="' . $row_cartegory['cartegory_id'] . '" selected>' . $row_cartegory['name'] . '</option>';
                    } else {
                        echo '<option value="' . $row_cartegory['cartegory_id'] . '">' . $row_cartegory['name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Title: </label>
            <input type="text" name="title" placeholder="Title" class="form-control" required value="<?php echo $row_up['title']; ?>">
        </div>

        <div class="form-group">
            <label>Image </label>
            <input type="file" name="thumbnail" class="form-control" value="<?php echo $row_up['thumbnail']; ?>"><br>
            <img src="../uploads/<?php echo $row_up['thumbnail']; ?>" alt="<?php echo $row_up['thumbnail']; ?>" width="200px" style=" image-rendering: pixelated;object-fit: cover;">
            <p><?php echo $row_up['thumbnail']; ?></p>
        </div>

        <div class="form-group">
            <label>Price: </label>
            <input type="text" name="price" placeholder="Price" class="form-control" required value="<?php echo $row_up['price']; ?>">
        </div>

        <div class="form-group">
            <label>Decription: </label>
            <textarea name="decription" id="decription_product" rows="10" class="form-control"><?php echo $row_up['decription']; ?></textarea>
            <script>
                CKEDITOR.replace('decription_product');
            </script>
        </div>

        <!-- aloaloalo -->
        <div class="form-group">
            <label>Introduce: </label>
            <textarea name="introduce" id="introduce_product" rows="10" class="form-control"><?php echo $row_up['introduce']; ?></textarea>
            <script>
                CKEDITOR.replace('introduce_product');
            </script>
        </div>

        <div class="form-group">
            <label>Content: </label>
            <textarea name="content" id="content_product" rows="10" class="form-control"><?php echo $row_up['content']; ?></textarea>
            <script>
                CKEDITOR.replace('content_product');
            </script>
        </div>

        <div class="form-group">
            <label>Author Name: </label>
            <input type="text" name="author_name" placeholder="Author Name" class="form-control" value="<?php echo $row_up['author_name']; ?>">
        </div>

        <div class="form-group">
            <label>Author Picture: </label>
            <input type="file" name="author_thumbnail" class="form-control" value="<?php echo $row_up['author_thumbnail']; ?>"><br>
            <img src="../uploads/<?php echo $row_up['author_thumbnail']; ?>" alt="<?php echo $row_up['author_thumbnail']; ?>" width="200px" style=" image-rendering: pixelated;object-fit: cover;">
            <p><?php echo $row_up['author_thumbnail']; ?></p>
        </div>
        <div class="form-group">
            <label>Author Introduce: </label>
            <textarea name="author_introduce" id="author_introduce_product" rows="10" class="form-control"><?php echo $row_up['author_introduce']; ?></textarea>
            <script>
                CKEDITOR.replace('author_introduce_product');
            </script>
        </div>
        <div class="form-group">

        <input class="btn btn-primary btn-block" type="submit" name="submit" value="EDIT"></input>
        </div>

    </form>
</div>
</div>
</div>
<?php
include_once("../_footer.php");
?>