<?php

use app\classes\Database;
use app\classes\Helper;

function preg($stmt, $pattern) {
    return preg_match($pattern, $stmt) ? $stmt : false;
}

function article(string $table, $id): string
{
    $template = "";

    $recipes = new Database($table);
    $recipes = $recipes->select("WHERE `kitchen_id` = $id ORDER BY `recipe_id` DESC LIMIT 5");

    while($recipe = $recipes->fetch(PDO::FETCH_ASSOC)){
        $alias = Helper::generateUrl($recipe['title'], $recipe['recipe_id']);
        $template .= "
        <article class='recipe'>
            <a href='../recipe/{$alias}'><img src='/public/img/78087b382e90451709bce1c3126f2750.webp' alt='{$recipe['title']}' class='recipe__image'></a>
            <div class='recipe__content'>
                <a href='../recipe/{$alias}'><h4 class='recipe__title'>{$recipe['title']}</h4></a>
                <p class='recipe__description'>{$recipe['recipe_description']}</p>
                <div class='recipe__bottom'>
                    <div class='time'>
                        <p class='time__value recipe-text'>". Helper::datetime('%m %b %H:%M' ,$recipe['publication_date'])."</p>
                    </div>
                    <div class='recipe__bottom-right'>
                        <div class='likes recipe-stat'>
                            <img src='./resources/img/like-fill.png' alt='Лайк' class='likes__image mini-icon'>
                            <p class='likes__value recipe-text'>{$recipe['likes']}</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>";
    }

    return $template;
}