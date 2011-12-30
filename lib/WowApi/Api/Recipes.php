<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Recipes extends AbstractApi
{
    public function getRecipe($recipeId)
    {
        $recipe = $this->get($this->generatePath('recipe/:recipeId', array(
                'recipeId' => (int)$recipeId)
        ));

        return $recipe;
    }

}
