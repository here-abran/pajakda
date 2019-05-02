<?php

/*
 * By : Praditya Kurniawan
 * website : http://masiyak.com
 * email : aku@masiyak.com
 *
 * - CIRCLE LABS - 
 * http://circlelabs.id
 *  
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "third_party/Requests.php";

class PHPRequests {

    public function __construct() {
        Requests::register_autoloader();
    }

}
