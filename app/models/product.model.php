<?php
require_once './app/models/config.php';

class productModel {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }

    function getProducts() {
        $query = $this->db->prepare('SELECT productos.*, categorias.nombre AS categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria');
        $query->execute();
    
        $products = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $products;
    }
    
    
    function getProductByName($nombre) {
        $query = $this->db->prepare('SELECT productos.*, categorias.nombre AS categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria WHERE productos.nombre = ?');
        $query->execute([$nombre]);
    
        $product = $query->fetch(PDO::FETCH_OBJ);
    
        return $product;
    }
    
    public function getProductsByCategoria($categoria) {
        $query = $this->db->prepare('SELECT productos.*, categorias.nombre as categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria WHERE categorias.nombre = ?');
        $query->execute([$categoria]);
    
        $products = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $products;
    }

    function insertProduct($nombre, $precio, $categoria) {
        $query = $this->db->prepare('INSERT INTO productos (nombre, precio, id_categoria) VALUES(?,?,?)');
        $query->execute([$nombre, $precio, $categoria]);

        return $this->db->lastInsertId();
    }

    function deleteProduct($id_producto) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id_producto]);
    }

    function updateProduct($id_producto, $nombre, $precio, $categoria) {
        $query = $this->db->prepare('UPDATE productos SET nombre = ?, precio = ?, id_categoria = ? WHERE id_producto = ?');
        return $query->execute([$nombre, $precio, $categoria, $id_producto]);
    }
}