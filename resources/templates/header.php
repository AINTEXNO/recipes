<?php use app\classes\Database; ?>
<?php use app\classes\Helper; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="На сайте вы найдёте огромное количество пошаговых рецептов приготовления блюд,
        мастерклассы по приготовлению блюда, советы и много другое">
    <meta name="keywords" content="Рецепты, Блюдо, Приготовление, Еда, Продукты, Кулинария, Повар, Кухня">
    <title>Рецепты на каждый день</title>
    <link rel="stylesheet" href="/resources/css/reset.css">
    <link rel="stylesheet" href="/resources/css/style.css">
    <!-- Yandex.Metrika counter -->
<!--    <script type="text/javascript" >-->
<!--        document.addEventListener('DOMContentLoaded', function() {-->
<!--            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};-->
<!--                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})-->
<!--            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");-->
<!---->
<!--            ym(86431130, "init", {-->
<!--                clickmap:true,-->
<!--                trackLinks:true,-->
<!--                accurateTrackBounce:true,-->
<!--                webvisor:true-->
<!--            });-->
<!--        }, false);-->
<!--    </script>-->
<!--    <noscript><div><img src="https://mc.yandex.ru/watch/86431130" style="position:absolute; left:-9999px;" alt="" /></div></noscript>-->
    <!-- /Yandex.Metrika counter -->
</head>
<body>
<main class="main-wrapper">
    <nav class="resize-menu">
        <img src="/resources/img/burger-menu.svg" alt="Меню" class="burger-menu-icon">
        <h1 class="logo resize-logo">Рецепты Блюд</h1>
    </nav>
    <aside class="side-menu">
        <div class="side-content">
            <div class="logo-block">
                <h1 class="logo">Рецепты<br>Блюд</h1>
<!--                <p class="logo-description">рецепты на каждый день</p>-->
            </div>
            <div class="search-input" id="search-input">Поиск
                <img src="/resources/img/search.svg" alt="Поиск" class="search-input__image">
            </div>
            <nav class="accordion-menu">
                <div class="accordion-item" data-active="false">
                    <div class="accordion-item__top" data-active="false">
                        <a href="#" class="accordion-item__title">Категории</a>
                        <img src="/resources/img/chevrondown_120139.svg" alt="Вниз" class="accordion-item__arrow">
                    </div>
                    <div class="accordion-links">
                        <?php
                            $types = new Database('recipe_types');
                            $types = $types->select('LIMIT 10');
                        ?>

                        <?php while($type = $types->fetch(PDO::FETCH_ASSOC)): ?>
                            <a href='/type/<?= Helper::translit($type['type']) ?>' class='accordion-links__item'><?= $type['type']?></a>
                        <?php endwhile; ?>
                        <a href="/list/types" class='accordion-links__item'>Другие категории</a>
                    </div>
                </div>
                <div class="accordion-item" data-active="false">
                    <div class="accordion-item__top" data-active="false">
                        <a href="#" class="accordion-item__title">Кухни</a>
                        <img src="/resources/img/chevrondown_120139.svg" alt="Вниз" class="accordion-item__arrow">
                    </div>
                    <div class="accordion-links">
                        <?php
                            $kitchens = new Database('kitchens');
                            $kitchens = $kitchens->select('LIMIT 10');
                        ?>

                        <?php while($kitchen = $kitchens->fetch(PDO::FETCH_ASSOC)): ?>
                            <a href='/kitchen/<?= Helper::translit($kitchen['name']) ?>' class='accordion-links__item'><?= $kitchen['name']?></a>
                        <?php endwhile; ?>
                        <a href="/list/kitchens" class='accordion-links__item'>Другие кухни</a>
                    </div>
                </div>
                <div class="accordion-item" data-active="false">
                    <div class="accordion-item__top" data-active="false">
                        <a href="#" class="accordion-item__title">Идеи</a>
                        <img src="/resources/img/chevrondown_120139.svg" alt="Вниз" class="accordion-item__arrow">
                    </div>
                    <div class="accordion-links">
                        <a href="/developed" class="accordion-links__item">Идеи по оформлению</a>
                        <a href="/developed" class="accordion-links__item">Кулинарные лайфхаки</a>
                    </div>
                </div>
                <div class="accordion-item" data-active="false">
                    <div class="accordion-item__top" data-active="false">
                        <a href="/developed" class="accordion-item__title">Авторы</a>
                        <img src="/resources/img/chevrondown_120139.svg" alt="Вниз" class="accordion-item__arrow">
                    </div>
                    <div class="accordion-links">
                        <a href="/authors" class="accordion-links__item">Популярные авторы</a>
                        <a href="" class="accordion-links__item" id="new-author">Стать автором</a>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-item__top" onclick="window.location.href='/about'">
                        <a href="/about" class="accordion-item__title">О проекте</a>
                    </div>
                </div>
                <div class="accordion-item" id="modal">
                    <div class="accordion-item__top">
                        <a href="#" class="accordion-item__title">Вход</a>
                    </div>
                </div>
            </nav>
            <div class="social-icons">
                <a href="/developed"><img src="/resources/img/facebook_icon-icons.com_59205.svg" alt="Facebook" class="social-icons__item"></a>
                <a href="/developed"><img src="/resources/img/twitter_icon-icons.com_66093.svg" alt="Twitter" class="social-icons__item"></a>
                <a href="/developed"><img src="/resources/img/vk_icon-icons.com_65934.svg" alt="Vkontakte" class="social-icons__item"></a>
                <a href="/developed"><img src="/resources/img/google_icon-icons.com_62736.svg" alt="Google" class="social-icons__item"></a>
            </div>
        </div>
    </aside>
    <div class="wrapper">
