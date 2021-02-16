<?php
//request to the database
require_once('database.php');

//unique ID for data -- not receiving this data from user so using "validate" instead of "sanitize"
$id = filter_input(INPUT_POST, 'ItemNum', FILTER_VALIDATE_INT);

//query to delete city if id provided
if($id) {
    $query = 'DELETE FROM todolist
                WHERE ItemNum = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
}

include('index.php');
?>