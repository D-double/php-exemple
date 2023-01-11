<?
include_once("./db.php");
$setPhoto = setPhoto($_POST["ava"]);
if ($setPhoto) {
    header("Location:/?route=edit");
} else {
    header("Location:/?route=404");
}
