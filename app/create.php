<?php
require_once '../src/db_config.php';
require_once '../src/autoloader.php';
session_start();


use ToDo\Item\Item;
use ToDo\ItemRepository\ItemRepository;
use ToDo\Validator\Validator;

?>

<?php

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
} else {
    $message = "";
}

if (isset($_POST['add_item'])) {

    $validator = new Validator();
    $name = trim($_POST['name']);
    $deadline = trim($_POST['deadline']);

    if ($validator->isRealDate($deadline)) {
        if ($validator->isValid($name)) {
            $item = new Item();
            $item->setName($name);
            $item->setDeadline($deadline);
            $repository = new ItemRepository(new \ToDo\Db\ItemTable(DB_HOST, DB_NAME, DB_USER, DB_PASS));
            $result = $repository->save($item);
            if ($result) {
                $_SESSION['message'] = "Item '" . $name . "' added successfully";
                header("Location: list_all_items.php");
            } else {
                $message = "there was a problem with adding item, try again";
            }
        } else {
            $message = "Item is not valid";
        }
    } else {
        $message = "wrong date format: " . $deadline;
    }

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
    <h3>add new item</h3>

    <h4 class="bg-danger"><?php
        if (isset($message)) {
            echo $message;
        }
        ?>
    </h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="name">Item</label>
            <input type="text" class="form-control" name="name" value="">
            <label for="deadline">Deadline</label>
            <input type="date" class="form-control" name="deadline" value="0001-01-01">

        </div>
        <div>
            <ul>
                <li><a href="create.php">add new item</a></li>
                <li><a href="list_all_items.php">all items</a></li>
            </ul>
        </div>

        <div class="form-group">
            <input type="submit" name="add_item" value="Add task" class="btn btn-primary">
        </div>

    </form>


</div>


<!--<script src="js/scripts.js"></script>-->
</body>
</html>