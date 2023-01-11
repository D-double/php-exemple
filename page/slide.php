<main class="main">
<section class="head">
    <h2 class="head__title"><?=$pageTitle?></h2>
    <p class="head__date"><?=$pageDate?></p>
</section>
            <? $img = scandir("./img/");
             var_dump($img)?>
    <div class="slider">
        <div class="slider__line">
            <?
            for ($i=0; $i < count($img); $i++) : 
            if ($img[$i] != "." && $img[$i] != ".." && $img[$i] != "users") :
            // echo "<br>"
            
            ?>
                <img src="../img/<?=$img[$i]?>" alt="" class="slider__img">
                
            <? 
            endif;
        endfor;
            ?>
            <!-- <img src="../img/2.jpg" alt="" class="slider__img">
            <img src="../img/3.jpg" alt="" class="slider__img">
            <img src="../img/3.jpg" alt="" class="slider__img">
            <img src="../img/3.jpg" alt="" class="slider__img"> -->
        </div>
        <div class="slider__controls">
            <button class="slider__prev slider__btn"><i class="far fa-chevron-left"></i></button>
            <button class="slider__next slider__btn"><i class="far fa-chevron-right"></i></button>
        </div>
    </div>
</main>