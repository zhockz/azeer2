<?php namespace App\Controllers;

use CodeIgniter\Controller;

class LogoutController extends BaseController{

	//index
	public function index(){

		$session = session();
		$session->destroy();
		return redirect()->to(base_url().'?action=logout');

	}


}
