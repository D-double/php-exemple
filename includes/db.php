<?
function db() {
    $dbhost = "127.0.0.1";
    $dbname = "sun1400";
    $dbuser = "root";
    $dbpass = "";
    return new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);    
}

// $pass = password_hash("123", PASSWORD_BCRYPT);
// var_dump($pass);

function userAuth($login, $password) {
    $db = db();
    $query = "SELECT * FROM `users` INNER JOIN images USING(user_id) WHERE `user_login`=?";
    $select = $db->prepare($query); 
    $select->execute([$login]);
    $user = $select->fetch(PDO::FETCH_ASSOC);

    if ($login == $user["user_login"] && password_verify($password, $user["user_password"])) {
        session_start();
        $_SESSION["id"] = $user["user_id"];
        return true;
    }
    return false;
}

// userAuth("admin", "123");

function userReg($login, $pass, $name, $photo) {
    $login = strip_tags($login);
    $name = strip_tags($name);
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $db = db();
    $query = "INSERT INTO `users`(`user_login`, `user_password`, `user_name`) VALUES (?, ?, ?)";
    $create = $db->prepare($query);
    $result = $create->execute([$login, $pass, $name]);
    if ($result) {
        $userId = $db->lastInsertId();
        $imgQ = "INSERT INTO `images`(`user_id`, `img_path`, `img_select`) VALUES (?, ?, ?)";
        $imgC = $db->prepare($imgQ);
        $imgR = $imgC->execute([$userId, $photo, 1]);
    }
    return $result;
}

function userInfo() { 
    session_start();
    $db = db();
    $query = "SELECT `user_login`, `user_name`, images.img_path FROM `users` INNER JOIN images USING(user_id) WHERE user_id=? AND images.img_select=?";
    $select = $db->prepare($query); 
    $select->execute([$_SESSION["id"], 1]);
    $result = $select->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function addUserPhotos($path) {
    session_start();
    $userId = $_SESSION["id"];
    $db = db();
    $query = "INSERT INTO `images`(`user_id`, `img_path`, `img_select`) VALUES (?,?,?)";
    $create = $db->prepare($query); 
    $result = $create->execute([$userId, $path, 0]);
    return $result;
}

function getPhotos() {
    session_start();
    $db = db();
    $query = "SELECT * FROM `images` WHERE `user_id`=?";
    $select = $db->prepare($query); 
    $select->execute([$_SESSION["id"]]);
    $result = $select->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function setPhoto($imgId) {
    session_start();
    $db = db();
    $query = "UPDATE `images` SET `img_select`=? WHERE `img_select`=? AND `user_id`=?";
    $update = $db->prepare($query); 
    $result = $update->execute([0, 1, $_SESSION["id"]]);
    if ($result) {
        $query = "UPDATE `images` SET `img_select`=? WHERE `img_id`=? AND `user_id`=?";
        $update = $db->prepare($query); 
        $result = $update->execute([ 1, $imgId, $_SESSION["id"]]);
        return $result;
    } else {
        return $result;
    }
    
}

function setName($name) {
    session_start();
    $db = db();
    $query = " UPDATE `users` SET `user_name`=? WHERE `user_id`=?";
    $update = $db->prepare($query);
    $result = $update->execute([$name, $_SESSION["id"]]);
    return $result;
}

function setLogin($login) { 
    session_start();
    $db = db();
    $query = " UPDATE `users` SET `user_login`=? WHERE `user_id`=?";
    $update = $db->prepare($query);
    $result = $update->execute([$login, $_SESSION["id"]]);
    return $result;
}

function delPhoto($id) {
    session_start();
    $db = db();
    $query = "SELECT * FROM `images` WHERE `img_id`=? AND `user_id`=?";
    $select = $db->prepare($query); 
    $select->execute([$id, $_SESSION["id"]]); 
    $result = $select->fetch(PDO::FETCH_ASSOC);
    if ($result["img_select"] != 1 && $result) {
        $result = unlink(".{$result["img_path"]}");
        $query = "DELETE FROM `images` WHERE `img_id`=? AND `user_id`=? AND `img_select`=?";
        $delete = $db->prepare($query); 
        $result = $delete->execute([$id, $_SESSION["id"], 0]); 
        return $result;
    } else {
        return false;
    }
}
