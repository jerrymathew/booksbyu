<?php
/**
 * Sign up handler
 */

include('database.php');


$error = 0;

$password = $_POST['password'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$lastname = $_POST['lastname'];
$confirmpassword = $_POST['confirmpassword'];

/////////////CHECK IF EMAIL EXISTS////////////

$sql = "SELECT * FROM user";
$stmt = $conn->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll();

foreach($user as $users){
    if($email == $users['email']){
       $error = 1;
        header('location:signup.php?error='.$error);
        break;
    }
}
///////////////////PASSWORD//////////////////////
if(preg_match('/^(.{0,7}|[^A-Z]*|[a-zA-Z0-9]*)$/', $password))
{
    $error = 2;
    header('location:signup.php?error='.$error);
}

///////////////////FIRST NAME//////////////////////
elseif(!preg_match('/^[a-zA-Z]+$/', $firstname))
{
    $error = 3;
    header('location:signup.php?error='.$error);
}

///////////////////LAST NAME//////////////////////
elseif(!preg_match('/^[a-zA-Z]+$/', $lastname))
{
    $error = 3;
    header('location:signup.php?error='.$error);
}

///////////////////CONFIRM PASSWORD///////////////
elseif($password != $confirmpassword)
{
    $error = 4;
    header('location:signup.php?error='.$error);
}

///////////////////EMAIL//////////////////////
elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@uncc+\.edu$/", $email)) {
    $error = 5;
    header('location:signup.php?error='.$error);
}
else{
    $stmt = $conn->prepare("INSERT INTO user (email, password, firstName, lastName) VALUES (:email, :password, :firstname, :lastname)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->execute();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registration Handler</title>
    <!-- Framework CSS -->
    <link rel="stylesheet" href="screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="print.css" type="text/css" media="print">
    <!--[if lt IE 8]><link rel="stylesheet" href="ie.css" type="text/css" media="screen, projection"><![endif]-->
</head>
<body>
<div class="container">
    <h1>Registration Complete</h1>
    <hr>
    <div class="span-3">
        <br/>
    </div>
    <div class="span-18">
        <div class="success">
            User successfully registered. <a href="index.html">Login</a>.
        </div>
    </div>
    <div class="span-3 last">
        <br/>
    </div>
</div>
</body>
</html>