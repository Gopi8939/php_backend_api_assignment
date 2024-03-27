<?php
//This function will inject in API class automatically
${basename(__FILE__, '.php')} = function () {

    if ($this->get_request_method() == "POST"and isset( $this->_request['followerId'])) {

        $followerId =  $this->_request['followerId'];
    $followingId =  $this->_request['followingId'];
        // Call the function to register the Organization
        if(Connections::sendFollowRequest($followerId, $followingId)){
            $data = [
                "success" => true,
                "message" => "Follow request sent successfully",
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
