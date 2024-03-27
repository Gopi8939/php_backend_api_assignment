<?php
//This function will inject in API class automatically

${basename(__FILE__, '.php')} = function () {

    if ($this->get_request_method() == "POST" and isset($this->_request['username']) and isset($this->_request['password'])and isset($this->_request['mobile'])) {

        // Handle POST request data
        $name =  $this->_request['name'];
        $username =  $this->_request['username'];
        $password =  $this->_request['password'];

        $mobile =  $this->_request['mobile'];
        $college =  $this->_request['college'];
        $degree =  $this->_request['degree'];
        $year =  $this->_request['year'];
        $coreSkills =  $this->_request['core_skills'];
        $interests =  $this->_request['interests'];
        $hobbies =  $this->_request['hobbies'];
        $language =  $this->_request['language'];
        $profilePic =  $this->_request['profile_pic'];
        $achievements =  $this->_request['achievements'];
        // Call the function to register the student
        $register = new Register();
        if ($register->registerStudent($name,$username,$password, $mobile, $college, $degree, $year, $coreSkills, $interests, $hobbies, $language, $profilePic, $achievements)) {
            $data = [
                "success" => true,
                "message" => "Student registered successfully",
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

