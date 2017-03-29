<?php

/**
 * Controller AdminCategoryController
 * Managing product categories in the admin panel
 */
class AdminCategoryController extends AdminBase
{

    /**
     * Action for the "Manage Categories" page
     */
    public function actionIndex()
    {
        // verify access
        self::checkAdmin();

        // get the list of categories
        $categoriesList = Category::getCategoriesListAdmin();

        // connect view
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    /**
     * Action for the  "Add Category" page
     */
    public function actionCreate()
    {
        // verify access
        self::checkAdmin();

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // get data from the form
            $name = $_POST['name'];

            // errors in form
            $errors = false;

            // If necessary, you can validate the values as needed
            if (!isset($name) || empty($name)) {
                $errors[] = 'Please, fill all fields';
            }


            if ($errors == false) {
                // If there are no errors
                // Adding a new category
                Category::createCategory($name);

                // Redirecting users to the page with category management
                header("Location: /admin/category");
            }
        }

        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    /**
     * Action for "Manage Category" page
     */
    public function actionUpdate($id_category)
    {
        // Verify access
        self::checkAdmin();

        // Get information about a particular category
        $category = Category::getCategoryById($id_category);

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // get data from the form
            $name = $_POST['name'];

            // Save changes
            Category::updateCategoryById($id_category, $name);

            // Redirecting users to the page with category management
            header("Location: /admin/category");
        }

        // Connect view
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }

    /**
     * Action for "Delete category" page
     */
    public function actionDelete($id_category)
    {
        // Verify access
        self::checkAdmin();

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // Delete category
            Category::deleteCategoryById($id_category);

            // Redirecting users to the page with category management
            header("Location: /admin/category");
        }

        // Connect view
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }

}
