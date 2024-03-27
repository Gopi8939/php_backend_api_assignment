<?php
//This function will inject in API class automatically
${basename(__FILE__, '.php')} = function () {

    if (isset($this->_request['userId'])) {

        // Handle Get request data
        $userId = $this->_request['userId'];

        // Call the function to register the Organization
        $result = Connections::getUserRecommendations($userId);
            $data = [
                "success" => true,
                "data" => $result,
            ];
            $this->response($this->json($data), 200);
        
    } else {
        $data = [
            "success" => false,
            "error" => "bad request",
        ];
        $this->response($this->json($data), 400);
    }
};
