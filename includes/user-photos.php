<?
include_once("./db.php");
$login = userInfo();
// var_dump($_FILES);
$photos = $_FILES["photos"];
foreach ($photos["name"] as $key => $name) {
    $rand_name = md5(time()) . "-$key";
    $photoExt = pathinfo($name, PATHINFO_EXTENSION);
    $photoName = "{$login["user_login"]}-$rand_name.$photoExt";
    $dirNamePhoto = "./img/users/$photoName";
if ($name) {
    $addPhoto = addUserPhotos($dirNamePhoto);    
}
    if ($addPhoto) {
        move_uploaded_file($photos["tmp_name"][$key], ".$dirNamePhoto");
    }
}

header("Location:/?route=edit");
