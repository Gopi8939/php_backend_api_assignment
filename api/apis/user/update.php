<?php
//This function will inject in API class automatically
${basename(__FILE__, '.php')} = function () {

    if ($this->get_request_method() == "POST") {

        // Handle POST request data
        $userId = $_POST['userId'];
        $newSettings = $_POST['newSettings']; //  associative array of settings to update

        // Call the function to register the Organization
        if (User::updateUserSettings($userId, $newSettings)) {
            $data = [
                "success" => true,
                "message" => "Settings updated successfully",
            ];
            $this->response($this->json($data), 200);
        }
    } else {
        $data = [
            "success" => false,
            "error" => "bad request",
        ];
        $this->response($this->json($data), 400);
    }
};
