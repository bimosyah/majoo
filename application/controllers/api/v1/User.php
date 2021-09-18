<?php


defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{
    const TABLE = "tbl_user";

    function __construct($config = 'rest') {
        parent::__construct($config);
    }
}