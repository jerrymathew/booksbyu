<?php
/**
 * Posting a listing for a user
 */
include('database.php');
session_start();
$sql = "SELECT * FROM department";
$stmt = $conn->prepare($sql);
$stmt->execute();
$department = $stmt->fetchAll();

$email = $_SESSION['email'];

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE-edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
    <meta name="description" content>
    <meta name="author" content>
    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Books By U</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Books By U</a>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="mainPage.php">Home</a>
                    </li>

                    <li>
                        <a href="account.php">Account</a>
                    </li>

                    <li>
                        <a href="logout.php" style="color:#ffffff">Sign Out</a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</nav>



<form action="listingHandler.php" method="post" enctype="multipart/form-data">

Category/Subject: <select name="Category"><?php foreach($department as $departments){ ?><option value="<?php echo $departments['name'];?>"><?php echo($departments['name']); }?></option></select><br>

Book Title: <input type = "text" name = "title"><br><br>

    Author: <input type = "text"  name = "author"><br><br>

Price:<input type = "text" name = "price"><br><br>

ISBN #:<input type = "text" name = "isbn"><br><br>

 <textarea name="description" rows="7" cols="40">Add description here.</textarea><br><br>

    Condition: <input type="radio" name="condition" value="new" checked>New <input type="radio" name="condition" value="used">Used <br><br>

Contact: <input type="text" name="contact"><br><br>
    <input type='hidden' value=<?php echo $email ?> name='email' >

    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br>

    <input type="submit" value="Submit">
</form>
</body>

</html>