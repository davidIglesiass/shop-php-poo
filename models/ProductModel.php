<?php

class ProductModel{
    private $id;
    private $category_id;
    private $name;
    private $description;
    private $price;
    private $discount;
    private $stock;
    private $image;
    private $created_at;
    private $db;

    public function __construct(){
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

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

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

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image = null)
    {
        $this->image = $image;

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

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getAllCategories(){
        $stmt = $this->db->prepare("SELECT p.*, c.name as categoryName FROM products p INNER JOIN categories c ON c.id = p.category_id WHERE p.category_id = {$this->getCategoryId()} ORDER BY id DESC");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getOne(){
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $id = $this->getId();
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    public function getRandom($rand){
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY RAND() LIMIT {$rand}");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function save(){

        Utils::isAdmin();

        $category_id = $this->getCategoryId();
        $name = $this->getName();
        $description = $this->getDescription();
        $price = $this->getPrice();
        $discount = $this->getDiscount();
        $stock = $this->getStock();
        $image = $this->getImage();

        $stmt = $this->db->prepare("INSERT INTO products VALUES(null, :category_id, :name, :description, :price, :discount, :stock, :image, CURRENT_TIMESTAMP)");    

        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':image', $image);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error al guardar el producto: $error";
            return false;
        }

        return true;
    }

    public function delete(){
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $this->id);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error al borrar el producto: $error";
            return false;
        }

        return true;
    }

    public function update(){
        Utils::isAdmin();

        $sql = "UPDATE products SET category_id = :category_id, name = :name, description = :description, price = :price, discount = :discount, stock = :stock";

        if($this->getImage() != null) $sql .= ", image = :image";

        $sql .= " WHERE id = :id";


        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':discount', $this->discount);
        $stmt->bindParam(':stock', $this->stock);
        $this->getImage() != null ? $stmt->bindParam(':image', $this->image) : '';
        $stmt->bindParam(':id', $this->id);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error al actualizar el producto: $error";
            return false;
        }

        return true;
    }
}