<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Soap_client extends CI_controller {

    function __construct(){
        parent::__construct();
        $this->load->library("Nusoap_lib");
        $this->load->helper("url");
    }

    function index(){
        $this->soapclient = new soapclient("http://localhost/ci3-soap-server/index.php/Soap_WS/wsdl", true);
        $err = $this->soapclient->getError();
        if ($err) {
            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        }
        $result = $this->soapclient->call('hello', array('name' => 'Rony'));
        if ($this->soapclient->fault){ // Check for a fault
            echo '<h2>Fault</h2><pre>';
            print_r($result);
            echo '</pre>';
        }else{
            $err = $this->soapclient->getError(); // Check for errors
            if ($err){
                echo '<h2>Error</h2><pre>' . $err . '</pre>'; // Display the error
            }else{
                echo '<h2>Result</h2><pre>'; // Display the result
                print_r($result);
                echo '</pre>';
            }
        }
    }

}