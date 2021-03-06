<?php
/**
 * Main user page for listings
 */
session_start();
include('database.php');
$check = "True";

if($_SESSION['logged_in'] != $check){
    header('location:index.html');
}


$sql2 = "SELECT * FROM department";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$department = $stmt2->fetchAll();


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql3 = "SELECT * FROM user WHERE email = :user";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bindValue(':user', $email);
    $stmt3->execute();
    $user = $stmt3->fetchAll();
    foreach($user as $users) {
        $firstName = $users['firstName'];
        $lastName = $users['lastName'];
    }
}else
{
    $email = NULL;
    $firstName = '';
    $lastName = '';
}
///////////////////////
if (isset($_GET['min'])){
    $min = $_GET['min'];
}
else
{
    $min = NULL;
}
///////////////////////////////
if (isset($_GET['max'])){
    $max = $_GET['max'];
}
else
{
    $max = NULL;
}
//////////////////////////////////
if (isset($_GET['condition'])){
    $condition = $_GET['condition'];
}
else
{
    $condition = NULL;
}
//////////////////////////////////
if (isset($_GET['zip'])){
    $zip = $_GET['zip'];
}
else
{
    $zip = NULL;
}
///////////////////////////////////
if (isset($_GET['category'])){
    $category = $_GET['category'];
}
else
{
    $category = NULL;
}
///////////////////////////////////
if (isset($_GET['view'])){
    $view = $_GET['view'];
}
else
{
    $view = NULL;
}
/////////////////////////////////////
if (isset($_GET['search'])){
    $search = $_GET['search'];
}
else
{
    $search = NULL;
}
/////////////////////////////////////
?>

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


    <!-- START OF NAV BAR -->
    <nav class="navbar navbar-inverse" role="navigation" style="background-color:#00703C">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:#ffffff">Welcome back: <?php echo $firstName . " " . $lastName; ?></a>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="mainPage.php" style="color:#ffffff">Home</a>
                        </li>

                        <li>
                            <a href="post.php" style="color:#ffffff">Post</a>
                        </li>

                        <li>
                            <a href="account.php" style="color:#ffffff">Account</a>
                        </li>

                        <li>
                            <a href="logout.php" style="color:#ffffff">Sign Out</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--END OF NAV BAR-->
</head>

<body>
<!--START OF FILTERS/SEARCH BAR-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group" id="adv-search">
                <div class="dropdown dropdown-lg open">
                    <div class="dropdown-menu dropdown-menu-right" role="menu" style="position:absolute; right:70%; width:1px">

                        <form class="form-horizontal" role="form" method="post" action="filters.php" >
                            <div class="form-group">
                                <label for="filter">Filter By</label>
                                <select class="form-control" name="Category">
                                    <option selected>Departments</option>
                                    <?php foreach($department as $departments){ ?><option value="<?php echo $departments['name'];?>"><?php echo($departments['name']); }?></option></select>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="contain">Price</label>
                                <input class="form-control" type="text" placeholder="minimum" name = "min"/>
                                <input class="form-control" type = "text" placeholder="maximum" name = "max"/>
                            </div>

                            <div class="form-group">
                                <label for="contain">Condition</label><br>
                                <input type="radio" name="condition" value="new">New<br>
                                <input type="radio" name="condition" value="used">Used<br>
                            </div>

                            <div class="form-group">
                                <label for="filter">View</label>
                                <select class="form-control" name="view">
                                    <option value="view" selected>View</option>
                                    <option value="list">List</option>
                                    <option value="pic">Pictures</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" style="background-color: #00703C; color:#ffffff">
                                Apply Filters
                            </button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<!--END OF FILTERS/SEARCH BAR-->


<!--  <form action="filter.php" mehtod="post"> -->
<div style="padding:10px;margin:20px 10px 10px 10px; position:absolute; left:550px; top:100px;">
    <input type="text" name="search" placeholder="Search by title or ISBN..">
</div>
<!-- </form>  -->


<div style="position:absolute; left:600px; top:200px;">
    <b><u>MOST RECENT POSTS</u></b><br>



    <?php
    ///////////////////////Apply different SQL statements based off of what the user wants to filter the listings by////////////////////////////

    $line = "SELECT * FROM listing";

    $first = TRUE;
    if ($category != 'Departments' && $category != NULL) {
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " department = '" . $category . "'";
    }

    if ($condition != "") {
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " status = '" . $condition . "'";
    }
    //////////////////////////////////
    if ($search != "") {
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";

            $lastChar = substr($search, -1);
            $stringToInt = (int)$lastChar;

            if($stringToInt == 0){
                $line = $line . " title = '" . $search . "'";
            }
            else{
                $line = $line . " isbn = '" . $search . "'";
            }
        }
        else {
            $line = $line . " AND ";

            $lastChar = substr($search, -1);
            $stringToInt = (int)$lastChar;

            if($stringToInt == 0){
                $line = $line . " title = '" . $search . "'";
            }
            else{
                $line = $line . " isbn = '" . $search . "'";
            }
        }
    }

    /////////////////////////////////////////////////////
    if(($min != 'min' && $max == 'max') && ($min != NULL && $max != NULL)){
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " price >= '" . $min . "'";
    }


    if(($max != 'max' && $min == 'min') && ($min != NULL && $max != NULL)){
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " price <= '" . $max . "'";
    }

    if(($max != 'max' && $min != 'min') && ($min != NULL && $max != NULL)){
        if ($first) {
            $first = FALSE;
            $line = $line . " WHERE";
        } else {
            $line = $line . " AND ";
        }
        $line = $line . " price <= '" . $max . "'" . " AND " . " price >= '" . $min . "'";
    }

    if($min == 'min' && $max == 'max' && $condition == '' && $zip == '' && $view == 'view' && $category == 'Categories' && $search == '')
    {
        $line = "SELECT * FROM listing ORDER BY listingID DESC";
    }

    if($line == "SELECT * FROM listing")
    {
        $line = $line . " ORDER BY listingID DESC ";
    }

    $stmt = $conn->prepare($line);
    $stmt->execute();
    $listing = $stmt->fetchAll();

    ?>
    <?php if ($view == 'list'){  ?>

        <?php foreach ($listing as $listings) : ?>

            <?php echo $listings['date']; ?><a href="listing.php?ID=<?php echo $listings['listingID']; ?>">
            <?php echo $listings['title']; ?> </a> <?php echo '$'. $listings['price'];?><br>
        <?php endforeach; ?>

    <?php } ?>


    <?php if ($view == 'pic'){  ?>
        <?php foreach ($listing as $listings) : ?>

            <table style="width:100%">
            <tr>
            <td>
            <?php echo $listings['date']; ?><a href="listing.php?ID=<?php echo $listings['listingID']; ?>">
            <?php echo '<img src="'.$listings['image'].'" width="200px" height="200px"><br>'; ?> </a> <?php echo '$'. $listings['price'];?><br>
        <?php endforeach; ?>
        </td>
        </tr>
        </table>

    <?php } ?>

    <?php if ($view == 'view' || $view == ''){  ?>

        <?php foreach ($listing as $listings) : ?>


            <?php echo $listings['date']; ?><a href="listing.php?ID=<?php echo $listings['listingID']; ?>">
            <?php echo $listings['title']; ?> </a> <?php echo '$'. $listings['price'];?><br>
        <?php endforeach; ?>

    <?php } ?>



</div>
</body>
</html>
