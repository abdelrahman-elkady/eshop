<?php


class Products
{
    private $db;
    private $errors;

    public function __construct($db)
    {
        $this->db = $db;
        $this->errors = array();
    }

    public function listProducts()
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM `products`');

            $stmt->execute();

            $products = $stmt->fetchAll();

            return $products;
        } catch (Exception $e) {
            $this->errors[] = $e->getMessage();

            return false;
        }
    }

    public function addToCart()
    {
        $id = intval($_GET['id']);
        $quantity = intval($_GET['quantity']);

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = intval($_SESSION['cart'][$id]) + $quantity;
        } else {
            try {
                $stmt = $this->db->prepare('SELECT * FROM `products` WHERE `product_id`=:id');

                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                $stmt->execute();

                $data = $stmt->fetchAll();

                if (empty($data)) {
                    $this->errors[] = 'Invalid product selected';

                    return false;
                } else {
                    $_SESSION['cart'][$id] = $quantity;
                }
            } catch (Exception $e) {
                $this->errors[] = $e->getMessage();

                return false;
            }
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
