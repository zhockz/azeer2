<?php namespace App\Controllers;

use App\Controllers\CommonController;
use CodeIgniter\Controller;

class DashboardController extends BaseController{

	//index
	public function index(){

		$session = session();

		if(!isset($_SESSION['uid'])){
			return redirect()->to(base_url());
		}

		$data = array();
		$data['title'] = 'Azeer Online System | Dashboard';
		$data['roles'] = $_SESSION['roles'];
		$data['name'] = $_SESSION['name'];

		print view("common/header",$data);
		print view("dashboard",$data);
		print view("common/footer",$data);

	}


}
