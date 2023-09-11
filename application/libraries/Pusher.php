<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Pusher\Pusher;

class Pusher_lib {

    private $pusher;

    public function __construct() {
        // Load library Pusher using Composer autoloader
        require_once base_url(). 'vendor/autoload.php';

        // Initialize Pusher with your Pusher app credentials
        $this->pusher = new Pusher('f611998ccc5c0ae89879', '1120f4195898270a288c', '1666999', array('cluster' => 'ap1'));
    }

    public function getPusher() {
        return $this->pusher;
    }
}