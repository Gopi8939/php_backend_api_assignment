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
    $department =  $this->_request['department'];
    $field =  $this->_request['field'];
    $qualifications =  $this->_request['qualifications'];
    $post =  $this->_request['post'];
    $achievements =  $this->_request['achievements'];
    $experience =  $this->_request['experience'];
    $profilePic =  $this->_request['profile_pic'];
    
    // Call the function to register the Teacher
    $register = new Register();
    if ($register->registerTeacher($name, $username, $password, $mobile, $college, $department, $field, $qualifications, $post, $achievements, $experience, $profilePic)) {
        $data = [
            "success" => true,
            "message" => "Teacher registered successfully",
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

