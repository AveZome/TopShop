<?php

/**
 * Контроллер CatalogController
 * Каталог товаров
 */
class CatalogController
{

    /**
     * Action для страницы "Каталог товаров"
     */
    public function actionIndex()
    {
        // List of categories for left-menu
        $categories = Category::getCategoriesList();

        // List of latest products
        $latestProducts = Product::getLatestProducts(12);

        // Connect view
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action для страницы "Категория товаров"
     */
    public function actionCategory($categoryId, $page = 1)
    {
        // List of categories for the left-menu
        $categories = Category::getCategoriesList();

        // List of products in the category
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        // Total quantity of products (Necessary for page navigation)
        $total = Product::getTotalProductsInCategory($categoryId);

        // Create object Pagination - page navigation
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // Connect view
        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
