<?php
/**
 * Delete confirmation
 */
$ID = $_POST['delete'];

?>

<html>
<h1>Are you sure you want to delete this listing?</h1>

<form method="post" action="deleteHandler.php">
    <input type="hidden" name="ID" value="<?php echo $ID;?>">
<button type="submit" name="deleteAccount">Yes</button>
</form>

<button type="submit" name="goBack" onClick="location.href='account.php'">No</button>


</html>
