<?php
// Database connection
include 'db_connection.php'; //  you have a separate file for DB connection

// Function to register a new student
function registerStudent($name, $mobileNum, $college, $degree, $year, $coreSkills, $interests, $hobbies, $language, $profilePic, $achievements) {
    global $conn; //  $conn is your database connection
    
    $query = "INSERT INTO students (name, mobile_num, college, degree, year, core_skills, interests, hobbies, language, profile_pic, achievements) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssss", $name, $mobileNum, $college, $degree, $year, $coreSkills, $interests, $hobbies, $language, $profilePic, $achievements);
    
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
    $mobileNum = $_POST['mobile_num'];
    $college = $_POST['college'];
    $degree = $_POST['degree'];
    $year = $_POST['year'];
    $coreSkills = $_POST['core_skills'];
    $interests = $_POST['interests'];
    $hobbies = $_POST['hobbies'];
    $language = $_POST['language'];
    $profilePic = $_POST['profile_pic'];
    $achievements = $_POST['achievements'];
    
    // Call the function to register the student
    if (registerStudent($name, $mobileNum, $college, $degree, $year, $coreSkills, $interests, $hobbies, $language, $profilePic, $achievements)) {
        // Success response
        $response = array("success" => true, "message" => "Student registered successfully");
        echo json_encode($response);
    } else {
        // Error response
        $response = array("success" => false, "message" => "Failed to register student");
        echo json_encode($response);
    }
}
?>
