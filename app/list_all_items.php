<?php

use ToDo\Item\Item;
use ToDo\ItemRepository\ItemRepository;
use ToDo\Validator\Validator;

require_once "../src/db_config.php";
require_once "../src/autoloader.php";
session_start();

?>

<?php

$message = $_SESSION['message'] ?? "";
$repository = new ItemRepository(new \ToDo\Db\ItemTable(DB_HOST, DB_NAME, DB_USER, DB_PASS));
$validator=new Validator();

if (isset($_POST['update'])) {
    if (!empty($_POST['item'])) {
//        $updateItems = new \ToDo\Db\ItemTable(DB_HOST, DB_NAME, DB_USER, DB_PASS);
//        $items = $_POST['item'];
        $message = "";
        $results = $_POST['item'];
        foreach ($results as $result) {
            $id = intval($result);
//            $repository = new ItemRepository(new \ToDo\Db\ItemTable(DB_HOST, DB_NAME, DB_USER, DB_PASS));
            $current = $repository->getById($id);
            $name = $current->getName();
            $deadline = $current->getDeadline();
            $item = new Item();
            $item->setId($id);
            $repository->markCompleted($item) ? ($message .= "Item " . $result . " updated successfully<br>") : ($message = "problem");
        }
    } else {
        $message = "you must select items to update";
    }
}



$items = new \ToDo\Db\ItemTable(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$sort = "ASC";
$sorted=false;


//$results = $items->findAllNotCompletedItems();
$results = $repository->findAll();




//$sort=$_GET['sort']
//$sort=$_GET['sort'] === 'DESC' ?: 'ASC';

//$showCompleted= false;
//var_dump($showCompleted);
//$showCompleted = false;
//var_dump($_POST);
$showCompleted=false;

if (isset($_POST['refresh'])) {
    $showCompleted = false;
    if (isset($_POST['show'])) {
        $results = $items->findAllItems();
        $showCompleted = false;
    } else {
        $results = $items->findAllNotCompletedItems();
        $showCompleted = true;

    }
    $showCompleted = !$showCompleted;
}

$sorted = $_GET['sort'] ?? false;

//if ($sorted) {
//    if ($sorted === "ASC") {
//        $results = $items->sortAllItems($showCompleted);
//        $sort = "DESC";
//    } elseif ($sorted === "DESC") {
//        $results = $items->sortAllItemsD($showCompleted);
//        $sort = "ASC";
//    }
//echo $sorted;
//}
//
if (isset($_GET['sort'])) {
    if ($_GET['sort'] === "ASC") {
        $results=$repository->findAllSort($_GET['sort']);
        $sort = "DESC";
    } elseif ($_GET['sort'] === "DESC") {
        $results=$repository->findAllSort($_GET['sort']);
        $sort = "ASC";
    }
}


//$array['completed'] = 1;
////$array=$results;
//
////tomek
//http_build_query($array);
//$sort = $_GET['sort'] ?? 'ASC';
//$sort = $sort === 'DESC' ? 'DESC': 'ASC';
//$array['sort'] = $sort;
//http_build_query($array);
//$s=$repository->findAllSort($sort);
////var_dump($s);
//$results=$s;
////var_dump($showCompleted);
////var_dump($sorted);

?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>list all items</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="col-md-4 col-md-offset-3">
    <h3>list all items</h3>
    <h4><?php echo $message; ?></h4>
    <ul>nav:
        <li><a href="index.php">home</a></li>
        <li><a href="create.php">add new item</a></li>
    </ul>
    <form method="post">
        <a href="list_all_items.php?sort=<?php echo $sort ?>" type="submit" name="sort">Sort by deadline</a><br><br>
        <label><input type="checkbox" name="show"
                <?php
                if (!$showCompleted) {
                    echo "checked";
                }
                ?>
            >show completed</label>
        <br><br>
        <label><input type="submit" name="refresh" value="refresh"></label>
        <a href="list_all_items.php?show=<?php echo $showCompleted ?>" type="submit" name="showC">Show</a><br><br>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Completed</th>
                <th>Deadline</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($results as $item) : ?>
                <tr <?php if ($validator->checkIfPast($item->getDeadline())) echo 'style="background-color:red;"' ?>>
                    <td><?php echo $item->getId(); ?></td>
                    <td><?php echo $item->getName(); ?></td>
                    <td><label><input type="checkbox" name="item[]" value="<?php echo $item->getId(); ?>" <?php if ($item->getCompleted() == 1) echo "checked" ?>></label></td>
                    <td><?php echo $item->getDeadline();//$item->getDeadline(); ?></td>
                    <td><a href="edit_an_item.php?id=<?php echo $item->getId(); //$item->getId(); ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" name="update" value="Update">
    </form>
</div>
</body>
</html>