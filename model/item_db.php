<?php
    //use categoryID from categories table to pull "to do" items by category
    function get_items_by_category($categoryID) {
        global $db;

        if (!$categoryID) {
            $query = 'SELECT * FROM todolist t
                        LEFT OUTER JOIN categories c
                        ON t.categoryID = c.categoryID
                        ORDER BY t.ItemNum';
            $statement = $db->prepare($query);
            $statement->execute();
            $itemsResults = $statement->fetchAll();
            $statement->closeCursor();
        } else {
            $query = 'SELECT * FROM todolist t
                        INNER JOIN categories c
                        ON t.categoryID = c.categoryID
                        WHERE c.categoryID = :categoryID
                        ORDER BY t.ItemNum';
            $statement = $db->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->execute();
            $itemsResults = $statement->fetchAll();
            $statement->closeCursor();
            }

        return $itemsResults;
    }

    //insert item in to "to do" list
    function add_todolist_item($title, $description, $categoryID){
        global $db;
        
        $query = 'INSERT INTO todolist (Title,Description,categoryID)
                    VALUES (:title, :description, :categoryID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':categoryID', $categoryID);
        $statement->execute();
        $statement->closeCursor();
    }

    //delete item from "to do" list
    function delete_todolist_item($itemNum) {
        global $db;
        
        $query = 'DELETE FROM todolist
                    WHERE ItemNum = :itemNum';
        $statement = $db->prepare($query);
        $statement->bindValue(':itemNum', $itemNum);
        if ($statement->execute()) {
            $count = $statement->rowCount();
        }
        $statement->closeCursor();

        return $count;
    }