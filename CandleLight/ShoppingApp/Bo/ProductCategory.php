<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 26/04/2015
 * Time: 17:52
 */

namespace ShoppingApp\Bo;


class ProductCategory {
    private $productCategoryId;
    private $productCategoryName;
    private $productCategoryDescription;

    function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getProductCategoryId()
    {
        return $this->productCategoryId;
    }

    /**
     * @param mixed $productCategoryId
     */
    public function setProductCategoryId($productCategoryId)
    {
        $this->productCategoryId = $productCategoryId;
    }

    /**
     * @return mixed
     */
    public function getProductCategoryName()
    {
        return $this->productCategoryName;
    }

    /**
     * @param mixed $productCategoryName
     */
    public function setProductCategoryName($productCategoryName)
    {
        $this->productCategoryName = $productCategoryName;
    }

    /**
     * @return mixed
     */
    public function getProductCategoryDescription()
    {
        return $this->productCategoryDescription;
    }

    /**
     * @param mixed $productCategoryDescription
     */
    public function setProductCategoryDescription($productCategoryDescription)
    {
        $this->productCategoryDescription = $productCategoryDescription;
    }

}