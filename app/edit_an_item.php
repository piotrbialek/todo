<?php
require_once '../src/autoloader.php';
require_once '../src/db_config.php';
session_start();

use ToDo\Item\Item;
use ToDo\ItemRepository\ItemRepository;
use ToDo\Validator\Validator;

if (empty($_GET['id'])) {
    header("Location: list_all_items.php");
} else {
    $message = "";
    $validator = new Validator();
    $findItem = new \ToDo\Db\ItemTable(DB_HOST, DB_NAME, DB_USER, DB_PASS);
    $id = intval($_GET['id']);
    $current = $findItem->fetchId($id);
    $currentName = $current->getName();
    $currentDeadline = $current->getDeadline();


    if (isset($_POST['edit'])) {
        $name = $_POST['name'] ?? null;
        $deadline = $_POST['deadline'] ?? null;
        $item = new Item();
        $repository = new ItemRepository(new \ToDo\Db\ItemTable(DB_HOST, DB_NAME, DB_USER, DB_PASS));

        if ($validator->isValid($name) &&
            !is_null($name) &&
            !is_null($id)
        ) {
            if ($repository) {
                $item->setId($id);
                $item->setName($name);
                $item->setDeadline($deadline);
                if ($result = $repository->edit($item)) {
                    $_SESSION['message'] = "Item " . $id . " edited";
                    $message = "edited successfully";
                    header("Location: list_all_items.php");
                } else {
                    $message = "there was a problem with editing item, try again";
                }
            }
        } else {
            $message = "Item is not valid";
        }
    }
    unset($_SESSION['message']);
}

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>add new item</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <!--    <link rel="stylesheet" href="css/styles.css?v=1.0">-->

</head>

<body>
<div class="col-md-4 col-md-offset-3">
    <h3>edit an item</h3>
    <h4 class="bg-danger">
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
    </h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="name">Item</label>
            <input type="text" class="form-control" name="name" value="<?php echo $currentName; ?>" required>
            <label for="deadline">Deadline</label>
            <input type="date" class="form-control" name="deadline" value="<?php echo $currentDeadline;?>" required>
        </div>

        <div class="form-group">
            <input type="submit" name="edit" value="Edit Item">
        </div>

    </form>


</div>


<!--<script src="js/scripts.js"></script>-->
</body>
</html>