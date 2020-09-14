<?php
class Principal extends CI_Controller {

	function __construct() {
		parent:: __construct();
		$this->load->model('Principal_model');

	}

	function index(){
		echo '¡Hola!';
		//$_SESSION['UserID'] ='';
session_start();
		
	}


}
?>
