<?
include_once "./db.php";

// var_dump($_FILES);
$photo = $_FILES["photo"];
$rand_name = md5(time());
$photoExt = pathinfo($photo["name"], PATHINFO_EXTENSION);
$photoName = $photo ? "{$_POST['login']}-$rand_name.$photoExt" : "default.jpg";
$dirNamePhoto = "./img/users/$photoName";
// var_dump($photoName);

$userReg = userReg($_POST["login"], $_POST["pass"], $_POST["name"], $dirNamePhoto);

if($userReg && $photo) {
        move_uploaded_file($photo["tmp_name"], "." . $dirNamePhoto);
}

header("Location:/?route=login");