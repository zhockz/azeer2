<?php namespace App\Controllers;

use App\Controllers\CommonController;
use App\Models\UserModel;
use App\Models\EquipmentsModel;
use App\Models\TaskModel;
use CodeIgniter\Controller;

class TaskController extends BaseController{

  //index
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

  //task view
  public function taskView(){

    //session
    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(!isset($_GET['order_id']) || $_GET['order_id'] == ''){
     return redirect()->to(base_url()."/unathorized");
    }

    //data
    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    //connect
    $TaskModel = new TaskModel();
    $common = new CommonController();
    $EquipmentsModel = new EquipmentsModel();
    $UserModel = new UserModel();

    if(isset($_POST['updateTask'])){

      if(isset($_FILES['img_before']['size']) && $_FILES['img_before']['size'] != 0){
        $common->uploadImgRepair($_GET['order_id'],'img_before',$_FILES['img_before']);
      }

      if(isset($_FILES['img_after']['size']) && $_FILES['img_after']['size'] != 0){
        $common->uploadImgRepair($_GET['order_id'],'img_after',$_FILES['img_after']);
      }

      if(isset($_FILES['img_attach']['size']) && $_FILES['img_attach']['size'] != 0){
        $common->uploadImgRepair($_GET['order_id'],'img_attach',$_FILES['img_attach']);
      }

      $updateData = $TaskModel->updateData($_GET['order_id'],$_POST,$_FILES);
      if($updateData == true){
        $data['result'] = "success";
        $data['message'] = "Order Id: ".$_GET['order_id']." has been successfully updated...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Updating Order Id: ".$_GET['order_id']." was failed. Possible the a previous request are not yet completed. Please call support team...";
      }

      $getOrderDetailsForStatus = $TaskModel->getTaskByOrderId($_GET['order_id']);
      if($getOrderDetailsForStatus['status'] != 5){
        if($getOrderDetailsForStatus['contact_name'] != '' && $getOrderDetailsForStatus['contractor'] != '' && $getOrderDetailsForStatus['img_attach'] != ''){

          $arrayStatusUpdate = array(
            'status' => 5
          );
          $TaskModel->updateData($_GET['order_id'],$arrayStatusUpdate,'');
        }
      }
    }

    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("YmdHis");
    $userUID = $_SESSION['uid'];

    $getOrderDetails = $TaskModel->getTaskByOrderId($_GET['order_id']);
    $getEquipmentDetails = $EquipmentsModel->getEquipmentsSpecific($getOrderDetails['equipments']);
    $getCustomerDetails = $UserModel->getUserDataById($getOrderDetails['uid']);
    $getEngineerDetails = $UserModel->getUserDataById($getOrderDetails['eng_uid']);
    $getTaskParts = $common->tblListTaskParts($_GET['order_id']);
    $getTaskTools = $common->tblListTaskTools($_GET['order_id']);

    if($getEngineerDetails == false){
      $engId = '';
    }else{
      $engId = $getOrderDetails['eng_uid'];
    }

    $engSelectOption = $common->getSelectOption($engId,'users_eng');
    $taskStatusSelectOption = $common->getSelectOption($getOrderDetails['status'],'task_status');
    $scStatusSelectOption = $common->getSelectOption($getOrderDetails['sc_type'],'sc_type');

    $data['orderId'] = $getOrderDetails['order_id'];
    $data['orderDate'] = date("Y-m-d", strtotime($getOrderDetails['created']));
    $data['eng_option'] = $engSelectOption;
    $data['engName'] = $getEngineerDetails['name'];
    $data['taskStatus_option'] = $taskStatusSelectOption;
    $data['taskStatusName'] = $common->getTaxoName($getOrderDetails['status'],'task_status');

    $data['arrival_date'] = $getOrderDetails['arrival_date'];
    $data['arrival_time'] = $getOrderDetails['arrival_time'];
    $data['start_time'] = $getOrderDetails['start_time'];
    $data['end_time'] = $getOrderDetails['end_time'];

    $data['customer'] = $getCustomerDetails['name'];
    $data['contact_name'] = $getOrderDetails['contact_name'];
    $data['contractor'] = $getOrderDetails['contractor'];

    $data['equip_type'] = $common->getTaxoName($getEquipmentDetails['equip_type'],'equip_type');
    $data['equip_name'] = $common->getTaxoName($getEquipmentDetails['equip_name'],'equip_name');
    $data['serial_no'] = $getEquipmentDetails['serial_no'];
    $data['issue'] = $getOrderDetails['issue'];
    $data['equip_status'] = $common->getTaxoName($getEquipmentDetails['status'],'equip_status');
    $data['sc_option'] = $scStatusSelectOption;
    $data['scName'] = $common->getTaxoName($getOrderDetails['sc_type'],'sc_type');
    $data['install_no'] = $getEquipmentDetails['install_no'];
    $data['manufacturer'] = $getEquipmentDetails['manufacturer'];
    $data['img_before'] = $getOrderDetails['img_before'];
    $data['img_after'] = $getOrderDetails['img_after'];

    $data['assessment'] = $getOrderDetails['assessment'];
    $data['action'] = $getOrderDetails['action'];

    $data['img_attach'] = $getOrderDetails['img_attach'];

    $data['rows_parts'] = $getTaskParts['rows_parts'];
    $data['rows_tools'] = $getTaskTools['rows_tools'];

    $data['eng_assigned_uid'] = $getEngineerDetails['id'];

    $data['recentTaskPage'] = '';

    if(isset($_SESSION['recent_page'])){
      $data['recentTaskPage'] = $_SESSION['recent_page'];
    }

    if($getOrderDetails['contact_name'] != '' && $getOrderDetails['contractor'] != ''){
      $printPdfStatus = 1;
    }else{
      $printPdfStatus = 0;
    }

    $data['printPdfStatus'] = $printPdfStatus;

    if($_SESSION['roles'] <= 2){
      $data['title_head'] = 'Task <small class="fnt-18">View</small>';
    }

    if($_SESSION['roles'] == 3){
      $data['title_head'] = 'Task <small class="fnt-18">View</small>';
    }

    if($_SESSION['roles'] == 4){
      $data['title_head'] = 'Request <small class="fnt-18">View</small>';
    }

    //views
    print view("common/header",$data);
    print view("taskView",$data);
    print view("common/footer",$data);

  }

  //new task from customer
  public function requestNew(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles']) && $_SESSION['roles'] != 4){
     return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    $_SESSION['recent_page'] = 'request/new';

    //connect
    $common = new CommonController();
    $TaskModel = new TaskModel();

    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("yjd");
    $userUID = $_SESSION['uid'];

    $data = array();
    $data['result'] = "";
    $data['message'] = "";


    //post
    if(isset($_POST['submitRequest'])){

      $insertData = $common->insertData('task_customer',$_POST);
      if($insertData == true){
        $data['result'] = "success";
        $data['message'] = "New request has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new request was failed. Possible the a previous request are not yet completed. Please call support team...";
      }
    }

    $data['title'] = 'Azeer Online System | New Request';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    $getTaskCount = $TaskModel->getTaskCount($_SESSION['uid']) + 1;
    $data['order_id'] = "AZR0".$_SESSION['uid'].'0'.$getTaskCount;
    $data['order_date'] = $dateNow;

    $getSelectEquipType = $common->getSelectOptionEquipments('equip_type');
    $getSelectSCType = $common->getSelectOption('','sc_type');
    $data['option_equipType'] = $getSelectEquipType;
    $data['option_scType'] = $getSelectSCType;

    $getTaskNew = $common->tblListTask($userUID,1);
    $data['taskList'] = $getTaskNew['rows'];
    $data['taskCount'] = $getTaskNew['count'];
    $data['taskPageCount'] = $getTaskNew['pager_count'];
    $data['pagination'] = $getTaskNew['pagination'];

    print view("common/header",$data);
    print view("taskRequestNew",$data);
    print view("common/footer",$data);

  }

  //new task for admin
  public function taskNew(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles']) && $_SESSION['roles'] > 3){
     return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    $_SESSION['recent_page'] = 'task/new';

    //connect
    $common = new CommonController();
    $UserModel = new UserModel();

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url()."/task/new?search=1&from_date=".$_POST['from_date']."&to_date=".$_POST['to_date']."");
    }


    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("yjd");
    $userUID = $_SESSION['uid'];

    $data = array();
    $data['result'] = "";
    $data['message'] = "";
    //$data['cus_name'] = '';
    //$data['eng_name'] = '';
    $cus_id = '';
    $eng_id = '';

    if(isset($_GET['eng_uid']) && $_GET['eng_uid'] != ''){

      $getUserEng = $UserModel->getUserDataById($_GET['eng_uid']);
      //$data['eng_name'] = $getUserEng['name'];
        $eng_id = $getUserEng['id'];

      if(isset($getUserEng['hospital']) && $getUserEng['hospital'] != ''){
          $getUserCus = $UserModel->getUserDataById($getUserEng['hospital']);
          $data['cus_name'] = $getUserCus['name'];
          $cus_id = $getUserCus['id'];
      }

    }

    //post
    if(isset($_POST['submitRequest'])){
      $insertData = $common->insertData('task_engineer',$_POST);
      if($insertData == true){
        $data['result'] = "success";
        $data['message'] = "New task has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new task was failed. Possible the a previous request are not yet completed. Please call support team...";
      }
    }

    $data['title'] = 'Azeer Online System | New Task';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];


    /*
    $data['order_id'] = "AZEER0".$_SESSION['uid']."0".$dateId;
    $data['order_date'] = $dateNow;

    $getSelectEquipType = $common->getSelectOptionEquipments('equip_type');
    $data['option_equipType'] = $getSelectEquipType;
      */

    $getEng = $common->getSelectOption($eng_id,'users_eng');
    $getCus = $common->getSelectOption($cus_id,'users_cus');
    $data['engSelect'] = $getEng;
    $data['cusSelect'] = $getCus;

    $getSelectSCType = $common->getSelectOption('','sc_type');
    $data['option_scType'] = $getSelectSCType;

    if($_SESSION['roles'] <= 2){
      $getTaskNew = $common->tblListTask('',1);
    }

    if($_SESSION['roles'] > 2){
      $getTaskNew = $common->tblListTask($_SESSION['uid'],1);
    }

    $data['taskList'] = $getTaskNew['rows'];
    $data['taskCount'] = $getTaskNew['count'];
    $data['taskPageCount'] = $getTaskNew['pager_count'];
    $data['pagination'] = $getTaskNew['pagination'];

    print view("common/header",$data);
    print view("taskNew",$data);
    print view("common/footer",$data);

  }

  //Task in progress
  public function taskInProgress(){
    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(!isset($_SESSION['roles'])){
     return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    //connect
    $common = new CommonController();

    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("YmdHis");
    $userUID = $_SESSION['uid'];

    $data = array();
    $data['result'] = "";
    $data['message'] = "";



    if($_SESSION['roles'] <= 2){

      $data['head_title'] = 'Task <small class="fnt-18">In Progress</small>';
      $data['table_title'] = 'In Progress Tasks';
      $data['table_link'] = "/task/inprogress";
      $searchLink = "/task/inprogress";
      $_SESSION['recent_page'] = 'task/inprogress';

      $getTaskNew = $common->tblListTask('',2);

    }

    if($_SESSION['roles'] == 3){

      $data['head_title'] = 'Task <small class="fnt-18">In Progress</small>';
      $data['table_title'] = 'In Progress Tasks';
      $data['table_link'] = "/task/inprogress";
      $searchLink = "/task/inprogress";
      $_SESSION['recent_page'] = 'task/inprogress';

      $getTaskNew = $common->tblListTask($_SESSION['uid'],2);
    }

    if($_SESSION['roles'] == 4){

      $data['head_title'] = 'Request <small class="fnt-18">In Progress</small>';
      $data['table_title'] = 'In Progress Requests';
      $data['table_link'] = "/request/inprogress";
      $searchLink = "/request/inprogress";
      $_SESSION['recent_page'] = 'request/inprogress';

      $getTaskNew = $common->tblListTask($_SESSION['uid'],2);
    }

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url().$searchLink."?search=1&from_date=".$_POST['from_date']."&to_date=".$_POST['to_date']."");
    }


    $data['taskList'] = $getTaskNew['rows'];
    $data['taskCount'] = $getTaskNew['count'];
    $data['taskPageCount'] = $getTaskNew['pager_count'];
    $data['pagination'] = $getTaskNew['pagination'];

    print view("common/header",$data);
    print view("taskPages",$data);
    print view("common/footer",$data);
  }

  //Task in complete
  public function taskCompleted(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(!isset($_SESSION['roles'])){
     return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    //connect
    $common = new CommonController();

    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("YmdHis");
    $userUID = $_SESSION['uid'];

    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    $data['head_title'] = 'Task <small class="fnt-18">Completed</small>';
    $data['table_title'] = 'Completed Tasks';

    if($_SESSION['roles'] <= 2){
      $data['head_title'] = 'Task <small class="fnt-18">Completed</small>';
      $data['table_title'] = 'Completed Tasks';
      $data['table_link'] = "/task/completed";
      $searchLink = "/task/completed";
      $getTaskNew = $common->tblListTask('',5);
      $_SESSION['recent_page'] = 'task/completed';
    }
    if($_SESSION['roles'] == 3){
      $data['head_title'] = 'Task <small class="fnt-18">Completed</small>';
      $data['table_title'] = 'Completed Tasks';
      $data['table_link'] = "/task/completed";
      $searchLink = "/task/completed";
      $getTaskNew = $common->tblListTask($_SESSION['uid'],5);
      $_SESSION['recent_page'] = 'task/completed';
    }
    if($_SESSION['roles'] == 4){
      $data['head_title'] = 'Request <small class="fnt-18">Completed</small>';
      $data['table_title'] = 'Completed Requests';
      $data['table_link'] = "/request/completed";
      $searchLink = "/request/completed";
      $getTaskNew = $common->tblListTask($_SESSION['uid'],5);
      $_SESSION['recent_page'] = 'request/completed';
    }

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url().$searchLink."?search=1&from_date=".$_POST['from_date']."&to_date=".$_POST['to_date']."");
    }

    $data['taskList'] = $getTaskNew['rows'];
    $data['taskCount'] = $getTaskNew['count'];
    $data['taskPageCount'] = $getTaskNew['pager_count'];
    $data['pagination'] = $getTaskNew['pagination'];

    print view("common/header",$data);
    print view("taskPages",$data);
    print view("common/footer",$data);
  }

  //Task in cancelled
  public function taskCancelled(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(!isset($_SESSION['roles'])){
     return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url()."/task/new?search=1&from_date=".$_POST['from_date']."&to_date=".$_POST['to_date']."");
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    //connect
    $common = new CommonController();

    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("YmdHis");
    $userUID = $_SESSION['uid'];

    $data = array();
    $data['result'] = "";
    $data['message'] = "";


    if($_SESSION['roles'] <= 2){
      $data['head_title'] = 'Task <small class="fnt-18">Cancelled</small>';
      $data['table_title'] = 'Cancelled Tasks';
      $data['table_link'] = "/task/cancelled";
      $searchLink = "/task/cancelled";
      $getTaskNew = $common->tblListTask('',4);
      $_SESSION['recent_page'] = 'task/cancelled';
    }
    if($_SESSION['roles'] == 3){
      $data['head_title'] = 'Task <small class="fnt-18">Cancelled</small>';
      $data['table_title'] = 'Cancelled Tasks';
      $data['table_link'] = "/task/cancelled";
      $searchLink = "/task/cancelled";
      $getTaskNew = $common->tblListTask($_SESSION['uid'],4);
      $_SESSION['recent_page'] = 'task/cancelled';
    }
    if($_SESSION['roles'] == 4){
      $data['head_title'] = 'Request <small class="fnt-18">Cancelled</small>';
      $data['table_title'] = 'Cancelled Requests';
      $data['table_link'] = "/request/cancelled";
      $searchLink = "/request/cancelled";
      $getTaskNew = $common->tblListTask($_SESSION['uid'],4);
      $_SESSION['recent_page'] = 'request/cancelled';
    }

    $data['taskList'] = $getTaskNew['rows'];
    $data['taskCount'] = $getTaskNew['count'];
    $data['taskPageCount'] = $getTaskNew['pager_count'];
    $data['pagination'] = $getTaskNew['pagination'];

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url().$searchLink."?search=1&from_date=".$_POST['from_date']."&to_date=".$_POST['to_date']."");
    }

    print view("common/header",$data);
    print view("taskPages",$data);
    print view("common/footer",$data);
  }

  //Task history
  public function taskHistory(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(!isset($_SESSION['roles'])){
     return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url()."/task/history?search=1&id=".$_POST['order_id']."&status=".$_POST['status']."");
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    //connect
    $common = new CommonController();

    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("YmdHis");
    $userUID = $_SESSION['uid'];

    $data = array();
    $data['result'] = "";
    $data['message'] = "";
    $data['order_id'] = "";

    $taskStatusSelectOption = $common->getSelectOption('','task_status');
    $getTaskNew = $common->tblListHistory();

     if(isset($_GET['order_id']) && $_GET['order_id'] != ''){
       $data['order_id'] = $_GET['order_id'];
     }

    $data['status_option'] = $taskStatusSelectOption;

    $data['taskList'] = $getTaskNew['rows'];
    $data['taskCount'] = $getTaskNew['count'];
    $data['taskPageCount'] = $getTaskNew['pager_count'];
    $data['pagination'] = $getTaskNew['pagination'];

    $data['history_equip_type'] = $getTaskNew['history_details']['equip_type'];
    $data['history_equip_name'] = $getTaskNew['history_details']['equip_name'];
    $data['history_serial_no'] = $getTaskNew['history_details']['serial_no'];
    $data['history_manufacturer'] = $getTaskNew['history_details']['manufacturer'];
    $data['history_created'] = $getTaskNew['history_details']['created'];
    $data['history_customer'] = $getTaskNew['history_details']['customer'];
    $data['history_created_by'] = $getTaskNew['history_details']['created_by'];
    $customer_id = $getTaskNew['history_details']['customer_id'];
    $equip_id = $getTaskNew['history_details']['equip_id'];
    $data['history_equip_link'] = base_url()."/customers/equipments/view?id=".$customer_id."&equipId=".$equip_id."";

    $_SESSION['recent_page'] = "/customers/equipments/view?id=".$customer_id."&equipId=".$equip_id."";

    print view("common/header",$data);
    print view("taskHistory",$data);
    print view("common/footer",$data);
  }

}
