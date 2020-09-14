<?php namespace App\Controllers;

use App\Controllers\CommonController;
use App\Models\UserModel;
use CodeIgniter\Controller;

class ProfileController extends BaseController{

	//index
	public function index(){

		$session = session();

		if(!isset($_SESSION['uid'])){
			return redirect()->to(base_url());
		}

		helper(["form"]);

		$data = array();
		$data['title'] = 'Azeer Online System | Profile';
		$data['cus_name'] = '';

		$userModel= new UserModel();
		$userDetails = $userModel->getUserDataById($_SESSION['uid']);

		$data['user'] = $userDetails;

    $common = new CommonController;

		if(isset($userDetails['hospital']) && $userDetails['hospital'] != ''){
			/*
			$getCustomer = $userModel->getUserDataById($userDetails['hospital']);
			$data['cus_name'] = $getCustomer['name'];
			*/
			$data['cus_name'] = $userDetails['hospital'];
		}

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
		print view("profile",$data);
		print view("common/footer",$data);

	}

	//edit profile
	public function editProfile(){

		$session = session();

		if(!isset($_SESSION['uid'])){
			return redirect()->to(base_url());
		}

		helper(["form"]);

		//view form
		$data = array();
		$data['responce'] = array();
		$data['title'] = 'Azeer Online System | Edit Profile';
		$data['cus_name'] = '';

		$userModel = new UserModel();
		$common = new CommonController;

		//update profile form
		if(isset($_POST['updateProfile'])){

			$arrayPost = array(
				'uid' => $_SESSION['uid'],
				'post' => $_POST
			);

			$arrayFiles = array(
				'uid' => $_SESSION['uid'],
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
				'uid' => $_SESSION['uid'],
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


		$userDetails = $userModel->getUserDataById($_SESSION['uid']);
		$data['user'] = $userDetails;

		if(isset($userDetails['hospital']) && $userDetails['hospital'] != ''){
			/*
			$getCustomer = $userModel->getUserDataById($userDetails['hospital']);
			$data['cus_name'] = $getCustomer['name'];
			*/
			$data['cus_name'] = $userDetails['hospital'];
		}

		$getRoleName = $common->getTaxoName($userDetails['roles'],"user_roles");
		$getRegionName = $common->getTaxoName($userDetails['region'],"region");
		$getCityName = $common->getTaxoName($userDetails['city'],"city");
		$getStatusName = $common->getTaxoName($userDetails['status'],"user_status");

		$getOptionStatus = $common->getSelectOption($userDetails['status'],"user_status");
		$getOptionRegion = $common->getSelectOption($userDetails['region'],"region");
		$getOptionCity = $common->getSelectOption($userDetails['city'],"city");

		$data['roles'] = $getRoleName;
		$data['region'] = $getRegionName;
		$data['city'] = $getCityName;
		$data['status'] = $getStatusName;

		$getTblUser = $common->tblListStaffs();
		$data['userList'] = $getTblUser['rows'];
		$data['UserCount'] = $getTblUser['count'];
		$data['UserPageCount'] = $getTblUser['pager_count'];
		$data['pagination'] = $getTblUser['pagination'];

		$data['option_status'] = $getOptionStatus;
		$data['option_region'] = $getOptionRegion;
		$data['option_city'] = $getOptionCity;


		print view("common/header",$data);
		print view("profileEdit",$data);
		print view("common/footer",$data);

	}

}
