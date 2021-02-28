<?php include('header.php') ?>

<!-- if there are items in the to do list already -->
<?php if (!empty($items)) { ?>
    <section>
        <!--view to do list by category-->
        <label for='viewByCategory'><h5>View list by category: </h5></label>
        <form action="." method="GET" id='list__header_select'>
            <input type='hidden' name='action' value='view_by_category'>

            <select name="category_id">
            <option value="0"> All Categories </option>
            <?php foreach ($categories as $category) : ?>
            <?php if ($category_id == $category['categoryID']) {?>
                <option value="<?=$category['categoryID'] ?>" selected>
                    <?php } else { ?>
                <option value="<?=$category['categoryID'] ?>">
                    <?php } ?>
                <?=$category['categoryName'] ?>
                </option>
            <?php endforeach; ?>
            </select> &nbsp; &nbsp; 

            <button class="btn btn-primary">View Category</button>
        </form>
    <br>

    <section>
        <!-- iterate through the array to display all results -->
        <?php foreach ($items as $item) :
            $itemNum = $item['ItemNum'];
            $title = $item['Title'];
            $description = $item['Description']; 
            $categoryID = $item['categoryID'];
            $categoryName = $item['categoryName'];
        ?>
        
        <!--grid layout for to do items-->
        <div class="container">
            <div class="row"><hr>
                <div class ="col-2">
                    <p><i><?php
                            if (!$categoryID) {
                                echo 'None';
                            } else {
                                echo $categoryName; } ?></i></p>
                </div>
                <div class="col-7">
                    <b><?php echo $title?></b>
                    <p><?php echo $description?></p>
                </div>
                <div class="col-3">
                    <form action="." method="POST">
                        <input type="hidden" name="action" type="delete_item">
                        <input type="hidden" name="itemNum" value="<?=$itemNum;?>">
                        <?=$itemNum?>
                        <button class="btn btn-danger">Done!</button>
                    </form>
                </div><hr>
            </div>
        </div>
        <?php  endforeach; 
         } else { ?>
        
        <!--there is no data in table-->
        <h2>No to do list items exist yet.</h2>
        <?php }?>
    </section>
    <br><br>
        
    <section>
        <!--add new item to do list-->
        <h4>Add Item:</h4>
        <form action="." method="POST">
            <input type='hidden' name='action' value='insert_item'>
            <label>Category: &nbsp; &nbsp;</label>

            <select name="category_id" required>
                <?php foreach ($categories as $category) : ?>
                <option value="<?=$category['categoryID']?>">
                    <?=$category['categoryName']?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label for='title'>Title Name:</label>
            <input type="text" id='title' max='20' name='title' required>
            <br>
            
            <label for='description'>Description:</label>
            <input type="text" id='description' max='50' name='description'>
            <button class="btn btn-primary">Submit</button>
        </form>
    </section>

    <br>
        <form action="." method='POST' id='editting_categories'>
            <input type='hidden' name='action' value='edit_categories'>
            <button class="btn btn-info">Edit Categories</a></button>
        </form>
    </section>

<?php include('footer.php') ?>