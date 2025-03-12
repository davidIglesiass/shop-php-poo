<?php

class OrderModel
{
    private $id;
    private $user_id;
    private $state;
    private $city;
    private $address;
    private $price;
    private $status;
    private $created_at;

    private $db;

    public function __construct()
    {
        $this->db = MyPDO::connect();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY id DESC");
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $orders;
    }

    public function getOne()
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $id = $this->getId();
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_OBJ);
        return $order;
    }

    public function getOneByUser(){
        $smtp = "SELECT o.id, o.price FROM orders o WHERE o.user_id = :user_id ORDER BY o.id DESC LIMIT 1";
        $stmt = $this->db->prepare($smtp);
        $user_id = $this->getUserId();
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $order = $stmt->fetchObject();
        return $order;
    }

    public function getAllByUser(){
        $smtp = "SELECT o.* FROM orders o WHERE o.user_id = :user_id ORDER BY o.id DESC";
        $stmt = $this->db->prepare($smtp);
        $user_id = $this->getUserId();
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $order = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $order;
    }

    public function getProductsByOrder($order_id){
        $smtp = "SELECT p.*, pho.quantity FROM products p INNER JOIN products_has_orders pho ON p.id = pho.product_id WHERE pho.order_id = :order_id";
        $stmt = $this->db->prepare($smtp);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function save()
    {

        Utils::isAdmin();

        $user_id = $this->getUserId();
        $state = $this->getState();
        $city = $this->getCity();
        $address = $this->getAddress();
        $price = $this->getPrice();

        $stmt = $this->db->prepare("INSERT INTO orders (user_id, state, city, address, price, status, created_at) VALUES(:user_id, :state, :city, :address, :price, 'requested', CURRENT_TIMESTAMP)");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':price', $price);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error al guardar la orden: $error";
            return false;
        }

        return true;
    }

    public function save_foreign_key(){
        $smtp = "SELECT LAST_INSERT_ID() as 'order'";
        $stmt = $this->db->prepare($smtp);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_OBJ);
        
        foreach($_SESSION['carshop'] as $key => $value){
            $product = $value['product'];
            $stmt = $this->db->prepare("INSERT INTO products_has_orders (order_id, product_id, quantity) VALUES(:order_id, :product_id, :quantity)");
            $stmt->bindParam(':order_id', $order->order);
            $stmt->bindParam(':product_id', $product->id);
            $stmt->bindParam(':quantity', $value['units']);
            $stmt->execute();
        }

        return;
    }

    public function UpdateStatus(){
        $smtp = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($smtp);
        $stmt->bindParam(':status', $this->getStatus());
        $stmt->bindParam(':id', $this->getId());
        $stmt->execute();
    }

}