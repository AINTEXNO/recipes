<?php
    use app\classes\Database;
    use app\classes\Router;
    use app\classes\Helper;

?>

<section class="navigation">
    <a href="/" class="navigation__link">Главная</a>
    <span><img src="/resources/img/arrow-right.svg" alt="Стрелка вправо" class="navigation-arrow"></span>
    <a href="#" class="navigation__link inactive-link">Популярные авторы</a>
</section>
<div class="top-line">
    <h2 class="top-line__title">Популярные авторы</h2>
</div>

<section class="authors">
    <div class="author">
        <div class="author-place first-place">1</div>
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 1</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author-place second-place">2</div>
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 2</p>
            <p class="author__number author-text">Опубликовано рецептов - 114</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author-place third-place">3</div>
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 3</p>
            <p class="author__number author-text">Опубликовано рецептов - 84</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>

    </div>
    <div class="author">
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 4</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 5</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 6</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 7</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 8</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 9</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
    <div class="author">
        <div class="author__top">
            <img src="/resources/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="author__icon">
            <h3 class="author__surname">Ivan Ivanov</h3>
        </div>
        <div class="author-info">
            <p class="author__number author-text">Место в рейтинге - 10</p>
            <p class="author__number author-text">Опубликовано рецептов - 134</p>
            <div class="author-info__item author-text">Дата регистрации: 22 июня 2021 года</div>
        </div>
        <p class="author__subtitle author-text">Последние рецепты автора</p>


    </div>
</section>