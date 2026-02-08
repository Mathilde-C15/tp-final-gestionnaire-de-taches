<?php 

require __DIR__ . '/../config/db.php';

function getTasksByUserId(int $taskId, int $userId) : ?array {
    $db = connectToDB();
    try {
        $query = $db->prepare('SELECT * FROM tasks WHERE id = :task_id AND user_id = :user_id');
        $query->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $query->execute();
        $tasks = $query->fetchAll(PDO::FETCH_ASSOC);
        var_dump($tasks);
        return $tasks ?: null;
    } catch (Exception $e) {
        //die($e->getMessage());
        return null;
    }
}

function addTaskForUser(int $userId, string $title, string $content, bool $urgent) : bool {
    $db = connectToDB();
    try {
        $query = $db->prepare('INSERT INTO tasks (title, content, urgent, important, user_id) 
        VALUES (:title, :content, :urgent, :important, :user_id)');
        
        $urgentInt = $urgent ? 1 : 0;
        $importantInt = $important ? 1 : 0;
        
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->bindParam(':urgent', $urgentInt, PDO::PARAM_INT);
        $query->bindParam(':important', $importantInt, PDO::PARAM_INT);
        $query->bindParam(':user_id', $userId, PDO::PARAM_INT);

        return $query->execute();
    } catch (Exception $e) {
        //die($e->getMessage());
        return false;
    }
}

function deleteTaskForUser(int $taskId, int $userId) : bool {
    $db = connectToDB();
    try {
        $query = $db->prepare('DELETE FROM tasks WHERE id = :task_id AND user_id = :user_id');
        $query->bindParam(':task_id', $taskId, PDO::PARAM_INT);
        $query->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $query->execute();
    } catch (Exception $e) {
        //die($e->getMessage());
        return false;
    }
}

function updateTaskForUser(int $taskId, int $userId, string $title, string $content, bool $urgent, bool $important) : bool {
    $db = connectToDB();
    try {
        $query = $db->prepare('UPDATE tasks SET title = :title, content = :content, urgent = :urgent, important = :important WHERE id = :task_id AND user_id = :user_id');
        
        $urgentInt = $urgent ? 1 : 0;
        $importantInt = $important ? 1 : 0;
        
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->bindParam(':urgent', $urgentInt, PDO::PARAM_INT);
        $query->bindParam(':important', $importantInt, PDO::PARAM_INT);
        $query->bindParam(':task_id', $taskId, PDO::PARAM_INT);
        $query->bindParam(':user_id', $userId, PDO::PARAM_INT);

        return $query->execute();
    } catch (Exception $e) {
        //die($e->getMessage());
        return false;
    }
}