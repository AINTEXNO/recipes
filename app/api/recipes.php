<?php

use app\classes\Database;

header('Content-Type: application/json');

include('../classes/Database.php');

function recipes() {
    $recipes = new Database('recipes');
    $result = $recipes->select('LEFT JOIN recipe_types ON recipe_types.id = recipes.recipe_type_id')->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(200);
    return json_encode(array('data' => $result));
}

echo recipes();