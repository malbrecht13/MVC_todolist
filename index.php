<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <main>
    <div class="container">
        <header>
            <h1 style="color:blue;">To Do List</h1>
        </header>

        <?php require('database.php') ?>

        <!--query for items in todolist table-->
        <?php
        $query = 'SELECT * FROM todolist
                    ORDER BY ItemNum';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();

        //if there are items in the to do list already
        if (!empty($results)) { ?>
        <section>
           <!-- iterate through the array to display all results -->
            <?php foreach ($results as $result) {
                $id = $result['ItemNum'];
                $title = $result['Title'];
                $description = $result['Description']; 
            ?>
            
            <!--grid layout for to do items-->
            <div class="container">
                <div class="row"><hr>
                    <div class="col-sm, col-8">
                        <b><?php echo $title?></b>
                        <p><?php echo $description?></p>
                    </div>
                    <div class="col-sm, col-4">
                        <form action="delete_todo.php" method="POST">
                            <input type="hidden" name="ItemNum" value="<?php echo $id; ?>">
                            <button class="btn btn-danger"><ion-icon name="checkmark-outline"></ion-icon></button>
                        </form>
                    </div><hr>
                </div>
            </div>

            <?php } 
            }  else { ?>
            <!--there is no data in table-->
            <h2>No to do list items exist yet.</h2>
            <?php }?>
        </section>
        <br><br>
            
        <section>
            <!--add new item to do list-->
            <h2>Add Item:</h2>
            <form action="add_todo.php" method="POST">
                <input type="hidden" name="ItemNum" value='<?php echo $id ?>'>
                <label for='newTitle'>Title Name:</label>
                <input type="text" id='newTitle' name='newTitle' required>
                <br>
                <label for='description'>Description:</label>
                <input type="text" id='description' name='description'>
                <button class="btn btn-primary">Submit</button>
            </form>
        </section>

    </div>
    </main>

    <!--ion icon for check mark-->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>