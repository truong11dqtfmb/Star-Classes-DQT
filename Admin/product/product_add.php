<?php
include('../../Database/config.php');
$er_file = '';
$title = $price = $decription = $introduce = $content = $author_name = $author_introduce = '';
if (isset($_POST['submit'])) {
    $check_file = true;
    $title = $_POST['title'];
    $price = $_POST['price'];
    $decription = $_POST['decription'];
    $introduce = $_POST['introduce'];
    $content = $_POST['content'];
    $cartegory_id = $_POST['cartegory_id'];

    $author_name = $_POST['author_name'];
    $author_introduce = $_POST['author_introduce'];


    $thumbnail = $_FILES['thumbnail']['name'];

    $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
    $folder_path = '../uploads/';
    $basename = basename($_FILES['thumbnail']['name']);
    $file_path   = $folder_path . basename($_FILES['thumbnail']['name']);;

    // if (file_exists($file_path)) {
    //     $er_file .= '<p style="color: red;">Files is exists</p>';
    //     $check_file = false;
    // }

    // $isimage = array('jpg', 'png', 'jpeg');
    // $tile_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    // if (!in_array($tile_type, $isimage)) {
    //     $er_file .= '<p style="color: red;">This is not an image</p>';
    //     $check_file = false;
    // }

    if ($_FILES['thumbnail']['size'] > 1000000) {
        $er_file .= '<p style="color: red;">File size is not 1000000bytes</p>';
        $check_file = false;
    }

    $author_thumbnail = $_FILES['author_thumbnail']['name'];
    $author_thumbnail_tmp = $_FILES['author_thumbnail']['tmp_name'];
    $basename_author = basename($_FILES['author_thumbnail']['name']);
    $file_path_author   = $folder_path . basename($_FILES['author_thumbnail']['name']);;

    // if (file_exists($file_path_author)) {
    //     $er_file .= '<p style="color: red;">Files is exists</p>';
    //     $check_file = false;
    // }

    // $tile_type_author = strtolower(pathinfo($file_path_author, PATHINFO_EXTENSION));
    // if (!in_array($tile_type_author, $isimage)) {
    //     $er_file .= '<p style="color: red;">This is not an image</p>';
    //     $check_file = false;
    // }

    if ($_FILES['author_thumbnail']['size'] > 1000000) {
        $er_file .= '<p style="color: red;">File size is not 1000000bytes</p>';
        $check_file = false;
    }

    if ($check_file) {
        move_uploaded_file($thumbnail_tmp, $file_path);
        move_uploaded_file($author_thumbnail_tmp, $file_path_author);
        $sql_insert = sprintf(
            "INSERT INTO product (cartegory_id,title,price,thumbnail,decription,introduce,content,author_name,author_thumbnail,author_introduce,create_at)
        VALUES (%d,'%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $cartegory_id,
            $title,
            $price,
            $basename,
            $decription,
            $introduce,
            $content,
            $author_name,
            $basename_author,
            $author_introduce,
            date('Y-m-d H:i:s')
        );
        $query = mysqli_query($con, $sql_insert);
        header('Location: product_list.php');
        return;
    }
}
?>
<?php
include_once("../_header_product.php");
?>
<h1 class="text-center">PRODUCT ADD</h1>
<div class="container product_add" style="margin-top: auto; width: 100%;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Cartegory Name: </label>
            <select name="cartegory_id" class="form-control">
                <option>--Mời bạn chọn--</option>
                <?php
                $sql_cartegory = "SELECT * FROM cartegory";
                $result_cartegory = mysqli_query($con, $sql_cartegory);

                while ($row_cartegory = mysqli_fetch_assoc($result_cartegory)) { ?>
                    <option value="<?php echo $row_cartegory['cartegory_id']; ?>"><?php echo $row_cartegory['name']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Title: </label>
            <input type="text" name="title" placeholder="Title" class="form-control" required value="<?php echo $title; ?>">
        </div>

        <div class="form-group">
            <label>Image: </label>
            <input type="file" name="thumbnail" class="form-control" required>
            <?php echo $er_file; ?>
        </div>

        <div class="form-group">
            <label>Price: </label>
            <input type="text" name="price" placeholder="Price" class="form-control" required value="<?php echo $price; ?>">
        </div>

        <div class="form-group">
            <label>Decription: </label>
            <textarea name="decription" id="decription_product" rows="10" class="form-control"><?php echo $decription; ?></textarea>
            <script>
                CKEDITOR.replace('decription_product');
            </script>
        </div>

        <!-- aloaloalo -->
        <div class="form-group">
            <label>Introduce: </label>
            <textarea name="introduce" id="introduce_product" rows="10" class="form-control"><?php echo $introduce; ?></textarea>
            <script>
                CKEDITOR.replace('introduce_product');
            </script>
        </div>

        <div class="form-group">
            <label>Content: </label>
            <textarea name="content" id="content_product" rows="10" class="form-control"><?php echo $content; ?></textarea>
            <script>
                CKEDITOR.replace('content_product');
            </script>
        </div>

        <div class="form-group">
            <label>Author Name: </label>
            <input type="text" name="author_name" placeholder="Author Name" class="form-control" value="<?php echo $author_name; ?>">
        </div>

        <div class="form-group">
            <label>Author Picture: </label>
            <input type="file" name="author_thumbnail" class="form-control">
            <?php echo $er_file; ?>
        </div>
        <div class="form-group">
            <label>Author Introduce: </label>
            <textarea name="author_introduce" id="author_introduce_product" rows="10" class="form-control"><?php echo $author_introduce; ?></textarea>
            <script>
                CKEDITOR.replace('author_introduce_product');
            </script>
        </div>
        <div class="form-group">

            <input class="btn btn-primary btn-block" type="submit" name="submit" value="ADD"></input>
        </div>

    </form>
</div>

<?php
include_once("../_footer.php");
?>