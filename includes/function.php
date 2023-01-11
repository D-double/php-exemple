<?
// $route = isset($_GET["route"]) ? $_GET["route"] : "home";
$route = $_GET["route"] ?? "home";
$route = is_readable( "./page/$route.php" ) ? $route : "404";

$arrayPages = [
    "home" => [ "page_name" => "Главная", "page_icon" => "fal fa-home"],
    "contact" => [ "page_name" => "Контакты", "page_icon" => "fal fa-address-book"],
    "table" => [ "page_name" => "Таблица умножения", "page_icon" => "fas fa-times"],
    "calc" => [ "page_name" => "Калькулятор", "page_icon" => "fas fa-calculator-alt"],
    "slide" => [ "page_name" => "Слайдер", "page_icon" => "far fa-presentation"],
    "guest" => [ "page_name" => "Гостевая книга", "page_icon" => "fal fa-books"],
    "test" => [ "page_name" => "Тест", "page_icon" => "fal fa-vial"],
];

date_default_timezone_set("Asia/Tashkent");
$pageTitle = $arrayPages[$route]["page_name"];
$monthRus = ["", "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
$monthNow = $monthRus[date("n")];
$pageDate = date("Сегодня d $monthNow Y год");

session_start();
$userInfo = userInfo();