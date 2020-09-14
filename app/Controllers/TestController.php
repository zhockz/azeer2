<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FlagModel;
use App\Models\StatusModel;
use App\Models\StatusTaskModel;
use App\Models\StatusEquipModel;
use App\Models\EquipStatusModel;
use App\Models\EquipmentsModel;
use App\Models\StatusSCModel;
use App\Models\RolesModel;
use App\Models\RegionModel;
use App\Models\CityModel;
use App\Models\StaffsModel;
use App\Models\EquipTypeModel;
use App\Models\EquipNameModel;
use App\Models\AttachModel;
use App\Models\TaskModel;
use App\Models\TaskHistoryModel;
use App\Models\TaskPartsModel;
use App\Models\TaskToolsModel;
use App\Models\TestModel;
use CodeIgniter\Controller;

class TestController extends BaseController{

  public function index(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }


    helper(["form"]);

    $data = array();
    $data['title'] = 'Azeer Online System | Test';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    //test environment
    $TestModel = new TestModel();
    $getEquipDetails = $TestModel->getDate(1);
    $visit1 = strtotime($getEquipDetails['visit_1']);
    $visit2 = $getEquipDetails['visit_2'];
    $dateToday = time();




    $difference = $visit1 - $dateToday;
    $numDays =  floor($difference / 86400) + 1;


    print $dateToday."\n";
    print $visit1."\n";
    print $numDays."\n";

    print_r($getEquipDetails);

    print view("common/header",$data);
    print view("testPage",$data);
    print view("common/footer",$data);

  }

}
