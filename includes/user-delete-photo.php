<?
include_once("./db.php");
// var_dump($_GET);
$result = delPhoto($_GET["trash"]);
if ($result) {
    header("Location:/?route=edit");
} else {
    header("Location:/?route=edit&error=del");
}

