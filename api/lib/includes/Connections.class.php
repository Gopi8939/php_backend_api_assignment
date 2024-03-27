<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/api/lib/load.php";

class Connections
{
    private $db;

    // Function to send follow request
    public static function sendFollowRequest($followerId, $followingId)
    {
        $conn = Database::getConnection(); //  $conn is your database connection
        // Check if the follow request already exists
        $checkQuery = "SELECT * FROM follow_requests WHERE follower_id = $followerId AND following_id = $followingId";
        $result =  $conn->query($checkQuery);
        if ($result->num_rows > 0) {
            throw new Exception("Follow request already sent: " . $conn->error);
        }

        // Insert new follow request
        $sql = "INSERT INTO follow_requests (follower_id, following_id) VALUES ($followerId, $followingId)";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            throw new Exception("Error sending follow request: " . $conn->error);
        }
    }
    // Function to retrieve user recommendations based on specific criteria
    public static  function getUserRecommendations($userId)
    {

        // Implement logic to generate recommendations based on user details
        // For example, recommendations based on same college, same degree, same core skills, etc.
        // Construct SQL query and fetch recommendations

        // Sample query
        $conn = Database::getConnection(); //  $conn is your database connection

        // $sql = "SELECT * FROM users WHERE college = (SELECT college FROM users WHERE id = $userId) AND id != $userId LIMIT 10";
        $sql = "SELECT id, username FROM users WHERE college = (SELECT college FROM users WHERE id = $userId) AND id != $userId LIMIT 10";
        $result = $conn->query($sql);

        $recommendations = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recommendations[] = $row;
            }
        }

        return $recommendations;
    }
}
