<?php
class TaskManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addTask($task)
    {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO tasks (task) VALUES ('$task')";
        $conn->query($sql);
    }

    public function deleteTask($id)
    {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM tasks WHERE id=$id";
        $conn->query($sql);
    }

    public function updateTask($id)
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE tasks SET completed = 1 - completed WHERE id=$id";
        $conn->query($sql);
    }

    public function getTasks()
    {
        $tasks = array();
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM tasks ORDER BY id ASC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        return $tasks;
    }
}
?>


<!-- Taskmanager.class.php -->