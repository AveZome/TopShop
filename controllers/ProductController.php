<?php

/**
 * Controller ProductController
 * Product
 */
class ProductController
{

    /**
     * Action для страницы просмотра товара
     * @param integer $productId <p>id товара</p>
     */
    public function actionView($productId)
    {
        // List of categories for the left-menu
        $categories = Category::getCategoriesList();

        // get information about product
        $product = Product::getProductById($productId);

        // connect view
        require_once(ROOT . '/views/product/view.php');
        return true;
    }

}
