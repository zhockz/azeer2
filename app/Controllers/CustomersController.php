<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StaffsModel;
use App\Models\EquipmentsModel;
use App\Models\AttachModel;
use App\Controllers\CommonController;
use CodeIgniter\Controller;

class CustomersController extends BaseController{

  //index
  public function index(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 3){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url()."/customers?search=1&name=".$_POST['name']."&status=".$_POST['status']."&city=".$_POST['city']."");
    }

    //vars
    $regionId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    //connect
    $common = new CommonController();

    //data
    $data['title'] = 'Azeer Online System | Customers';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];



    $getOptionRoles = $common->getSelectOption('',"user_roles");
    $getOptionStatus = $common->getSelectOption('',"user_status");
    $getOptionRegion = $common->getSelectOption('',"region");
    $getOptionCity = $common->getSelectOption('',"city");

    $data['option_roles'] = $getOptionRoles;
    $data['option_status'] = $getOptionStatus;
    $data['option_region'] = $getOptionRegion;
    $data['option_city'] = $getOptionCity;

    $getTblCustomer = $common->tblListCustomers();
    $data['userList'] = $getTblCustomer['rows'];
    $data['UserCount'] = $getTblCustomer['count'];
    $data['UserPageCount'] = $getTblCustomer['pager_count'];
    $data['pagination'] = $getTblCustomer['pagination'];

    //view
    print view("common/header",$data);
    print view("customersList",$data);
    print view("common/footer",$data);

  }

  //customer add
  public function customersAdd(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    //vars
    $regionId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    //connect
    $common = new CommonController();

    //post & get
    if(isset($_POST['addNewUser'])){
      $insertNewUser = $common->insertData("users",$_POST);
      if($insertNewUser == true){
        $data['result'] = "success";
        $data['message'] = "New customer has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new customer was failed. Possible user already exist. Please call support team...";
      }
    }

    //data
    $data['title'] = 'Azeer Online System | Add New Customer';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    $getOptionRoles = $common->getSelectOption('',"user_roles");
    $getOptionStatus = $common->getSelectOption('',"user_status");
    $getOptionRegion = $common->getSelectOption('',"region");
    $getOptionCity = $common->getSelectOption('',"city");

    $data['option_roles'] = $getOptionRoles;
    $data['option_status'] = $getOptionStatus;
    $data['option_region'] = $getOptionRegion;
    $data['option_city'] = $getOptionCity;

    //view
    print view("common/header",$data);
    print view("customersAdd",$data);
    print view("common/footer",$data);

  }

  //customer view
  public function customersView(){

    $session = session();
    helper(["form"]);

    //connect
    $userModel  = new UserModel();
    $common = new CommonController;

    //post & get
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 3){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(!isset($_GET['id'])){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['id']) && $_GET['id'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }else{
      $checkUserById = $userModel->getUserDataById($_GET['id']);
      if(!$checkUserById){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    //data
    $data = array();
    $data['title'] = "Azeer Online System | View Customer's Information";

    $userDetails = $userModel->getUserDataById($_GET['id']);

    $data['user'] = $userDetails;

    $getRoleName = $common->getTaxoName($userDetails['roles'],"user_roles");
    $getRegionName = $common->getTaxoName($userDetails['region'],"region");
    $getCityName = $common->getTaxoName($userDetails['city'],"city");
    $getStatusName = $common->getTaxoName($userDetails['status'],"user_status");

    $data['roles'] = $getRoleName;
    $data['region'] = $getRegionName;
    $data['city'] = $getCityName;
    $data['status'] = $getStatusName;

    $getTblUser = $common->tblListStaffs();
    $data['userList'] = $getTblUser['rows'];
    $data['UserCount'] = $getTblUser['count'];
    $data['UserPageCount'] = $getTblUser['pager_count'];
    $data['pagination'] = $getTblUser['pagination'];

    print view("common/header",$data);
    print view("customersView",$data);
    print view("common/footer",$data);

  }

  //customer edit
  public function customersEdit(){

    $session = session();
    helper(["form"]);

    //connect
    $userModel  = new UserModel();
    $common = new CommonController;

    //post & get
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(!isset($_GET['id'])){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['id']) && $_GET['id'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }else{
      $checkUserById = $userModel->getUserDataById($_GET['id']);
      if(!$checkUserById){
        return redirect()->to(base_url()."/unathorized");
      }
    }


    //data
    $data = array();
    $data['responce'] = array();
    $data['title'] = "Azeer Online System | Edit Customer's Information";

    //update profile form
    if(isset($_POST['updateProfile'])){

      $arrayPost = array(
        'uid' => $_GET['id'],
        'post' => $_POST
      );

      $arrayFiles = array(
        'uid' => $_GET['id'],
        'post' => $_FILES
      );

      $postNewUpdate = $userModel->updateUserProfile($arrayPost);
      if($postNewUpdate == true){

        //uploadImg
        $uploadProfilePix = $common->uploadImgSingle($arrayFiles);
        if(!empty($uploadProfilePix)){

          if($uploadProfilePix['status'] == true){

            $data['responce'][] = array(
              'result' => $uploadProfilePix['result'],
              'message' => $uploadProfilePix['message']
            );


          }else{

            $outputMsg = '';
            $outputMsg .= "Error on uploading your image";
            $outputMsg .= '<ul>';
            foreach($uploadProfilePix['message'] as $rowMessages){
              $outputMsg .= '<li>'.$rowMessages.'</li>';
            }
            $outputMsg .= '</ul>';

            $data['responce'][] = array(
              'result' => $uploadProfilePix['result'],
              'message' => $outputMsg
            );

          }

        }

        $data['responce'][] = array(
          'result' => "success",
          'message' => "You updated your profile details successfully"
        );
      }else{
        $data['responce'][] = array(
          'result' => "danger",
          'message' => "Your profile cannot be updated. Please call suppport team"
        );

      }


    }

    //update profile password
    if(isset($_POST['changePassword'])){

      $arrayPassword = array(
        'uid' => $_GET['id'],
        'password' => $_POST['password']
      );

      $postNewPassword = $userModel->updateUserPassword($arrayPassword);

      if($postNewPassword == true){
        $data['responce'][] = array(
          'result' => "success",
          'message' => "You updated your password successfully"
        );
      }else{
        $data['responce'][] = array(
          'result' => "danger",
          'message' => "Your password cannot be updated. Please call suppport team"
        );

      }

    }

    //data
    $userDetails = $userModel->getUserDataById($_GET['id']);
    $data['user'] = $userDetails;

    $getRoleName = $common->getTaxoName($userDetails['roles'],"user_roles");
    $getRegionName = $common->getTaxoName($userDetails['region'],"region");
    $getCityName = $common->getTaxoName($userDetails['city'],"city");
    $getStatusName = $common->getTaxoName($userDetails['status'],"user_status");

    $getOptionRoles = $common->getSelectOption($userDetails['roles'],"user_roles");
    $getOptionStatus = $common->getSelectOption($userDetails['status'],"user_status");
    $getOptionRegion = $common->getSelectOption($userDetails['region'],"region");
    $getOptionCity = $common->getSelectOption($userDetails['city'],"city");

    $data['roles'] = $getRoleName;
    $data['region'] = $getRegionName;
    $data['city'] = $getCityName;
    $data['status'] = $getStatusName;

    $data['option_roles'] = $getOptionRoles;
    $data['option_status'] = $getOptionStatus;
    $data['option_region'] = $getOptionRegion;
    $data['option_city'] = $getOptionCity;

    $getTblUser = $common->tblListStaffs();
    $data['userList'] = $getTblUser['rows'];
    $data['UserCount'] = $getTblUser['count'];
    $data['UserPageCount'] = $getTblUser['pager_count'];
    $data['pagination'] = $getTblUser['pagination'];

    //view
    print view("common/header",$data);
    print view("customersEdit",$data);
    print view("common/footer",$data);

  }

  //customer staff added
  public function customersStaffsAdd(){

    $session = session();
    helper(["form"]);

    //connect
    $userModel  = new UserModel();
    $common = new CommonController;

    //post & get
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(!isset($_GET['id'])){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['id']) && $_GET['id'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }else{
      $checkUserById = $userModel->getUserDataById($_GET['id']);
      if(!$checkUserById){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(isset($_POST['submitStaff'])){
      $addStaff = $common->insertData('staffs',$_POST);
      //print_r($addStaff);
    }

    //data
    $data = array();
    $data['responce'] = array();
    $data['title'] = "Azeer Online System | Customer's Staffs";

    $getTblUser = $common->tblListStaffs();
    $data['userList'] = $getTblUser['rows'];
    $data['UserCount'] = $getTblUser['count'];
    $data['UserPageCount'] = $getTblUser['pager_count'];
    $data['pagination'] = $getTblUser['pagination'];

    print view("common/header",$data);
    print view("customersStaffAdd",$data);
    print view("common/footer",$data);

  }

  //customer staff edit
  public function customersStaffsEdit(){

    $session = session();
    helper(["form"]);

    //connect
    $staffsModel  = new StaffsModel();
    $common = new CommonController;

    //post & get
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(!isset($_GET['id'])){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['id']) && $_GET['id'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['staff']) && $_GET['staff'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_POST['submitStaff'])){
      $addStaff = $common->updateData('staffs',$_POST);
    }

    //data
    $data = array();
    $data['responce'] = array();
    $data['title'] = "Azeer Online System | Customer's Staffs";

    $userDetails = $staffsModel->getStaffsDataById($_GET['staff']);
    $data['user'] = $userDetails;

    $getTblUser = $common->tblListStaffs();
    $data['userList'] = $getTblUser['rows'];
    $data['UserCount'] = $getTblUser['count'];
    $data['UserPageCount'] = $getTblUser['pager_count'];
    $data['pagination'] = $getTblUser['pagination'];

    print view("common/header",$data);
    print view("customersStaffsEdit",$data);
    print view("common/footer",$data);

  }

  //customer staff delete
  public function customersStaffsDelete(){

    $session = session();
    helper(["form"]);

    //connect
    $staffsModel  = new StaffsModel();
    $common = new CommonController;

    //post & get
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(!isset($_GET['id'])){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['id']) && $_GET['id'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['staff']) && $_GET['staff'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['staff']) && $_GET['staff'] != ""){

      $deleteStaff = $staffsModel->deleteStaffs($_GET['staff']);

      if($deleteStaff == true){
        //print_r($_SESSION);
        return redirect()->to($_SESSION['_ci_previous_url']);

      }
    }

  }

  //customer equipments
  public function customersEquip(){

    $session = session();
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 3){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    helper(["form"]);

    //vars
    $customersId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";
    $data['title'] = "Azeer Online System | View Customer's Equipments";

    //get
    if(isset($_GET['id']) && $_GET['id'] != ""){
      $customersId = $_GET['id'];
    }else{
      return redirect()->to(base_url()."/unathorized");
    }

    //connect
    $UserModel  = new UserModel();
    $common  = new CommonController();

    $getTblEquipments = $common->tblListEquipments($customersId);
    $data['equipmentList'] = $getTblEquipments['rows'];
    $data['equipmentCount'] = $getTblEquipments['count'];
    $data['equipmentPageCount'] = $getTblEquipments['pager_count'];
    $data['pagination'] = $getTblEquipments['pagination'];

    //view
    print view("common/header",$data);
    print view("customersEquipList",$data);
    print view("common/footer",$data);

  }

  //customer add equipments
  public function customersAddEquip(){

    $session = session();
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }


    helper(["form"]);

    //connect
    $UserModel  = new UserModel();
    $common  = new CommonController();

    //vars
    $customersId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";
    $data['title'] = "Azeer Online System | Add Customer's Equipments";

    //get
    if(isset($_GET['id']) && $_GET['id'] != ""){
      $customersId = $_GET['id'];
    }else{
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_POST['addEquip'])){

      $EquipmentsModel = new EquipmentsModel();
      $checkSerialNo = $EquipmentsModel->checkSerialNo($_POST['serial_no'],$_POST['equip_name']);

      if($checkSerialNo == true){
        $data['result'] = "danger";
        $data['message'] = "Adding equipment was failed. Serial No. already exist...";
      }else{
        $addEquipments = $common->insertData('equipments',$_POST);
        if($addEquipments == true){
          $data['result'] = "success";
          $data['message'] = "New equipment has been successfully added...";
        }else{
          $data['result'] = "danger";
          $data['message'] = "Adding equipment was failed. Possible user already exist. Please call support team...";
        }
      }


    }

    //data
    $getUser = $UserModel->getUserDataById($customersId);
    $getOptionEquipType = $common->getSelectOption('',"equip_type");
    $getOptionEquipStat = $common->getSelectOption('',"equip_status");
    $getOptionRegion = $common->getSelectOption('',"region");

    $data['user']['name'] = $getUser['name'];
    $data['option_equipType'] = $getOptionEquipType;
    $data['option_equipStat'] = $getOptionEquipStat;
    $data['option_region'] = $getOptionRegion;

    //view
    print view("common/header",$data);
    print view("customersEquipAdd",$data);
    print view("common/footer",$data);

  }

  //customer view equipment
  public function customersViewEquip(){

    $session = session();
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 3){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    $_SESSION['recent_page'] = 'customers/equipments/view?id='.$_GET['id'].'&equipId='.$_GET['equipId'].'';

    //vars
    $customersId = "";
    $data = array();
    $data['title'] = "Azeer Online System | View Customer's Equipments";

    //get
    if(isset($_GET['id']) && $_GET['id'] != ""){
      $customersId = $_GET['id'];
    }else{
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['equipId']) && $_GET['equipId'] != ""){
      $equipId = $_GET['equipId'];
    }else{
      return redirect()->to(base_url()."/unathorized");
    }

    //connect
    $UserModel  = new UserModel();
    $EquipmentsModel  = new EquipmentsModel();
    $common  = new CommonController();

    $getDetails = $EquipmentsModel->getEquipmentsSpecific($equipId);

    $customerName = $UserModel->getUserDataById($getDetails['uid']);

    $data['id'] = $getDetails['id'];
    $data['equip_type'] = $common->getTaxoName($getDetails['equip_type'],'equip_type');
    $data['equip_name'] = $common->getTaxoName($getDetails['equip_name'],'equip_name');
    $data['manufacturer'] = $getDetails['manufacturer'];
    $data['serial_no'] = $getDetails['serial_no'];
    $data['location'] = $getDetails['location'];
    $data['customer'] = $customerName['name'];
    $data['region'] = $common->getTaxoName($getDetails['region'],'region');
    $data['city'] = $common->getTaxoName($getDetails['city'],'city');
    $data['sc_no'] = $getDetails['sc_no'];
    $data['sc_start'] = $getDetails['sc_start'];
    $data['sc_end'] = $getDetails['sc_end'];
    $data['warranty'] = $getDetails['warranty'];
    $data['visit_1'] = $getDetails['visit_1'];
    $data['visit_2'] = $getDetails['visit_2'];
    $data['install_no'] = $getDetails['install_no'];
    $data['status'] = $common->getTaxoName($getDetails['status'],'equip_status');

    if(isset($_GET['equipId']) && $_GET['equipId'] != ''){
      $getTasks = $common->tblListTaskEquipments($_GET['equipId']);
      $data['taskList'] = $getTasks['rows'];
      $data['count'] = $getTasks['count'];
      $data['pager_count'] = $getTasks['pager_count'];
      $data['pagination'] = $getTasks['pagination'];
    }

    print view("common/header",$data);
    print view("customersEquipView",$data);
    print view("common/footer",$data);
  }

  //customer edit equipment
  public function customersEditEquip(){

    $session = session();
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(isset($_SESSION['recent_page'])){
      unset($_SESSION['recent_page']);
    }

    $_SESSION['recent_page'] = 'customers/equipments/edit?id='.$_GET['id'].'&equipId='.$_GET['equipId'].'';

    //vars
    $customersId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";
    $data['title'] = "Azeer Online System | Edit Customer's Equipments";

    //connect
    $UserModel  = new UserModel();
    $EquipmentsModel  = new EquipmentsModel();
    $common  = new CommonController();

    //get
    if(isset($_GET['id']) && $_GET['id'] != ""){
      $customersId = $_GET['id'];
    }else{
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['equipId']) && $_GET['equipId'] != ""){
      $equipId = $_GET['equipId'];
    }else{
      return redirect()->to(base_url()."/unathorized");
    }

    //post
    if(isset($_POST['editEquip'])){
      $updateData = $common->updateData('equipments',$_POST);
      if($updateData == true){
        $data['result'] = "success";
        $data['message'] = "Equipment has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Updating equipment was failed. Possible user already exist. Please call support team...";
      }
    }

    $getDetails = $EquipmentsModel->getEquipmentsSpecific($equipId);
    $customerName = $UserModel->getUserDataById($getDetails['uid']);

    $data['id'] = $getDetails['id'];
    $data['equip_type'] = $common->getTaxoName($getDetails['equip_type'],'equip_type');
    $data['equip_name'] = $common->getTaxoName($getDetails['equip_name'],'equip_name');
    $data['manufacturer'] = $getDetails['manufacturer'];
    $data['serial_no'] = $getDetails['serial_no'];
    $data['location'] = $getDetails['location'];
    $data['customer'] = $customerName['name'];
    $data['region'] = $common->getTaxoName($getDetails['region'],'region');
    $data['city'] = $common->getTaxoName($getDetails['city'],'city');
    $data['sc_no'] = $getDetails['sc_no'];
    $data['sc_start'] = $getDetails['sc_start'];
    $data['sc_end'] = $getDetails['sc_end'];
    $data['warranty'] = $getDetails['warranty'];
    $data['visit_1'] = $getDetails['visit_1'];
    $data['visit_2'] = $getDetails['visit_2'];
    $data['install_no'] = $getDetails['install_no'];
    $data['status'] = $common->getTaxoName($getDetails['status'],'equip_status');

    $getOptionEquipType = $common->getSelectOption($getDetails['equip_type'],"equip_type");
    $getOptionEquipName = $common->getSelectOption($getDetails['equip_name'],"equip_name");
    $getOptionEquipStat = $common->getSelectOption($getDetails['status'],"equip_status");
    $getOptionRegion = $common->getSelectOption($getDetails['region'],"region");
    $getOptionCity = $common->getSelectOption($getDetails['city'],"city");

    $data['user']['name'] = $customerName['name'];
    $data['option_equipType'] = $getOptionEquipType;
    $data['option_equipName'] = $getOptionEquipName;
    $data['option_equipStat'] = $getOptionEquipStat;
    $data['option_region'] = $getOptionRegion;
    $data['option_city'] = $getOptionCity;

    if(isset($_GET['equipId']) && $_GET['equipId'] != ''){
      $getTasks = $common->tblListTaskEquipments($_GET['equipId']);
      $data['taskList'] = $getTasks['rows'];
      $data['count'] = $getTasks['count'];
      $data['pager_count'] = $getTasks['pager_count'];
      $data['pagination'] = $getTasks['pagination'];
    }

    print view("common/header",$data);
    print view("customersEquipEdit",$data);
    print view("common/footer",$data);

  }

  //customer attachments
  public function customersAttach(){

    $session = session();
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 3){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    helper(["form"]);

    //connect
    $common  = new CommonController();

    //vars
    $customersId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";
    $data['title'] = "Azeer Online System | View Customer's Attachments";

    //get
    if(isset($_GET['id']) && $_GET['id'] != ""){
      $customersId = $_GET['id'];
    }else{
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_POST['fileUpload'])){
      $uploadMultipleFiles = $common->uploadMultipleFiles($customersId,$_FILES);
    }

    $tblListAttach = $common->tblListAttach();
    $data['attachList'] = $tblListAttach['rows'];
    $data['attachCount'] = $tblListAttach['count'];
    $data['attachPageCount'] = $tblListAttach['pager_count'];
    $data['pagination'] = $tblListAttach['pagination'];


    //views
    print view("common/header",$data);
    print view("customersAttach",$data);
    print view("common/footer",$data);
  }

  //customer delete attachements
  public function customersAttachDelete(){

    $session = session();
    helper(["form"]);

    //connect
    $AttachModel  = new AttachModel();
    //$common = new CommonController;

    //post & get
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(!isset($_GET['attachId'])){
      return redirect()->to(base_url()."/unathorized");
    }

    if(isset($_GET['attachId']) && $_GET['attachId'] == ""){
      return redirect()->to(base_url()."/unathorized");
    }


    if(isset($_GET['attachId']) && $_GET['attachId'] != ""){

      $deleteAttach = $AttachModel->deleteData($_GET['attachId']);

      if($deleteAttach == true){
        //print_r($_SESSION);
        return redirect()->to($_SESSION['_ci_previous_url']);

      }
    }

  }

  //customers all equipments list
  public function customersAllEquip(){

    $session = session();
    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 3){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    helper(["form"]);

    //vars
    $customersId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";
    $data['title'] = "Azeer Online System | View All Equipments";


    //connect
    $UserModel  = new UserModel();
    $common  = new CommonController();

    $getTblEquipments = $common->tblListEquipmentsAll();
    $data['equipmentList'] = $getTblEquipments['rows'];
    $data['equipmentCount'] = $getTblEquipments['count'];
    $data['equipmentPageCount'] = $getTblEquipments['pager_count'];
    $data['pagination'] = $getTblEquipments['pagination'];

    //view
    print view("common/header",$data);
    print view("customersEquipListAll",$data);
    print view("common/footer",$data);

  }
}
