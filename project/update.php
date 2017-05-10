<?php
/**
 * Update page
 */
include('database.php');
$listingID = $_POST['update'];

$sql = "SELECT * FROM listing WHERE listingID=". $listingID . "";
$stmt = $conn->prepare($sql);
$stmt->execute();
$listing = $stmt->fetchAll();

$sql2 = "SELECT * FROM department";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$department = $stmt2->fetchAll();

foreach ($listing as $listings){
    $departmentName = $listings['department'];
    $bookTitle = $listings['title'];
    $author = $listings['author'];
    $price = $listings['price'];
    $ISBN = $listings['isbn'];
    $description = $listings['description'];
    $condition = $listings['status'];
    $contact = $listings['contact'];


}

?>

<html>
<form method="post" action="updateHandler.php" enctype="multipart/form-data">
Category/Subject: <select name="Category"><?php foreach($department as $departments){ ?><option value="<?php echo $departments['name'];?>"><?php echo($departments['name']); }?></option><option value="<?php echo $departmentName;?>" selected><?php echo $departmentName;?></select><br>

Book Title: <input type = "text" value ="<?php echo $bookTitle;?>" name = "title"><br><br>

Author: <input type = "text" value ="<?php echo $author;?>" name = "author"><br><br>

Price:<input type = "text" value ="<?php echo $price;?>" name = "price"><br><br>

ISBN #:<input type = "text" value ="<?php echo $ISBN;?>" name = "isbn"><br><br>

Description:<br>

<textarea name="description" rows="7" cols="40"><?php echo $description;?></textarea><br><br>

    Condition: <input type="radio" name="condition" value="new" checked>New <input type="radio" name="condition" value="used">Used <br><br>

Contact: <input type="text" value="<?php echo $contact;?>" name="contact"><br><br>

    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="hidden" name="ID" value="<?php echo $listingID;?>">

<button type="submit" name="update">Update</button>
</form>

</html>
