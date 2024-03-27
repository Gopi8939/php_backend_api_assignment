<?php
//This function will inject in API class automatically
${basename(__FILE__, '.php')} = function () {

    if ($this->get_request_method() == "POST" and isset($this->_request['username']) and isset($this->_request['password'])and isset($this->_request['mobile'])) {

        // Handle POST request data
        $collegeName =  $this->_request['college'];
        $mobileNum =  $this->_request['mobile'];
        $username =  $this->_request['username'];
        $password =  $this->_request['password'];
        $city =  $this->_request['city'];
        $orgEmail =  $this->_request['org_email'];
        $profilePic =  $this->_request['profile_pic'];

        // Call the function to register the Organization
        $register = new Register();
        if ($register->registerOrganization($collegeName, $mobileNum, $username, $password, $city, $orgEmail, $profilePic)) {
            $data = [
                "success" => true,
                "message" => "Organization registered successfully",
                "uid"=> $register->getId(),
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
