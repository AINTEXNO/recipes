<?php
    use app\classes\Database;
    use app\classes\Router;

    $alias = trim(Router::alias($_SERVER['REQUEST_URI']));

    $alias = $alias == 'types' ? 'recipe_types' : 'kitchens';
    $title = $alias == 'kitchens' ? 'Национальные рецепты' : 'Виды рецептов блюд';
    $column = $alias == 'kitchens' ? 'name' : 'type';

    $table = new Database($alias);
    $select = $table->select("ORDER BY $column ASC");
?>

<section class="navigation">
    <a href="/" class="navigation__link">Главная</a>
    <span><img src="/resources/img/arrow-right.svg" alt="Стрелка вправо" class="navigation-arrow"></span>
    <a href="#" class="navigation__link inactive-link"><?= $title ?></a>
</section>
<div class="top-line">
    <h2 class="top-line__title"><?= $title ?></h2>
</div>

<section class="wrap-section list-items">
    <ul class="link-list">
    <?php while($row = $select->fetch(PDO::FETCH_ASSOC)): ?>
        <li class="link-list__item">
            <a href="<?= $alias== 'kitchens' ? '/kitchen/' : '/type/'?><?= $row['alias'] ?>" class="link-list__value"><?= $row[$column] ?></a>
            <img src="/resources/img/arrow-right.svg" alt="Стрелка вправо" class="link-list__icon">
        </li>
    <?php endwhile; ?>
    </ul>
</section>