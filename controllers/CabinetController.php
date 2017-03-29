<?php

/**
 * Controller CabinetController
 * Users cabinet
 */
class CabinetController
{

    /**
     * Action for "Users cabinet" page
     */
    public function actionIndex()
    {
        // Get the user ID from the session
        $userId = User::checkLogged();

        // get information about the user from the database
        $user = User::getUserById($userId);

        // Connect view
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action for "Update account" page
     */
    public function actionEdit()
    {
        // Get the user ID from the session
        $userId = User::checkLogged();

        // get information about the user from the database
        $user = User::getUserById($userId);

        // Fill the variables for form fields
        $name = $user['name'];
        $password = $user['password'];

        // errors in form
        $result = false;

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // Get the data from the edit form
            $name = $_POST['name'];
            $password = $_POST['password'];

            // errors
            $errors = false;

            // Validate the values
            if (!User::checkName($name)) {
                $errors[] = 'Name could not be shorter than 2 characters';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Password could not be shorter than 6 characters';
            }

            if ($errors == false) {
                // If there are no errors, saves the profile changes
                $result = User::edit($userId, $name, $password);
            }
        }

        // Connect view
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

}
