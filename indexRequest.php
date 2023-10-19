<?php

function handleRequest($controllerName, $action) {
    // Comprobar que se han proporcionado el nombre del controlador y la acción
    if (empty($controllerName) || empty($action)) {
        return ['status' => 'error', 'message' => 'Debes proporcionar el nombre del controlador y la acción.'];
    }

    // Comprobar si el archivo del controlador existe
    $controllerFile = 'controllers/' . ucfirst($controllerName) . 'Controller.php';
    if (!file_exists($controllerFile)) {
        return ['status' => 'error', 'message' => 'Controlador no encontrado'];
    }

    // Incluir el controlador y establecer la conexión a la base de datos
    require_once $controllerFile;
    require_once 'config/Database.php';
    $db = Database::getInstance();
    $pdo = $db->getConnection();

    // Crear una instancia del controlador
    $controllerClass = ucfirst($controllerName) . 'Controller';
    $controller = new $controllerClass($pdo);

    // Ejecutar la acción correspondiente
    $result = $controller->$action();

    $db->closeConnection();

    return $result;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controllerName = isset($_POST['controller']) ? $_POST['controller'] : '';
    $action = isset($_POST['action']) ? $_POST['action']: '';

    $response = handleRequest($controllerName, $action);
} else {
    $response = ['status' => 'error', 'message' => 'Debes enviar información a través de POST'];
}

// Devolver una respuesta JSON
header('Content-Type: application/json');
echo json_encode($response);
