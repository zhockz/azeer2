<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TaskModel;
use App\Controllers\CommonController;
use CodeIgniter\Controller;

class EngineersController extends BaseController{

  //engineers index
  public function index(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] > 2){
        return redirect()->to(base_url()."/unathorized");
      }
    }

    if(isset($_POST['submitSearch'])){
      return redirect()->to(base_url()."/engineers?search=1&name=".$_POST['name']."&status=".$_POST['status']."&city=".$_POST['city']."");
    }

    //vars
    $regionId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    //connect
    $common = new CommonController();

    $data['title'] = 'Azeer Online System | Engineers';
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

    $getTblCustomer = $common->tblListEngineers();
    $data['userList'] = $getTblCustomer['rows'];
    $data['UserCount'] = $getTblCustomer['count'];
    $data['UserPageCount'] = $getTblCustomer['pager_count'];
    $data['pagination'] = $getTblCustomer['pagination'];

    //view
    print view("common/header",$data);
    print view("engineersList",$data);
    print view("common/footer",$data);

  }

  //engineers add
  public function engineersAdd(){

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
    $data['title'] = 'Azeer Online System | Add New Engineer';
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
    print view("engineersAdd",$data);
    print view("common/footer",$data);

  }

  //engineers view
  public function engineersView(){

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
    $data['title'] = "Azeer Online System | View Engineer's Information";
    $data['cus_name'] = '';

    $taskStatus = '';
    if(isset($_GET['task']) && $_GET['task'] != ''){
      $taskStatus = $_GET['task'];
    }

    $userDetails = $userModel->getUserDataById($_GET['id']);
    $getTasks = $common->tblListTaskEngineers($_GET['id'],$taskStatus);

    $data['user'] = $userDetails;

    $getRoleName = $common->getTaxoName($userDetails['roles'],"user_roles");
    $getRegionName = $common->getTaxoName($userDetails['region'],"region");
    $getCityName = $common->getTaxoName($userDetails['city'],"city");
    $getStatusName = $common->getTaxoName($userDetails['status'],"user_status");

    if(isset($userDetails['hospital']) && $userDetails['hospital'] != ''){
      /*
			$getCustomer = $userModel->getUserDataById($userDetails['hospital']);
			$data['cus_name'] = $getCustomer['name'];
			*/
			$data['cus_name'] = $userDetails['hospital'];
    }

    $data['roles'] = $getRoleName;
    $data['region'] = $getRegionName;
    $data['city'] = $getCityName;
    $data['status'] = $getStatusName;

    $data['taskList'] = $getTasks['rows'];
    $data['count'] = $getTasks['count'];
    $data['pager_count'] = $getTasks['pager_count'];
    $data['pagination'] = $getTasks['pagination'];

    print view("common/header",$data);
    print view("engineersView",$data);
    print view("common/footer",$data);

  }

  //customer edit
  public function engineersEdit(){

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
    $data['title'] = "Azeer Online System | Edit Engineer's Information";

    $taskStatus = '';
    if(isset($_GET['task']) && $_GET['task'] != ''){
      $taskStatus = $_GET['task'];
    }

    $getTasks = $common->tblListTaskEngineers($_GET['id'],$taskStatus);

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

    /*$getCus = $common->getSelectOption($userDetails['hospital'],'users_cus');
      $data['cusSelect'] = $getCus;
    */

    $data['cusSelect'] = $userDetails['hospital'];


    $data['roles'] = $getRoleName;
    $data['region'] = $getRegionName;
    $data['city'] = $getCityName;
    $data['status'] = $getStatusName;

    $data['option_roles'] = $getOptionRoles;
    $data['option_status'] = $getOptionStatus;
    $data['option_region'] = $getOptionRegion;
    $data['option_city'] = $getOptionCity;

    $data['taskList'] = $getTasks['rows'];
    $data['count'] = $getTasks['count'];
    $data['pager_count'] = $getTasks['pager_count'];
    $data['pagination'] = $getTasks['pagination'];

    //view
    print view("common/header",$data);
    print view("engineersEdit",$data);
    print view("common/footer",$data);

  }


}
