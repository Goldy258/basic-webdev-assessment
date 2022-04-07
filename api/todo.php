<?php
try {
    require_once("todo.controller.php");
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode( '/', $uri);
    $requestType = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    $pathCount = count($path);
    $controller = new TodoController();

    
    switch($requestType) {
        case 'GET':
            if ($path[$pathCount - 2] == 'todo' && isset($path[$pathCount - 1]) && strlen($path[$pathCount - 1])) {
                $id = $path[$pathCount - 1];
                $todo = $controller->load($id);
                if ($todo) {
                    http_response_code(200);
                    die(json_encode($todo));
                }
                http_response_code(404);
                die();
            } else {
                http_response_code(200);
                die(json_encode($controller->loadAll()));
            }
            break;
        case 'POST':
            //implement your code here
       
             $fp = fopen('lidn.txt', 'a+');
            fwrite($fp, $body);
            fwrite($fp, PHP_EOL);
                
            fwrite($fp, "data decoding: ");
            $todo = json_decode($body);
            fwrite($fp, $todo->title);
            fwrite($fp, PHP_EOL);
            fwrite($fp, "creating obj: ");
            fwrite($fp, PHP_EOL);
       
            $test = new Todo(
                $todo->id,
                $todo->title,
                $todo->description,
                settype(  $todo->done, 'boolean')
            );
            fwrite($fp, "sending to Controller: ");

           
            http_response_code(200);
            die(json_encode( $controller->create($test)));
        
            fclose($fp);
            break;
        case 'PUT':
            //implement your code here
            break;
        case 'DELETE':
            //implement your code here
            break;
        default:
            http_response_code(501);
            die();
            break;
    }
} catch(Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die();
}
