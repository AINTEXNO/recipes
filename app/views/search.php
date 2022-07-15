<?php
    use app\classes\Database;
    use app\classes\Helper;
    use app\classes\Router;

    $alias = urldecode(Router::alias($_SERVER['REQUEST_URI']));

    $recipes = new Database('recipes');
    $result = $recipes->select("WHERE title LIKE ?", array("%$alias%"));
?>

<section class="navigation">
    <a href="/" class="navigation__link">Главная</a>
    <span><img src="/resources/img/arrow-right.svg" alt="Стрелка вправо" class="navigation-arrow"></span>
    <a href="#" class="navigation__link inactive-link">Результаты поиска</a>
</section>
<div class="top-line">
    <h2 class="top-line__title">Результаты поиска</h2>
</div>

<section class="main-search">
    <section class="wrap-section search-section category-view">
        <?php while($recipe = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <?php $alias = Helper::generateUrl($recipe['title'], $recipe['recipe_id']); ?>
            <article class='recipe'>
                <a href='../recipe/<?= $alias ?>'><img src='/public/img/78087b382e90451709bce1c3126f2750.webp' alt='<?= $recipe['title'] ?>' class='recipe__image'></a>
                <div class='recipe__content'>
                    <a href='../recipe/<?= $alias ?>'><h4 class='recipe__title'><?= $recipe['title'] ?></h4></a>
                    <p class='recipe__description'><?= $recipe['recipe_description'] ?></p>
                    <div class='recipe__bottom'>
                        <div class='time'>
                            <p class='time__value recipe-text'><?= Helper::datetime('%m %b %H:%M' ,$recipe['publication_date']) ?></p>
                        </div>
                        <div class='recipe__bottom-right'>
                            <div class='likes recipe-stat'>
                                <img src='/resources/img/like-fill.png' alt='Лайк' class='likes__image mini-icon'>
                                <p class='likes__value recipe-text'><?= $recipe['likes'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>

        <?php if(!$result->rowCount()): ?>
            <p class="no-result">По запросу "<?= $alias ?>" ничего не найдено</p>
        <?php endif; ?>
    </section>
</section>

