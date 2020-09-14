<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\CommonController;
use CodeIgniter\Controller;

class SettingsController extends BaseController{

  //index
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

    $data = array();
    $data['title'] = 'Azeer Online System | Settings';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    print view("common/header",$data);
    print view("settings",$data);
    print view("common/footer",$data);

  }

  //unathorized
  public function unathorized(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    $data = array();
    $data['title'] = 'Azeer Online System | 401 Error';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    print view("common/header",$data);
    print view("unathorized",$data);
    print view("common/footer",$data);

  }

  //user list
  public function userList(){

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
      return redirect()->to(base_url()."/settings/users?search=1&name=".$_POST['name']."&roles=".$_POST['roles']."&status=".$_POST['status']."&city=".$_POST['city']."");
    }
    //vars
    $regionId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    //connect
    $common = new CommonController();

    //data
    $data['title'] = 'Azeer Online System | Settings - User';
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

    $getTblUser = $common->tblListUser();
    $data['userList'] = $getTblUser['rows'];
    $data['UserCount'] = $getTblUser['count'];
    $data['UserPageCount'] = $getTblUser['pager_count'];
    $data['pagination'] = $getTblUser['pagination'];

    //view
    print view("common/header",$data);
    print view("userList",$data);
    print view("common/footer",$data);

  }

  //user add
  public function userAdd(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    if(isset($_SESSION['roles'])){
      if($_SESSION['roles'] != 1){
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
        $data['message'] = "New user has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new user was failed. Possible user already exist. Please call support team...";
      }
    }

    //data
    $data['title'] = 'Azeer Online System | Settings - New Administrator';
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
    print view("userAdd",$data);
    print view("common/footer",$data);

  }

  //user view
  public function userView(){

    $session = session();
    helper(["form"]);

    //connect
    $userModel  = new UserModel();

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
    $data['title'] = 'Azeer Online System | View Administrator';

    $userDetails = $userModel->getUserDataById($_GET['id']);

    $data['user'] = $userDetails;

    $common = new CommonController;

    $getRoleName = $common->getTaxoName($userDetails['roles'],"user_roles");
    $getRegionName = $common->getTaxoName($userDetails['region'],"region");
    $getCityName = $common->getTaxoName($userDetails['city'],"city");
    $getStatusName = $common->getTaxoName($userDetails['status'],"user_status");

    $data['roles'] = $getRoleName;
    $data['region'] = $getRegionName;
    $data['city'] = $getCityName;
    $data['status'] = $getStatusName;

    print view("common/header",$data);
    print view("userView",$data);
    print view("common/footer",$data);

  }

  //user edit
	public function userEdit(){

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
		$data['title'] = 'Azeer Online System | Edit Administrator';

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

    //view
		print view("common/header",$data);
		print view("userEdit",$data);
		print view("common/footer",$data);

	}

  //location
  public function locations(){

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

    //get
    if(isset($_GET['regionId']) && $_GET['regionId'] != ""){
      $regionId = $_GET['regionId'];
    }

    //post
    if(isset($_POST['addRegion'])){
      $insertRegion = $common->insertData("region",$_POST);
      if($insertRegion == true){
        $data['result'] = "success";
        $data['message'] = "New region has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new region was failed...";
      }
    }

    if(isset($_POST['addCity'])){
      $insertCIty = $common->insertData("city",$_POST);
      if($insertCIty == true){
        $data['result'] = "success";
        $data['message'] = "New City has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new city was failed...";
      }

    }

    if(isset($_POST['editRegion'])){
      $updateRegion = $common->updateData("region",$_POST);
      if($updateRegion == true){
        $data['result'] = "success";
        $data['message'] = "Region has been successfully updated...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Updating region was failed...";
      }
    }

    if(isset($_POST['editCity'])){
      $updateCity = $common->updateData("city",$_POST);
      if($updateCity == true){
        $data['result'] = "success";
        $data['message'] = "City has been successfully updated...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Updating city was failed...";
      }
    }

    //data
    $data['title'] = 'Azeer Online System | Settings - Location';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    $getTblRegion = $common->tblListRegion();
    $getTblCity= $common->tblListCity($regionId);

    $getOptionRegion = $common->getSelectOption('',"region");

    $data['option_region'] = $getOptionRegion;

    $data['regionCount'] = $getTblRegion['count'];
    $data['regionList'] = $getTblRegion['rows'];

    $data['cityCount'] = $getTblCity['count'];
    $data['cityList'] = $getTblCity['rows'];
    $data['cityPageCount'] = $getTblCity['pager_count'];
    $data['pagination'] = $getTblCity['pagination'];

    //view
    print view("common/header",$data);
    print view("location",$data);
    print view("common/footer",$data);

  }

  //status
  public function status(){

    //session
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
    if(isset($_POST['addUserStatus'])){
      $insertUserStat = $common->insertData('user_status',$_POST);
      if($insertUserStat == true){
        $data['result'] = "success";
        $data['message'] = "New user status has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new status was failed...";
      }
    }

    if(isset($_POST['addTaskStatus'])){
      $insertTaskStat = $common->insertData('task_status',$_POST);
      if($insertTaskStat == true){
        $data['result'] = "success";
        $data['message'] = "New task status has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new task status was failed...";
      }
    }

    if(isset($_POST['addEquipmentStatus'])){
      $insertEquipStat = $common->insertData('equip_status',$_POST);
      if($insertEquipStat == true){
        $data['result'] = "success";
        $data['message'] = "New equipment status has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new equipment status was failed...";
      }
    }

    if(isset($_POST['addServiceStatus'])){
      $insertSCStat = $common->insertData('sc_type',$_POST);
      if($insertSCStat == true){
        $data['result'] = "success";
        $data['message'] = "New service type has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new service type was failed...";
      }
    }

    if(isset($_POST['editStatus'])){
      $updateCity = $common->updateData($_POST['type'],$_POST);
      if($updateCity == true){
        $data['result'] = "success";
        $data['message'] = "Status has been successfully updated...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Updating status was failed...";
      }
    }


    //data
    $data['title'] = 'Azeer Online System | Settings - Status';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    $getUserStatus = $common->tblListStatus('user_status');
    $data['userStatus'] = $getUserStatus['rows'];

    $getTaskStatus = $common->tblListStatus('task_status');
    $data['taskStatus'] = $getTaskStatus['rows'];

    $getEquipStatus = $common->tblListStatus('equip_status');
    $data['equipStatus'] = $getEquipStatus['rows'];

    $getSCStatus = $common->tblListStatus('sc_type');
    $data['scStatus'] = $getSCStatus['rows'];


    //view
    print view("common/header",$data);
    print view("status",$data);
    print view("common/footer",$data);

  }

  //equipment
  public function equipments(){

    //session
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
    $equipTypeId = "";
    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    //connect
    $common = new CommonController();

    //get
    if(isset($_GET['equipId']) && $_GET['equipId'] != ""){
      $equipTypeId = $_GET['equipId'];
    }

    //post
    if(isset($_POST['addEquipType'])){
      $insertEquipType = $common->insertData("equip_type",$_POST);
      if($insertEquipType == true){
        $data['result'] = "success";
        $data['message'] = "New equipment type has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new equipment type was failed...";
      }
    }

    if(isset($_POST['addEquipName'])){
      $insertEquipName = $common->insertData("equip_name",$_POST);
      if($insertEquipName == true){
        $data['result'] = "success";
        $data['message'] = "New equipment name has been successfully added...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Adding new equipment name was failed...";
      }

    }

    if(isset($_POST['editEquipType'])){
      $updateEquipType = $common->updateData("equip_type",$_POST);
      if($updateEquipType == true){
        $data['result'] = "success";
        $data['message'] = "Equipment type has been successfully updated...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Updating Equipment type was failed...";
      }
    }

    if(isset($_POST['editEquipName'])){
      $updateEquipName = $common->updateData("equip_name",$_POST);
      if($updateEquipName == true){
        $data['result'] = "success";
        $data['message'] = "City has been successfully updated...";
      }else{
        $data['result'] = "danger";
        $data['message'] = "Updating city was failed...";
      }
    }



    //data
    $data['title'] = 'Azeer Online System | Settings - Equipments';
    $data['roles'] = $_SESSION['roles'];
    $data['name'] = $_SESSION['name'];

    $tblListEquipType = $common->tblListEquipType();
    $getTblEquipName = $common->tblListEquipName($equipTypeId);

    $getOptionEquipType = $common->getSelectOption('',"equip_type");
    $data['option_equipType'] = $getOptionEquipType;

    $data['equipTypeCount'] = $tblListEquipType['count'];
    $data['equipTypeList'] = $tblListEquipType['rows'];

    $data['equipNameCount'] = $getTblEquipName['count'];
    $data['equipNameList'] = $getTblEquipName['rows'];
    $data['equipNamePageCount'] = $getTblEquipName['pager_count'];
    $data['pagination'] = $getTblEquipName['pagination'];


    //view
    print view("common/header",$data);
    print view("equipments",$data);
    print view("common/footer",$data);
  }


}
