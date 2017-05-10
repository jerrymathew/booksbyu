
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE-edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
    <meta name="description" content>
    <meta name="author" content>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/searchFilter.css">

    <title>Books By U</title>
    <link rel="stylesheet" type="text/css" href="main.css" />


<body>

<nav class="navbar navbar-inverse" role="navigation" style="background-color:#00703C">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="color:#ffffff">Account Information</a>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="mainPage.php" style="color:#ffffff">Home</a>
                    </li>

                    <li>
                        <a href="post.php" style="color:#ffffff">Post</a>
                    </li>

                    <li>
                        <a href="logout.php" style="color:#ffffff">Sign Out</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</nav>

<div>

<h1><center>Account Info</center></h1>

<h2><u>Previous Listings</u></h2>
<?php
session_start();
include('database.php');
$email = $_SESSION['email'];
$sq3 = "SELECT * FROM listing WHERE user = :user";
$stmt3 = $conn->prepare($sq3);
$stmt3->bindValue(':user', $email);
$stmt3->execute();
$yours = $stmt3->fetchAll();
?>
<?php foreach ($yours as $you) : ?>
    <table>
<tr>
    <td><a href="listing.php?ID=<?php echo $you['listingID']; ?>">
        <?php echo $you['title']; ?> </a> <?php echo '$'. $you['price'];?></td>

    <form action="update.php" method="post">
        <td> <button type="submit" name="update" value="<?php echo $you['listingID']; ?>">Update</button>
    </form>
    </td>

    <form action="delete.php" method="post">
        <td><button type="submit" name="delete" value="<?php echo $you['listingID']; ?>">Delete</button> </td>
        </form>
    </tr>
    </table>
<?php endforeach; ?>


<button type="submit" name="deleteAccount" onClick="location.href='deleteAccount.php'" value="<?php echo $email; ?>">Delete Account</button>
    </div>
</body>
</html>

