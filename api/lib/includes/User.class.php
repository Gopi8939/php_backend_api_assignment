<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/api/lib/load.php";

class User
{
// Function to update user settings
public static function updateUserSettings($userId, $newSettings)
{
    global $conn;
    
    // Construct SQL query
    $sql = "UPDATE users SET ";
    foreach ($newSettings as $key => $value) {
        $sql .= "$key = '$value', ";
    }
    $sql = rtrim($sql, ", "); // Remove the trailing comma and space
    $sql .= " WHERE id = $userId";
    
    // Execute query
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        throw new Exception("Error updating settings: " . $conn->error);
    }
}
   
}
