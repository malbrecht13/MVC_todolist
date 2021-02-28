<?php
    //function for categories in categories table - use to display list
    function get_categories() {
        global $db;

        $query = 'SELECT * FROM categories
                    ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();

        return $categories;
    }

    //function to get category names
    function get_category_name($categoryID) {
        global $db;
        
        $query = 'SELECT * FROM categories
                    WHERE categoryID = :categoryID';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryID', $categoryID);
        $statement->execute();
        $category = $statement->fetch();
        $statement->closeCursor();

        return $category;
    }

    //function to add category
    function add_category($categoryName){
        global $db;
        
        $query = 'INSERT INTO categories (categoryName)
                    VALUES (:categoryName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName', $categoryName);
        if ($statement->execute()) {
            $count = $statement->rowCount();
        }
        $statement->closeCursor();

        return $count;
    }

    //function to delete category
    function delete_category($categoryID) {
        global $db;
        
        $query = 'DELETE FROM categories
                    WHERE categoryID = :categoryID';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryID', $categoryID);
        $statement->execute();
        $statement->closeCursor();
    }
