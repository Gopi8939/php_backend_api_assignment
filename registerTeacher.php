<?php
// Database connection
include 'db_connection.php'; //  you have a separate file for DB connection

// Function to register a new teacher
function registerTeacher($name, $username, $password, $mobileNum, $college, $department, $field, $qualifications, $post, $achievements, $experience, $profilePic) {
    global $conn; //  $conn is your database connection
    
    $query = "INSERT INTO teachers (name, username, password, mobile_num, college, department, field, qualifications, post, achievements, experience, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssssss", $name, $username, $password, $mobileNum, $college, $department, $field, $qualifications, $post, $achievements, $experience, $profilePic); 
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Usage example:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST request data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobileNum = $_POST['mobile_num'];
    $college = $_POST['college'];
    $department = $_POST['department'];
    $field = $_POST['field'];
    $qualifications = $_POST['qualifications'];
    $post = $_POST['post'];
    $achievements = $_POST['achievements'];
    $experience = $_POST['experience'];
    $profilePic = $_POST['profile_pic'];
    
    // Call the function to register the teacher
    if (registerTeacher($name, $username, $password, $mobileNum, $college, $department, $field, $qualifications, $post, $achievements, $experience, $profilePic)) {
        // Success response
        $response = array("success" => true, "message" => "Teacher registered successfully");
        echo json_encode($response);
    } else {
        // Error response
        $response = array("success" => false, "message" => "Failed to register teacher");
        echo json_encode($response);
    }
}
?>
