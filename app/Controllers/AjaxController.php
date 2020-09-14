<?php namespace App\Controllers;

use App\Models\CityModel;
use App\Models\EquipNameModel;
use App\Models\EquipmentsModel;
use App\Models\UserModel;
use App\Models\TaskModel;
use App\Models\TaskPartsModel;
use App\Models\TaskToolsModel;
use App\Controllers\CommonController;
use CodeIgniter\Controller;

class AjaxController extends BaseController{

  public function index(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    $result = '';

    //for testing
    if(isset($_GET['type']) && $_GET['type'] != ''){

      if($_GET['type'] == 'getEquipName'){
        $id = $_GET['id'];
        $getOption = $common->getSelectOption($id,'equip_name');
        $result = $getOption;
      }

    }

    //for option select
    if(isset($_POST['type']) && $_POST['type'] != ''){

      $common = new CommonController();

      if($_POST['type'] == 'getEquipName'){
        $model = new EquipNameModel();
        $id = $_POST['id'];
        $getOption = $model->getAjaxRequest($id);
        $taxoName = 'equip_name';
      }

      if($_POST['type'] == 'getCity'){
        $model = new CityModel();
        $id = $_POST['id'];
        $getOption = $model->getAjaxRequest($id);
        $taxoName = 'city';
      }

      if($_POST['type'] == 'getEquipNameUser'){
        $model = new EquipmentsModel();
        $id = $_POST['id'];
        $uid = $_POST['uid'];
        $getOption = $model->getAjaxRequestEquipName($uid,$id);
        $taxoName = 'equip_name';
      }

      if($_POST['type'] == 'getEquipType'){
        $model = new EquipmentsModel();
        $uid = $_POST['uid'];
        $getOption = $model->getAjaxRequestEquipType($uid);
        $taxoName = 'equip_type';
      }

      if($_POST['type'] == 'getSerialNo'){
        $model = new EquipmentsModel();
        $id = $_POST['id'];
        $uid = $_POST['uid'];
        $getOption = $model->getAjaxRequestSerialNo($uid,$id);
        $taxoName = 'serial_no';
      }

      $arrayList = array();
      $arrayList[] = '<option value="">Please Select</option>';
      foreach($getOption as $row){
        $arrayList[] = '<option value="'.$row['id'].'">'.$row[$taxoName].'</option>';
      }

      return implode("",$arrayList);

    }

    //crud
    if(isset($_POST['action']) && $_POST['action'] != ''){

      $dateNow = date("Y-m-d H:i:s");
      $userUID = $_SESSION['uid'];

      if($_POST['action'] == 'assignEng'){

        $common = new TaskModel();
        $arrayList = array(
          'eng_uid' => $_POST['eng_uid'],
          'updated' => $dateNow,
          'updated_uid' => $userUID,
        );
        $update = $common->updateData($_POST['order_id'],$arrayList,'');
        //print_r($_POST);
      }

      if($_POST['action'] == 'addParts'){

        $CommonController = new CommonController();
        $common = new TaskPartsModel();

        $getParts = '';

        $arrayList = array(
          'order_id' =>  $_POST['order_id'],
          'part_number' => $_POST['part_number'],
          'description' => $_POST['description'],
          'qty' => $_POST['qty'],
        );
        $insertData = $common->insertData($arrayList);
        if($insertData == true){
          $getPartsResult = $CommonController->tblListTaskParts($_POST['order_id']);
          $getParts = $getPartsResult['rows_parts'];
        }else{
          $getParts = 0;
        }
        print $getParts;
      }

      if($_POST['action'] == 'delParts'){

        $CommonController = new CommonController();
        $TaskPartsModel = new TaskPartsModel();

        $getParts = '';

        $delData = $TaskPartsModel->delData($_POST['partsId']);

        if($delData == true){
          $getPartsResult = $CommonController->tblListTaskParts($_POST['order_id']);
          $getParts = $getPartsResult['rows_parts'];
        }else{
          $getParts = 0;
        }
        print $getParts;
      }

      if($_POST['action'] == 'delTools'){

        $CommonController = new CommonController();
        $TaskToolsModel = new TaskToolsModel();

        $getTools = '';

        $delData = $TaskToolsModel->delData($_POST['toolsId']);

        if($delData == true){
          $getToolsResult = $CommonController->tblListTaskTools($_POST['order_id']);
          $getTools = $getToolsResult['rows_tools'];
        }else{
          $getTools = 0;
        }
        print $getTools;
      }


      if($_POST['action'] == 'addTools'){
        $CommonController = new CommonController();
        $common = new TaskToolsModel();
        $arrayList = array(
          'order_id' =>  $_POST['order_id'],
          'name' => $_POST['name'],
          'serial_tools' => $_POST['serial_tools'],
          'calib_date' => $_POST['calib_date'],
        );
        $insertData = $common->insertData($arrayList);
        if($insertData == true){
          $getToolsResult = $CommonController->tblListTaskTools($_POST['order_id']);
          $getTools = $getToolsResult['rows_tools'];
        }else{
          $getTools = 0;
        }
        print $getTools;
      }

      if($_POST['action'] == 'delimg'){
        $TaskModel = new TaskModel();
        $column = $_POST['name'];

        $arrayList = array(
          'order_id' =>  $_POST['order_id'],
          ''.$column.'' => '',
        );

        $updateImg = $TaskModel->updateData($_POST['order_id'],$arrayList,'');
        if($updateImg == true){
          print 1;
        }else{
          print 0;
        }

      }
    }

  }

    //print view("common/header",$data);
    // print view("ajax",$data);
    //print view("common/footer",$data);

}
