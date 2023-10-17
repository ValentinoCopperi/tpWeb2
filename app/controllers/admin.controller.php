<?php
require_once './app/models/product.model.php';
require_once './app/models/categoria.model.php';
require_once './app/views/admin.view.php';
require_once './app/helpers/auth.helper.php';


class adminController {
    private $productModel;
    private $categoriaModel;
    private $adminView;
    private $authHelper;

    public function __construct() {

        $this->authHelper = new authHelper();

        $this->authHelper->checkLogin();

        $this->productModel = new productModel();
        $this->categoriaModel = new categoriaModel();
        $this->adminView = new adminView();

    }

    public function showAdmin() {
       
        $products = $this->productModel->getProducts();
        $categorias = $this->categoriaModel->getCategorias();
        
        $this->adminView->showAdmin($products, $categorias);
    }

    public function addProduct() {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];

        if (empty($nombre) || empty($precio) || empty($categoria)) {
            $this->adminView->showError("Debe completar todos los campos");
            return;
        }

        if ($this->productModel->insertProduct($nombre, $precio, $categoria)) {
            header('Location: ' . BASE_URL . 'admin');
        } else {
            $this->adminView->showError("Error al insertar la tarea");
        }
    }

    public function deleteProduct($id_producto) {
        $this->productModel->deleteProduct($id_producto);
        header('Location: ' . BASE_URL . 'admin');
    }

    public function editProduct($nombre) {
        $product = $this->productModel->getProductByName($nombre);
        $categorias = $this->categoriaModel->getCategorias();
    
        $this->adminView->showEditProduct($product, $categorias);
    }
    
    public function updateProduct($id_producto) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
    
        $this->productModel->updateProduct($id_producto, $nombre, $precio, $categoria);
        header('Location: ' . BASE_URL . 'admin');
    }
    
    public function addCategoria() {
        $nombre = $_POST['nombre'];
    
        if (empty($nombre)) {
            $this->adminView->showError("Debe completar todos los campos");
            return;
        }
    
        if ($this->categoriaModel->insertCategoria($nombre)) {
            header('Location: ' . BASE_URL . 'admin');
        } else {
            $this->adminView->showError("Error al insertar la categoría");
        }
    }
    
    public function deleteCategoria($id_categoria) {
            $this->categoriaModel->deleteCategoria($id_categoria);
            header('Location: ' . BASE_URL . 'admin');
    }
    
    public function editCategoria($nombre) {
        $categoria = $this->categoriaModel->getCategoriaByName($nombre);
    
        $this->adminView->showEditCategoria($categoria);
    }
    
    public function updateCategoria($id_categoria) {
        $nombre = $_POST['nombre'];
    
        $this->categoriaModel->updateCategoria($id_categoria, $nombre);
        header('Location: ' . BASE_URL . 'admin');
    }
}