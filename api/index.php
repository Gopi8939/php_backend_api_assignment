<?php

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_DEPRECATED);

include_once $_SERVER["DOCUMENT_ROOT"] . "/api/lib/load.php";

class API extends REST
{

    public $data = "";



    private $db = NULL;
    private $current_class;


    public function __construct()
    {
        parent::__construct();

        // Initiate Database connection
        $this->db = Database::getConnection();
    }
    public function die($e)
    {
        $error = $e->getMessage();

        $data = [
            "success"=>false,
            "error" => $error,
        ];

        $response_code = 400;
        if ($error == "Unauthorized") {
            $response_code = 401;
        }
        if ($error == "Not found") {
            $response_code = 401;
        }

        $this->response($this->json($data), $response_code);
    }



    /**
     * Public method for access api.
     * This method dynmically call the method based on the query string
     */
    public function processApi()
    {
        $func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
        if ((int)method_exists($this, $func) > 0)
            $this->$func();
        else {
            if (isset($_GET['namespace'])) {
                $dir = $_SERVER["DOCUMENT_ROOT"] . '/api/apis/' . $_GET['namespace'];
                $file = $dir . '/' . $func . '.php';
                /**            
                 * Use this following snippet if you want to include single file 
                 */
                if (file_exists($file)) {
                    include $file;
                    /**
                     * get_class() method:-
                     * @return currentClass
                     * $basem:- It Contain function name 
                     * closure::bind:-
                     * It Bind the $basem function to current class using 
                     */
                    $this->current_class = closure::bind(${$func}, $this, get_class());
                    $this->$func();
                } else {
                    $this->response($this->json(['error' => 'method_not_found']), 404);
                }

              } else {
                $this->response($this->json(['error' => 'method_not_found']), 404);
            }
            // If the method not exist with in this class, response would be "Page not found".
        }
    }



    public function __call($method, $args)
    {
        if (is_callable($this->current_class)) {
            return call_user_func_array($this->current_class, $args);
        } else {
            $this->response($this->json(['error' => 'method_not_callable']), 404);
        }
    }
    /*************API SPACE START*******************/

    private function about()
    {

        if ($this->get_request_method() != "POST") {
            $error = array('status' => 'WRONG_CALL', "msg" => "The type of call cannot be accepted by our servers.");
            $error = $this->json($error);
            $this->response($error, 406);
        }
        $data = array('version' => $this->_request['version'], 'desc' => 'This API is created by Blovia Technologies Pvt. Ltd., for the public usage for accessing data about vehicles.');
        $data = $this->json($data);
        $this->response($data, 200);
    }

    private function test()
    {
        $data = $this->json(getallheaders());
        $this->response($data, 200);
    }

    private function request_info()
    {
        $data = $this->json($_SERVER);
    }

    /*************API SPACE END*********************/

    /*
            Encode array into JSON
        */
    private function json($data)
    {
        if (is_array($data)) {
            return json_encode($data, JSON_PRETTY_PRINT);
        } else {
            return "{}";
        }
    }
}

// Initiiate Library

$api = new API;
try {
    $api->processApi();
} catch (Exception $e) {
    $api->die($e);
}
