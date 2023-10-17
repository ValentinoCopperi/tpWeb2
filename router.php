<?php
require_once './app/controllers/product.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/admin.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'productos';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    header("Location: " . BASE_URL . 'productos');
    exit();
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'productos':
        $controller = new productController();
        $controller->showProducts();
        break;
    case 'producto':
        $controller = new productController();
        $controller->showProductByName($params[1]);
        break;
    case 'agregarproducto':
        $controller = new adminController();
        $controller->addProduct();
        break;
    case 'eliminarproducto':
        $controller = new adminController();
        $controller->deleteProduct($params[1]);
        break;
    case 'editarproducto':
        $controller = new adminController();
        $controller->editProduct($params[1]);
        break;
    case 'actualizarproducto':
        $controller = new adminController();
        $controller->updateProduct($params[1]);
        break;                     
    case 'categoria':
        $controller = new productController();
        $controller->showProductsByCategoria($params[1]);
        break;
    case 'agregarcategoria':
        $controller = new adminController();
        $controller->addCategoria();
        break;
    case 'eliminarcategoria':
        $controller = new adminController();
        $controller->deleteCategoria($params[1]);
        break;
    case 'editarcategoria':
        $controller = new adminController();
        $controller->editCategoria($params[1]);
        break;
    case 'actualizarcategoria':
        $controller = new adminController();
        $controller->updateCategoria($params[1]);
        break;  
    case 'login':
        $controller = new authController();
        $controller->showLogin(); 
        break;
    case 'logout':
        $controller = new authController();
        $controller->logout();
        break;   
        case 'auth':
        $controller = new authController();
        $controller->auth();
        break;
    case 'admin':
        $controller = new adminController();
        $controller->showAdmin();
        break;
    default:
        echo 'error';
        break;
}