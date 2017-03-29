<?php


class Product
{
    const SHOW_BY_DEFAULT = 9;

    /**
     * Returns an array of the last products
     * @param type $count [optional] <p>quantity</p>
     * @param type $page [optional] <p>number of current page</p>
     * @return array <p>Array with products</p>
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        // Connecting to DB
        $db = Db::getConnection();

        // The text of the query to DB
        $sql = 'SELECT id_product, name, price FROM product '
            . 'ORDER BY id_product DESC '
            . 'LIMIT :count';

        // Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Specify that we want to get data as an array
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Running the Command
        $result->execute();

        // Get and return results
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id_product'] = $row['id_product'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Returns the list of products in the specified category
     * @param type $categoryId <p>id of category</p>
     * @param type $page [optional] <p>number of page</p>
     * @return type <p>Array with products</p>
     */
    public static function getProductsListByCategory($categoryId, $page = 1)
    {
        $limit = Product::SHOW_BY_DEFAULT;

        // Offset (for request)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // Connecting to DB
        $db = Db::getConnection();

        // The text of the query to DB
        $sql = 'SELECT id_product, name, price FROM product '
            . 'WHERE category_id = :category_id '
            . 'ORDER BY id_product ASC LIMIT :limit OFFSET :offset';

        // Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Running the Command
        $result->execute();

        // Receiving and returning results
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id_product'] = $row['id_product'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    /**
     * Returns the product with the specified id
     * @param integer $id <p>id of product</p>
     * @return array <p>Array with product information</p>
     */
    public static function getProductById($id_product)
    {
        // Connecting to BD
        $db = Db::getConnection();

        // The text of the query to DB
        $sql = 'SELECT * FROM product WHERE id_product = :id_product';

        // Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':id_product', $id_product, PDO::PARAM_INT);

        // indicate that we want to get data in the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Running the Command
        $result->execute();

        // Receiving and returning results
        return $result->fetch();
    }

    /**
     * Return the quantity of products in the specified category
     * @param integer $categoryId
     * @return integer
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        // Connection to DB
        $db = Db::getConnection();

        // The text of the query to DB
        $sql = 'SELECT count(id_product) AS count FROM product WHERE category_id = :category_id';

        // Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // Running the Command
        $result->execute();

        // Return value count - quantity
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Returns a list of products with the specified id
     * @param array $idsArray <p>An array with identifiers</p>
     * @return array <p>Array with a list of products</p>
     */
    public static function getProdustsByIds($idsArray)
    {
        // Connection to DB
        $db = Db::getConnection();

        // turn the array into a string to form the condition in the query
        $idsString = implode(',', $idsArray);

        // The text of the query to DB
        $sql = "SELECT * FROM product WHERE id IN ($idsString)";

        $result = $db->query($sql);

        // indicate that we want to get data in the form of an array
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Receiving and returning results
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }
    /**
     * Returns a list of products
     * @return array <p>Array with products</p>
     */
    public static function getProductsList()
    {
        // Connection to DB
        $db = Db::getConnection();

        // Receiving and returning results
        $result = $db->query('SELECT id_product, name, price FROM product ORDER BY id_product ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id_product'] = $row['id_product'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Deletes the item with the specified id
     * @param integer $id_product <p>id of product</p>
     * @return boolean <p>result of the method execution</p>
     */
    public static function deleteProductById($id_product)
    {
        // Connection to DB
        $db = Db::getConnection();

        // The text of the query to DB
        $sql = 'DELETE FROM product WHERE id_product = :id_product';

        // Receiving and returning results. Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Update the product with the specified id
     * @param integer $id_product <p>id of product</p>
     * @param array $options <p>Array with product information</p>
     * @return boolean <p>Result of the method execution</p>
     */
    public static function updateProductById($id_product, $options)
    {
        // Connection to DB
        $db = Db::getConnection();

        // The text of the query to DB
        $sql = "UPDATE product
            SET 
                name = :name, 
                price = :price, 
                category_id = :category_id,
            WHERE id_product = :id_product";

        // Receiving and returning results. Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Adds a new product
     * @param array $options <p>Array with product information</p>
     * @return integer <p>id added to the record table</p>
     */
    public static function createProduct($options)
    {
        // Connection to DB
        $db = Db::getConnection();

        // The text of the query to DB
        $sql = 'INSERT INTO product '
            . '(name, price, category_id)'
            . 'VALUES '
            . '(:name, :price, :category_id)';

        // Receiving and returning results. Use the prepared query
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        if ($result->execute()) {
            // If the request is successful, return the id of the added record
            return $db->lastInsertId();
        }
        // else return 0
        return 0;
    }
    /**
     * Returns the path to the image
     * @param integer $id_product
     * @return string <p>Image path</p>
     */
    public static function getImage($id_product)
    {
        // Name of the dummy image
        $noImage = 'no-image.jpg';

        // path to the folder with the products
        $path = '/template/upload/images/products/';

        // path to the product image
        $pathToProductImage = $path . $id_product . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // If the image for the product exists
            // Returning the product image path
            return $pathToProductImage;
        }

        // else Returning the path of the image of a dummy
        return $path . $noImage;
    }

}