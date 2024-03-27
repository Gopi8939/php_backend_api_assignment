<?php
//This function will inject in API class automatically

${basename(__FILE__, '.php')} = function () {
    if ($this->get_request_method() == "POST" and isset($this->_request['username']) and isset($this->_request['password'])) {
        $username = $this->_request['username'];
        $password = $this->_request['password'];
$auth =new Auth("$username", "$password");
        if ($auth) {
            $data = [
                "message" => "Login successful",
                "uid"=> $auth->getId(),
            ];
            $this->response($this->json($data), 200);
        }
    } else {
        $data = [
            "error" => "bad request",
            "method" => $this->get_request_method()
        ];
        $this->response($this->json($data), 400);
    }
};
