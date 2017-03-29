<?php

/**
 * Controller AdminController
 * Home page in Admin Panel
 */
class AdminController extends AdminBase
{
    /**
     * Action for "Admin Panel" home page
     */
    public function actionIndex()
    {
        // Verify access
        self::checkAdmin();

        // Connect view
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}
