<?php

/**
 * Controlador base para la aplicación.
 * Agregar cosas generales en este controlador.
 */

class ApplicationController extends Controller
{

    public function indexAction()
    {
    }

    public function formAction()
    {
    }

    public function getAllTasksAction()
    {

        $dataJ = [];

        $dataJson = new TaskModel();
        $dataJ = $dataJson->getAllTasks();

        //return $dataJ;

        $this->view->dataJ = $dataJ;
    }

    public function createTaskAction()
    {
        // Si se recibe una solicitud HTTP POST, recopila datos del formulario
        $newTask = null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtén los datos del formulario
            $taskDescription = $_POST["taskDescription"];
            $author = $_POST["author"];
            $startingDate = $_POST["startingDate"];
            $enDate = $_POST["enDate"];
            $status = $_POST["status"];

            //COMPRUEBO SI ALMACENA LOS DATOS
            // var_dump($_POST);

            // Crea un nuevo array con los datos del formulario
            $newTask = [
               
                "task_description" => $taskDescription,
                "author" => $author,
                "starting_date" => $startingDate,
                "end_date" => $enDate,
                "status" => $status,
                "id" =>NULL
                // ↑↑ POR ARREGLAR

            ];
            // $this->view->newTask = $newTask;

        }
        if ($newTask !== null) {
            // Llamar a un método para agregar la tarea al modelo, por ejemplo:
            $createTaskModel = new TaskModel();
            $createTaskModel->createTask($newTask);
            $this->view->createTaskModel = $createTaskModel;
        }
    }

    public function ediTaskAction()
    {
        // Asigno el valor del input "name:taskId"
        // Usando el operador ternario "? $_POST["taskId"] : null;", le asigno valor en función de la verificación: "isset($_POST["taskId"])"
        $taskId = isset($_POST["taskId"]) ? $_POST["taskId"] : null; 
        
        
        if ($taskId !== null) {
            
            $taskModel = new TaskModel();
            $taskToEdit = $taskModel->getTaskById($taskId);

            // Existe la tarea con ese id?
            if ($taskToEdit) {
                // Visualizamos
                $this->view->taskToEdit = $taskToEdit;
                
            } else {
                echo "La tarea no existe.";
            }
        } else {
            echo "ID de tarea no válido.";
        }
    }
    public function updateTaskAction()
    {
        // Si se recibe una solicitud HTTP POST, recopila datos del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $taskId = $_POST["taskId"];
            $taskDescription = $_POST["taskDescription"];
            $author = $_POST["author"];
            $startingDate = $_POST["startingDate"];
            $enDate = $_POST["endDate"];
            $status = $_POST["status"];

            //COMPRUEBO SI ALMACENA LOS DATOS
            // var_dump($_POST);

            // Array con los datos actualizados
            $updatedTask = [
                "task_description" => $taskDescription,
                "author" => $author,
                "starting_date" => $startingDate,
                "end_date" => $enDate,
                "status" => $status
            ];
            //Ya se puede actualizar la tarea
            $taskModel = new TaskModel();
            $taskModel->updateTask($taskId, $updatedTask);
            
        }
    }
}
