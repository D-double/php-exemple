<aside class="menu">
            <div class="menu__reviews">
                <span class="menu__reviews_span" data-href="https://proweb.uz/">
                    <i class="far fa-chevron-right"></i>
                </span>
                <span class="menu__reviews_text">Оставить озыв</span>
            </div>
<ul class="menu__list">
<?foreach ($arrayPages as $link => $pageInfo) : ?>
    <li><a href="/?route=<?=$link?>" class="menu__list-link <?= $link == $route ? "active" : ""?>"><i class="<?=$pageInfo["page_icon"]?>"></i><?=$pageInfo["page_name"]?></a></li>
<?endforeach;?>
</ul>
        </aside>