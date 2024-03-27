<?php
// Database connection
include 'db_connection.php'; // separate file for DB connection

// Function to authenticate user login
function authenticateUser($username, $password) {
    global $conn; //  $conn is your database connection
    
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Usage example:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST request data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Call the function to authenticate user login
    if (authenticateUser($username, $password)) {
        // Success response
        $response = array("success" => true, "message" => "Login successful");
        echo json_encode($response);
    } else {
        // Error response
        $response = array("success" => false, "message" => "Invalid username or password");
        echo json_encode($response);
    }
}
?>
