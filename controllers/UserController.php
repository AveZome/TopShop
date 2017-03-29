<?php

/**
 * Контроллер UserController
 */
class UserController
{
    /**
     * Action для страницы "Регистрация"
     */
    public function actionRegister()
    {
        // Variables for the form
        $name = false;
        $email = false;
        $password = false;
        $result = false;

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // get the data from the form
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Error flag
            $errors = false;

            // Field Validation
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors == false) {
                // If there are no errors
                // register the user
                $result = User::register($name, $email, $password);
            }
        }

        // Connect view
        require_once(ROOT . '/views/user/register.php');
        return true;
    }
    
    /**
     * Action for "Log-in" page
     */
    public function actionLogin()
    {
        // Variables for the form
        $email = false;
        $password = false;
        
        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is sent
            // get the data from the form
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Error flag
            $errors = false;

            // Field Validation
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Check if the user exists
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                // If the data is incorrect- show error
                $errors[] = 'Wrong login';
            } else {
                // If the data is correct, remember the user (session)
                User::auth($userId);

                // Redirecting the user to the closed part - cabinet
                header("Location: /cabinet");
            }
        }

        // Connect view
        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    /**
     * Delete users information from the session
     */
    public function actionLogout()
    {
        // Start session
        session_start();
        
        // Delete users information from the session
        unset($_SESSION["user"]);
        
        // Redirecting the user to the home page
        header("Location: /");
    }

}
