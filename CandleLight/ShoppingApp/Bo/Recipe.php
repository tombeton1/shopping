<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 24/04/2015
 * Time: 21:50
 */

namespace ShoppingApp\Bo;


class Recipe {
    private $recipeId;
    private $recipeCategory;
    private $recipeName;
    private $recipeAmount;
    private $recipeAmountUnit;
    private $recipeText;
    private $listProducts;

    function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * @param mixed $recipeId
     */
    public function setRecipeId($recipeId)
    {
        $this->recipeId = $recipeId;
    }

    /**
     * @return mixed
     */
    public function getRecipeCategory()
    {
        return $this->recipeCategory;
    }

    /**
     * @param mixed $recipeCategory
     */
    public function setRecipeCategory($recipeCategory)
    {
        $this->recipeCategory = $recipeCategory;
    }

    /**
     * @return mixed
     */
    public function getRecipeName()
    {
        return $this->recipeName;
    }

    /**
     * @param mixed $recipeName
     */
    public function setRecipeName($recipeName)
    {
        $this->recipeName = $recipeName;
    }

    /**
     * @return mixed
     */
    public function getRecipeAmount()
    {
        return $this->recipeAmount;
    }

    /**
     * @param mixed $recipeAmount
     */
    public function setRecipeAmount($recipeAmount)
    {
        $this->recipeAmount = $recipeAmount;
    }

    /**
     * @return mixed
     */
    public function getRecipeAmountUnit()
    {
        return $this->recipeAmountUnit;
    }

    /**
     * @param mixed $recipeAmountUnit
     */
    public function setRecipeAmountUnit($recipeAmountUnit)
    {
        $this->recipeAmountUnit = $recipeAmountUnit;
    }

    /**
     * @return mixed
     */
    public function getRecipeText()
    {
        return $this->recipeText;
    }

    /**
     * @param mixed $recipeText
     */
    public function setRecipeText($recipeText)
    {
        $this->recipeText = $recipeText;
    }

    /**
     * @return mixed
     */
    public function getListProducts()
    {
        return $this->listProducts;
    }

    /**
     * @param mixed $listProducts
     */
    public function setListProducts($listProducts)
    {
        $this->listProducts = $listProducts;
    }

}