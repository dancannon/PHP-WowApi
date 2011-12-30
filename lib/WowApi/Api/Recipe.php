<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Recipes extends AbstractApi
{
    public function getItem($recipeId)
    {
        $recipe = $this->get($this->generatePath('recipie/:recipeId', array(
                'recipeId' => (int)$recipeId)
        ));

        return $recipe;
    }

}
