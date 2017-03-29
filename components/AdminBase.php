<?php

/**
 * Abstract class AdminBase include common logic for controllers, which
 * are used in the Admin Panel
 */
abstract class AdminBase
{

    /**
     * Method, which checks if the user is an administrator
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Check if user authorized. If not, user will be redirected
        $userId = User::checkLogged();

        // get information about current user
        $user = User::getUserById($userId);

        // if role of the currect user is "admin", give the access in the Admin Panel
        if ($user['role'] == 'admin') {
            return true;
        }

        // Otherwise, we end the work with the message of private access
        die('Access denied');
    }

}