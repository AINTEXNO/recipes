<?php

use app\classes\Database;
use app\classes\Router;
use app\classes\Helper;

$sort = $_GET['sort'] ?? 1;
$route = trim($_GET['route']);

$recipes = new Database('recipes');
$alias = Router::alias($route);

$querySort = 'ORDER BY recipe_id DESC';

if($sort) {
    switch($sort) {
        case '2':
            $querySort = 'ORDER BY likes DESC';
            break;
        case '3':
            $querySort = 'ORDER BY cooking_time ASC';
    }
}

$recipes = $recipes->select('LEFT JOIN `recipe_types` ON recipe_types.id = recipes.recipe_type_id 
WHERE recipe_types.alias = ?' . $querySort, array($alias));

$types = new Database('recipe_types');
$type = $types->select('WHERE alias = ?', array($alias));
$type = $type->fetch(PDO::FETCH_ASSOC);

?>

<section class="navigation">
    <a href="/" class="navigation__link">Главная</a>
    <span><img src="/resources/img/arrow-right.svg" alt="Стрелка вправо" class="navigation-arrow"></span>
    <a href="#" class="navigation__link inactive-link"><?= $type['type'] ?></a>
</section>
<div class="top-line">
    <h2 class="top-line__title">Категории &middot; <?= $type['type'] ?></h2>
</div>
<section class="filter-block">
    <div class="filter-block__item">
        <p class="static-text">Сортировать по</p>
        <a href="/<?= $route ?>&sort=1" class="filter-link <?php if($sort == '1' || $sort == ''): ?> filter-link--active <?php endif; ?>">Новизне</a>
        <a href="/<?= $route ?>&sort=2" class="filter-link <?php if($sort == '2'): ?> filter-link--active <?php endif; ?>">Популярности</a>
        <a href="/<?= $route ?>&sort=3" class="filter-link <?php if($sort == '3'): ?> filter-link--active <?php endif; ?>">Времени приготовления</a>
    </div>
</section>
<section class="category-view w-section">
<?php while($recipe = $recipes->fetch(PDO::FETCH_ASSOC)): ?>
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
</section>
