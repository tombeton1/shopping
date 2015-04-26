<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 17:21
 */

namespace ShoppingApp\Bo;


class RecipeCategory implements \JsonSerializable {
    private $recipeCategoryId;
    private $recipeCategoryName;
    private $recipeCategoryDescription;

    function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getRecipeCategoryId()
    {
        return $this->recipeCategoryId;
    }

    /**
     * @param mixed $recipeCategoryId
     */
    public function setRecipeCategoryId($recipeCategoryId)
    {
        $this->recipeCategoryId = $recipeCategoryId;
    }

    /**
     * @return mixed
     */
    public function getRecipeCategoryName()
    {
        return $this->recipeCategoryName;
    }

    /**
     * @param mixed $recipeCategoryName
     */
    public function setRecipeCategoryName($recipeCategoryName)
    {
        $this->recipeCategoryName = $recipeCategoryName;
    }

    /**
     * @return mixed
     */
    public function getRecipeCategoryDescription()
    {
        return $this->recipeCategoryDescription;
    }

    /**
     * @param mixed $recipeCategoryDescription
     */
    public function setRecipeCategoryDescription($recipeCategoryDescription)
    {
        $this->recipeCategoryDescription = $recipeCategoryDescription;
    }

    public function JsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }

}