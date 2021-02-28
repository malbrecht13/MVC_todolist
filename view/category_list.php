<?php include('header.php') ?>

<h5>Add a new category: </h5>
    <form action="." method="POST">
        <input type='hidden' name='action' value='add_category'>

        <label for='categoryName'>Category Name:</label>
        <input type="text" id='categoryName' max='20' name='categoryName' required> &nbsp; &nbsp;
        <button class="btn btn-primary">Submit</button>
    </form>

<br><br>
<h5>Delete a category: </h5>
    <form action="." method="POST">
        <input type='hidden' name='action' value='delete_category'>
        <label>Choose Category: &nbsp; &nbsp;</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category) : ?>
                <option value="<?=$category['categoryID']?>">
                <?=$category['categoryName']?>
                </option>
        <?php endforeach; ?>
        </select>&nbsp; &nbsp;

        <button class="btn btn-danger">Delete Category</button>
    </form>
<br><br>
<a href=".">Return to "To Do List"</a>

<?php include('footer.php') ?>