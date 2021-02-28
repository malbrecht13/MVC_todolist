<?php
require('model/database.php');
require('model/category_db.php');
require('model/item_db.php');

$itemNum = filter_input(INPUT_POST, 'itemNum', FILTER_VALIDATE_INT);

$categoryID = filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
$categoryID = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT);

$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

$categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
$categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);

//check for action in forms - default to "To do list"
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = 'item_list';
    }
}

switch($action) {
    //delete to do list item
    case 'delete_item' :
        $count = delete_todolist_item($itemNum);
        header('Location: .?action=defaul&deleted={$count}');
        break;
    
    //insert a new to do item
    case 'insert_item' : 
        add_todolist_item($title, $description, $categoryID);
        header('Location: .?itemAdded');
        break;

    //view list by category
    case 'view_by_category' : 
        get_items_by_category($categoryID);
        header('Location: .?category={$categoryID}');
        break;

    case 'edit_categories' :
        $categories = get_categories();
        include('view/category_list.php');
        break;

    case 'add_category':
        add_category($categoryName);
        header('Location: .?category_added');
        break;

    case 'delete_category':
        delete_category($categoryID);
        header('Location: .?action=edit_categories&{$categoryID}=deleted');
        break;

    default:
        $category_name = get_category_name($categoryID);
        $categories = get_categories();
        $items = get_items_by_category($categoryID);
        include('view/item_list.php');
}