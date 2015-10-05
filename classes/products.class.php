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

    public function getErrors()
    {
        return $this->errors;
    }
}
