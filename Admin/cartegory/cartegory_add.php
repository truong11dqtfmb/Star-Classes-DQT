<?php
include('../../Database/config.php');
$er_name = $er_exists = '';
$valid = true;

if (isset($_POST['submit'])) {
    //Check error:
    if (empty($_POST['name']) || $_POST['name'] == '') {
        $er_name .= '<p style="color: red;">Cartegory name required</p>';
        $valid = false;
    }

    $name      = htmlspecialchars($_POST['name']);

    //Check exists:
    $sql_exists = sprintf("SELECT * FROM cartegory WHERE name = '%s' ", $name);
    $result_exists = $con->query($sql_exists);

    if ($result_exists->num_rows > 0) {
        $er_exists .= "<p style='color: red;'Cartegory name already exists</p>";
        $valid = false;
    }

    //Insert:
    if ($valid == true) {
        $password = sha1($password);
        $sql_insert = sprintf("INSERT INTO cartegory(name,create_at) VALUES('%s','%s')", $name, date('Y-m-d H:i:s'));
        $result_insert = $con->query($sql_insert);
        if ($result_insert) {
            header('Location: cartegory_list.php');
            return;
        }
    }
}
?>

<?php
include_once("../_header_cartegory.php");
?>

<!-- Main -->
<main class="main">
    <div class="container">
        <h2 class="text-center text-secondary">ADD</h2>
        <div class="container" style="width: 500px; margin: auto;">
            <form action="" method="post" enctype="multipart/form">
                <div class="form-group">
                    <label>Cartegory Name: </label>
                    <input type="text" name="name" placeholder="Cartegory Name" class="form-control" required>
                    <?= $er_name ?>
                </div>
                <input class="btn btn-primary btn-block" type="submit" name="submit" value="ADD"></input>
                <?= $er_exists ?>
            </form>
        </div>
    </div>
</main>
</div>
</div>
<?php
include_once("../_footer.php");
?>