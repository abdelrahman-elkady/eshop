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

    public function processCart($items)
    {
        if (empty($items)) {
            $this->errors[] = 'No items to process !';

            return false;
        } else {
            foreach ($items as $item) {
                unset($_SESSION['cart'][$item['product_id']]);
                if ($item['stock'] < $item['quantity']) {
                    $this->errors[] = 'Our stock can\'t fulfil your need of '.$item['name'].', we are sorry for that';
                    continue;
                }

                $diff = intval($item['stock']) - intval($item['quantity']);

                $stmt = $this->db->prepare('UPDATE `products` SET `stock` ='.$diff.' WHERE `product_id` = :id ');
                $stmt->bindParam(':id', intval($item['product_id']), PDO::PARAM_INT);

                $stmt->execute();

                $stmt = $this->db->prepare('INSERT INTO `purchases` (user_id,product_id,quantity,purchase_date) VALUES (:uid,:pid,:quantity,NOW())');
                $stmt->bindParam(':uid', intval($_SESSION['user']['id']), PDO::PARAM_INT);
                $stmt->bindParam(':pid', intval($item['product_id']), PDO::PARAM_INT);
                $stmt->bindParam(':quantity', intval($item['quantity']), PDO::PARAM_INT);
            
                $stmt->execute();
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
