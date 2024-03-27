<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/api/lib/load.php";

class Auth
{
private $id;
    // Function to authenticate user login
  public function __construct($username, $password) {
    $conn = Database::getConnection(); //  $conn is your database connection
    
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $this->id = $row['id'];     
        return true;
    } else {
        throw new Exception("Invalid username or password");        
    }
  
}  public function getId()
{
    return $this->id;
}

}
