<?php
//sanitize data from new inputs (new to do items)
$newTitle = filter_input(INPUT_POST, "newTitle", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

$id = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);

if ($newTitle == null) {
    $error = "To do list item needs a title. Check fields and try again.";
    echo $error;
} else {
    require_once('database.php');

//add item to "To do" list
    $query = 'INSERT INTO todolist
                    (Title,Description)
                VALUES
                    (:newTitle, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':newTitle', $newTitle);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();

//display To Do list
    include('index.php');
}
?>