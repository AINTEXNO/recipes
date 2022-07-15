
<?php
    use app\classes\Database;
    use app\classes\Helper;
?>

<div class="recent-posts">
    <div class="recent-lebel">
        <img src="./resources/img/new.png" alt="Новая публикация" class="recent-lebel__image">
        <p class="recent-lebel__text">Новые рецепты</p>
    </div>
    <div class="click-button prev-button">
        <img src="./resources/img/click-button.png" alt="Предыдущий" class="click-button__image">
    </div>
    <div class="click-button next-button">
        <img src="./resources/img/click-button.png" alt="Следующий" class="click-button__image">
    </div>
    <div class="recent-posts-line">
        <?php
        $recipes = new Database('recipes');
        $recipes = $recipes->select('LEFT JOIN kitchens ON kitchens.id = recipes.kitchen_id 
        ORDER BY `recipe_id` DESC LIMIT 8');
        ?>

        <?php while($recipe = $recipes->fetch(PDO::FETCH_ASSOC)): ?>
            <article class="recent-article" onclick="window.location.href='/recipe/<?= Helper::generateUrl($recipe['recipe_alias'], $recipe['recipe_id']) ?>'">
                <img src="./public/img/78087b382e90451709bce1c3126f2750.webp" alt="" class="recent-article__image">
                <div class="recent-description">
                    <h4 class="recent-description__title"><?= $recipe['title'] ?></h4>
                    <p class="recent-description__category"><?= $recipe['name'] ?></p>
                </div>
            </article>
        <?php endwhile; ?>
        <div class="preloader"></div>
    </div>
</div>
<div class="category-top">
    <a href="../kitchen/italyanskaya" class="subtitle">Рецепты итальянской кухни</a>
</div>
<div class="category-view first-view">
    <?= article('recipes', 2); ?>
</div>
<div class="category-top">
    <a href="../kitchen/evropeyskaya" class="subtitle">Рецепты европейской кухни</a>
</div>
<div class="category-view">
    <?= article('recipes', 6); ?>
</div>
<div class="email-mailing">
    <div class="email-mailing__image"></div>
    <div class="email-mailing__content">
        <h2 class="email-mailing__title">Получайте свежие рецепты каждый день!</h2>
        <h5 class="email-mailing__subtitle">Подпишитесь на бесплатную email-рассылку</h5>
        <form class="input-block email-input-block" id="send-form" method="POST">
            <input type="text" name="email" placeholder="Адрес электронной почты" class="search-field email-field">
            <button class="send-button email-button" id="send-button">Подписаться</button>
        </form>
        <div class="error-block" id="error"></div>
        <p class="email-preface">Подписываясь на рассылку, Вы соглашаетесь с <a href="#" class="preface-link">пользовательским соглашением</a> нашего сайта</p>
    </div>
</div>
<div class="category-top">
    <a href="../kitchen/francuzskaya" class="subtitle">Рецепты французской кухни</a>
</div>
<div class="category-view">
    <?= article('recipes', 3); ?>
</div>