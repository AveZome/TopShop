<?php

/**
 * Controller AdminProductController
 * Manage products in Admin Panel
 */
class AdminProductController extends AdminBase
{

    /**
     * Action for "Manage products" page
     */
    public function actionIndex()
    {
        // Verify access
        self::checkAdmin();

        // get the list of products
        $productsList = Product::getProductsList();

        // Connect view
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    /**
     * Action for "Add products" page
     */
    public function actionCreate()
    {
        // Verify access
        self::checkAdmin();

        // Get the list of categories for the drop-down list
        $categoriesList = Category::getCategoriesListAdmin();

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // get the data from the form
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];

            // errors in form
            $errors = false;

            // If necessary, you can validate the values as needed
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // If there are no errors
                // Adding a new product
                $id_product = Product::createProduct($options);

                // If the entry is added
                if ($id_product) {
                    // check if the image was uploaded through the form
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // If downloaded, move it to the correct folder, give a new name
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id_product}.jpg");
                    }
                };

                // redirect the user to the products management page
                header("Location: /admin/product");
            }
        }

        // Connect view
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    /**
     * Action for "Update product" page
     */
    public function actionUpdate($id_product)
    {
        // Verify access
        self::checkAdmin();

        // Get the list of categories for the drop-down list
        $categoriesList = Category::getCategoriesListAdmin();

        // receive the data about a specific order
        $product = Product::getProductById($id_product);

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // get the data from the editing form. If necessary, you can validate the values
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];

            // Save changes
            if (Product::updateProductById($id_product, $options)) {


                // If the entry is saved
                // check if the image was uploaded through the form
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                    // If downloaded, move it to the correct folder, give a new name
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id_product}.jpg");
                }
            }

            // redirect the user to the products management page
            header("Location: /admin/product");
        }

        // Connect view
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id_product)
    {
        // Verify access
        self::checkAdmin();

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // Remove the product
            Product::deleteProductById($id_product);

            // redirect the user to the products management page
            header("Location: /admin/product");
        }

        // Connect view
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

}
