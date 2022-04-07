<?php
require_once("todo.class.php");

class TodoController {
    private const PATH = __DIR__."/todo.json";
    private array $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }  
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            foreach($dataArray as $data) {
                if (isset($data->id) && isset($data->title))
                $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done);
            }
        }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : Todo | bool {
        foreach($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $todo) : Todo | bool {
        // implement your code here

        
        $fp = fopen('lidn2.txt', 'a+');
        fwrite($fp, "In controller Create: ");
        fwrite($fp, $todo->id);
        fwrite($fp, PHP_EOL);

        array_push($this->todos,$todo);
        fwrite($fp, "after push: ");
        foreach ( $this->todos as $todo ) {
            fwrite($fp, $todo->title);
            fwrite($fp, PHP_EOL);
        }
        fclose($fp);

        $fp = fopen(self::PATH, 'w');
        fwrite($fp, print_r(json_encode($this->todos), true));
        fclose($fp);
        return $todo;
        //return true;
    }

    public function update(string $id, Todo $todo) : bool {
        // implement your code here
        return true;
    }

    public function delete(string $id) : bool {
        // implement your code here
        return true;
    }

    // add any additional functions you need below
}