<?php

/**
 * Controler SiteController
 */
class SiteController
{

    /**
     * Action for home page
     */
    public function actionIndex()
    {
        // List of categories for the left-menu
        $categories = Category::getCategoriesList();

        // List of latest products
        $latestProducts = Product::getLatestProducts(6);

        // Connect view
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action for "Contacts" page
     */
    public function actionContact()
    {

        // Variables for the form
        $userEmail = false;
        $userText = false;
        $result = false;

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // Get the data from form
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            // errors
            $errors = false;

            // Validation of fields
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Wrong email';
            }

            if ($errors == false) {
                // If no errors
                // send the letter to the administrator
                $adminEmail = 'alecsei.elistratov@gmail.com';
                $message = "Text: {$userText}. For {$userEmail}";
                $subject = 'Subject';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        // Connect view
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }

    /**
     * Action for "About" page
     */
    public function actionAbout()
    {
        // Connect view
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

}
