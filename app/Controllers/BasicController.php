<?php namespace App\Controllers;

use App\Controllers\CommonController;
use App\Models\UserModel;
use CodeIgniter\Controller;

class BasicController extends BaseController{

  public function index(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }


    helper(["form"]);

    $data = array();
    $data['title'] = 'Azeer Online System | Basic';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    print view("common/header",$data);
    print view("basic",$data);
    print view("common/footer",$data);

  }

}
