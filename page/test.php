<main class="main">
<section class="head">
    <h2 class="head__title"><?=$pageTitle?></h2>
    <p class="head__date"><?=$pageDate?></p>
</section>
    <?
$name = "Вася";
echo "Привет " . "<br>" . $name;
echo '<h1> Привет $name </h1>';
echo "<h1> Привет $name </h1>";
echo "<h1> Привет {$name}!</h1>";
    ?>
    <?= "<h1> Привет Петя! </h1>"; ?>
    <?
    $a = 2;
    if ($a > 6) {
        echo "$a > 6";
    } elseif ($a < 6){
        echo "$a < 6";
    } else if ($a <= 6) {
        echo "$a <= 6";
    } else {
        echo "Нет ответа";
    }    
    ?>
    
<p>Ваш год рождения</p>
<select name="" id="">
<?  $year = date("Y");
    for ($i = $year - 70; $i <= $year; $i++):     
?>
    <!-- echo "<option value=\"$i\"></option>"; // "\" - экранирование символов -->
    <option value="<?=$i?>"> <?=$i?> </option>
<? endfor; ?>
</select>

<?= "<br>" . date("d-m-Y"); ?>
<?
    $arr_a = ["сто", "двести", "триста"];
    echo "<br>" . $arr_a["0"];     
for ($i=0; $i < count($arr_a); $i++) { 
    $x = mb_strtoupper($arr_a[$i]);
    echo "<p>$i = $x</p>";
}
    $arr_b = [
        "a" => "сто",
        "b" => "двести",
        "c" => [
            "d" => "триста",
            "e" => "четыреста",
            ],
        ];
    echo "<br>" . $arr_b["b"];

foreach ($arr_b as $key => $value):
if (gettype($value) != "array") {
    echo "<p>$key = $value</p>";
} else {
    foreach ($value as $x){
        echo "<p>$key = strtoupper($x)</p>";
    }
}
endforeach;
var_dump ($arr_b);
?>

<??>

<form action="" method="post">
    <label for="name">Имя</label>
    <input type="text" id="name" name="name">
    <br>
    <label>Фамилия <input type="text" name="surname"></label>
    <br>
    <button>Отправить</button>
</form>
<?php
	var_dump($_GET);
    var_dump($_POST);
$name = strip_tags($_POST["name"]);
$surname = htmlspecialchars($_POST["surname"]);
echo "<p>Имя: $name</p>";
echo "<p>Фамилия: $surname</p>";
?>
<p>	&lt;</p>
 



</main>