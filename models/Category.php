<?php

/**
 * Class Category - model for working with product categories
 */
class Category
{
    /**
     * Returns an array of categories for the list on the site
     * @return array <p>Array of categories</p>
     */
    public static function getCategoriesList()
    {
        // Connection to DB
        $db = Db::getConnection();

        // Request to DB
        $categoryList = array();

        // Receive and return results
        $result = $db->query('SELECT id_category, name FROM category ');

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id_category'] = $row['id_category'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;
    }

    /**
     * Returns an array of categories for the list in the admin panel <br/>
     * @return array <p>Array of categories</p>
     */
    public static function getCategoriesListAdmin()
    {
        // Connection to DB
        $db = Db::getConnection();

        // Request to DB
        $result = $db->query('SELECT id_category, name FROM category');

        // Receive and return results
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id_category'] = $row['id_category'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }


    /**
     * Deletes the category with the specified id
     * @param integer $id_category
     * @return boolean <p>Result of the method execution</p>
     */
    public static function deleteCategoryById($id_category)
    {
        // Connection to DB
        $db = Db::getConnection();

        // Text request to DB
        $sql = 'DELETE FROM category WHERE id_category = :id_category';

        // Receive and return results. Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id_category, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Editing a category with a specified id
     * @param integer $id_category <p>id of category</p>
     * @param string $name <p>Name</p>
     * @return boolean <p>Result of the method execution</p>
     */
    public static function updateCategoryById($id_category, $name)
    {
        // Connection to DB
        $db = Db::getConnection();

        // Text request to DB
        $sql = "UPDATE category
            SET 
                name = :name
            WHERE id_category = :id_category";

        // Receive and return results. Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        return $result->execute();
    }


    /**
     * Returning a category with a specified id
     * @param integer $id_category <p>id of category</p>
     * @return array <p>Array with information about category</p>
     */
    public static function getCategoryById($id_category)
    {
        // Connection to DB
        $db = Db::getConnection();

        // Text request to DB
        $sql = 'SELECT * FROM category WHERE id_category = :id_category';

        // Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':id_category', $id_category, PDO::PARAM_INT);

        // indicate that data will be getting the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Executing the query
        $result->execute();

        // Returning data
        return $result->fetch();
    }

    /**
     * Add new category
     * @param string $name <p>name</p>
     * @return boolean <p>Result of the method execution</p>
     */
    public static function createCategory($name)
    {
        // Connection to DB
        $db = Db::getConnection();

        // Text request to DB
        $sql = 'INSERT INTO category (name) '
            . 'VALUES (:name)';

        // Receive and return results. Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        return $result->execute();
    }

}