<?php

class Cart
{
    private $db;
    private $errors;

    public function __construct($db)
    {
        $this->db = $db;
        $this->errors = array();
    }

    public function listCart()
    {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $invoiceProducts = array();

            $query = 'SELECT * FROM `products` WHERE `product_id` IN (';

            foreach ($_SESSION['cart'] as $id => $value) {
                $query .= $id.',';
            }

            $query = substr($query, 0, -1).') ORDER BY name ASC';

            $stmt = $this->db->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $row['quantity'] = $_SESSION['cart'][$row['product_id']];
                $invoiceProducts[] = $row;
            }

            return $invoiceProducts;
        } else {
            return false;
        }
    }
}
