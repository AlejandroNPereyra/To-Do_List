<?php

class TaskModel {

    protected $tasks = [];
    protected $jsonPath;


    public function __construct() {

        $this->jsonPath = ROOT_PATH . '/app/models/data/DDBB.json';

    }

    public function getAllTasks() {

        // $data= file_get_contents('/..app/models/data/DDBB.json') ;
        $data = file_get_contents($this->jsonPath);
        $tasks = json_decode($data, true);
        return $tasks;

    }

    // METODO CREAR TAREA
    public function createTask($newTask) {

        $jsonPath = ROOT_PATH . '/app/models/data/DDBB.json';
        $jsonData = file_get_contents($jsonPath);
        $tasks = json_decode($jsonData, true);

        $tasks[] = $newTask;

        // Convierte el array actualizado a formato JSON
        $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);

        // Escribe el nuevo JSON en el archivo
        file_put_contents($jsonPath, $newJsonData);


        // Redirecciona o muestra un mensaje de éxito(NO SE COMO VA)
        // header("Location: CreateTask.phtml");
        //exit();

    }

    //METODO AÑADIR TAREA A JSON
    public function addTask($newTask) {
        // Lee el contenido actual del archivo JSON
        $jsonData = file_get_contents($this->jsonPath);
    
        // Decodifica el contenido JSON en un arreglo
        $tasks = json_decode($jsonData, true);
    
        // Agrega la nueva tarea al arreglo de tareas
        $tasks[] = $newTask;
    
        // Convierte el arreglo actualizado a formato JSON
        $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);
    
        // Escribe el nuevo JSON en el archivo
        file_put_contents($this->jsonPath, $newJsonData);
    }

    public function ediTask() {
        
    }

    // METODO BORRAR TAREA
    public function deleteTask($taskId) {

    $jsonData = file_get_contents($this->jsonPath);
    $tasks = json_decode($jsonData, true);

    foreach ($tasks as $key => $task) {

        if ($task['id'] == $taskId) {

            // Remove the task from the tasks array
            unset($tasks[$key]);

            break;

        }

    }

    // Re-index the array to ensure it's sequential
    $tasks = array_values($tasks);

    $newJsonData = json_encode($tasks, JSON_PRETTY_PRINT);
    file_put_contents($this->jsonPath, $newJsonData);

    }
    
}