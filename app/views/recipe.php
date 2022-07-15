<?php
    use app\classes\Database;
    use app\classes\Helper;
    use app\classes\Router;

    $parameter = Router::parameters($_SERVER['REQUEST_URI']);

    $recipes = new Database('recipes');
    $recipes = $recipes->select('LEFT JOIN users ON users.id = recipes.user_id 
    WHERE recipes.recipe_alias = ? AND recipes.recipe_id = ?', array($parameter['alias'], $parameter['unique']));
    $recipe = $recipes->fetch(PDO::FETCH_ASSOC) ?? null;

    $kitchens = new Database('kitchens');
    $kitchens = $kitchens->select('WHERE id = '.$recipe['kitchen_id']);
    $kitchen = $kitchens->fetch(PDO::FETCH_ASSOC);
?>

<section class="navigation">
    <a href="/" class="navigation__link">Главная</a>
    <span><img src="/resources/img/arrow-right.svg" alt="Стрелка вправо" class="navigation-arrow"></span>
    <a href="/kitchen/<?= $kitchen['alias'] ?>" class="navigation__link"><?= $kitchen['name'] ?> кухня</a>
    <span><img src="/resources/img/arrow-right.svg" alt="Стрелка вправо" class="navigation-arrow inactive-link"></span>
    <a href="#" class="navigation__link inactive-link"><?= $recipe['title'] ?></a>
</section>

<main class="main-section">
    <section class="one-recipe">
        <h1 class="one-recipe__title"><?= $recipe['title'] ?></h1>
        <div class="one-recipe__top">
            <p class="publication-date">Опубликовано <?= Helper::datetime('%d %b, %H:%M', $recipe['publication_date'])?></p>
            <div class="publication-author">Автор рецепта: <a href="#"><?= $recipe['username'] ?></a></div>
        </div>
        <div class="one-recipe__image"></div>
        <p class="one-recipe__description text-description"><?= $recipe['recipe_description'] ?></p>
        <div class="recipe-accordion">
            <div class="recipe-accordion__item" data-active="false" style="display: none">
                <p class="recipe-accordion__title">Ингредиенты</p>
                <div class="recipe-accordion__content">
                    <div class="ingredients-table content-ident">
                        <?php
                        $ingredients = new Database('recipe_ingredients');
                        $ingredients = $ingredients->select('LEFT JOIN ingredients ON ingredients.id = recipe_ingredients.ingredients_id 
                        WHERE recipe_ingredients.recipe_id = ?', array($parameter['unique']));
                        ?>

                        <?php while($ingredient = $ingredients->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="ingredients-table__item">
                                <div class="ingredients-table__title"><?= $ingredient['name'] ?></div>
                                <div class="ingredients-table__line"></div>
                                <div class="ingredients-table__value"><?= $ingredient['weight'] ?> грамм</div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="recipe-accordion__item" data-active="false">
                <p class="recipe-accordion__title">Инструкция приготовления</p>
                <div class="recipe-accordion__content instruction-content">
                    <div class="cooking-instruction content-ident">
                        <?php
                        $stages = new Database('stages');
                        $stages = $stages->select('WHERE recipe_id = ?', array($parameter['unique']));
                        $iterate = 0;
                        ?>

                        <?php while($stage = $stages->fetch(PDO::FETCH_ASSOC)): $iterate++ ?>
                            <div class="cooking-instruction__item">
                                <img src="/public/img/78087b382e90451709bce1c3126f2750.webp" alt="Инструкция приготовления" class="cooking-instruction__image">
                                <p class="cooking-instruction__description">
                                    <b class="bold">Шаг <?= $iterate . " " . $stage['title'] ?></b> &nbsp;
                                    <?= $stage['description'] ?>
                                </p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="recipe-accordion__item" data-active="false">
                <p class="recipe-accordion__title">Комментарии</p>
                <div class="recipe-accordion__content">
                    <div class="comments content-ident">
                        <?php
                        $comments = new Database('comments');
                        $comments = $comments->select('LEFT JOIN `users` ON users.id = comments.user_id 
                        WHERE recipe_id = ? ORDER BY comments.id DESC LIMIT 5', array($parameter['unique']));
                        ?>

                        <?php while($comment = $comments->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="comment">
                                <div class="comment-user">
                                    <img src="/public/img/78087b382e90451709bce1c3126f2750.webp" alt="Пользователь" class="comment-user__image">
                                    <div class="comment-user__content">
                                        <h4 class="comment-user__name"><?= $comment['username'] ?></h4>
                                        <p class="comment-user__publication"><?= Helper::datetime('%d %b, %H:%M' ,$comment['comment_publication']) ?></p>
                                    </div>
                                </div>
                                <p class="comment__description"><?= $comment['description'] ?></p>
                            </div>
                        <?php endwhile; ?>

                        <?php if(!$comments->rowCount()): ?>
                            <p class="comment__description no-comments">К данному рецепту отсутствуют комментарии</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions-block">
            <form action="#">
                <button class="like-button">Лайк</button>
            </form>
            <div class="social-icons footer-icons">
                <span class="cooking-instruction__description">Поделиться: &nbsp; </span>
                <img src="/resources/img/facebook_icon-icons.com_59205.svg" alt="Facebook" class="social-icons__item">
                <img src="/resources/img/twitter_icon-icons.com_66093.svg" alt="Twitter" class="social-icons__item">
                <img src="/resources/img/vk_icon-icons.com_65934.svg" alt="Vkontakte" class="social-icons__item">
                <img src="/resources/img/google_icon-icons.com_62736.svg" alt="Google" class="social-icons__item">
            </div>
        </div>
    </section>
    <aside class="recipe-info">
        <h3 class="recipe-info__title">Информация о рецепте</h3>
        <h6 class="recipe-info__subtitle">Ингредиенты</h6>
        <div class="ingredients-table content-ident aside-table">
            <?php
            $ingredients = new Database('recipe_ingredients');
            $ingredients = $ingredients->select('LEFT JOIN ingredients ON ingredients.id = recipe_ingredients.ingredients_id 
                        WHERE recipe_ingredients.recipe_id = ?', array($parameter['unique']));
            ?>

            <?php while($ingredient = $ingredients->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="ingredients-table__item">
                    <div class="ingredients-table__title"><?= $ingredient['name'] ?></div>
                    <div class="ingredients-table__line"></div>
                    <div class="ingredients-table__value"><?= $ingredient['weight'] ?> грамм</div>
                </div>
            <?php endwhile; ?>
        </div>
        <h6 class="recipe-info__subtitle">Другая информация</h6>
        <p class="recipe-info__text">Время приготовления: 2 часа 15 минут</p>
        <p class="recipe-info__text">Калорийность блюда: 235ккал / 100г</p>
        <h6 class="recipe-info__subtitle">Советы по приготовлению</h6>
        <p class="recipe-info__text">
            После приготовления рекомендуется оставить пиццу в духовке на 20-30 минут. За это
            время её тесто станет вкуснее.
        </p>
    </aside>
</main>