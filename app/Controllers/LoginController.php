<?php namespace App\Controllers;

use App\Controllers\CommonController;
use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends BaseController{

	// index login
	public function index(){

		$session = session();

		if(isset($_SESSION['uid'])){
			return redirect()->to(base_url().'/dashboard');
		}

		helper(["form"]);

		$data = array();
		$data['message'] = array();
		$data['title'] = 'Azeer Online System';
		$data['login'] = '';
		$data['result'] = '';

		//login messages
		if(isset($_GET['action'])){

			if($_GET['action'] == "passwordchange"){

				if($_GET['status'] == "success"){

					$data['result'] = "success";
					$data['message'][] = "Password changed successfully...";
					$data['message'][] = "Please login in.";

				}else{

					$data['result'] = "danger";
					$data['message'][] = "Password change failed. Please call our support team.";

				}

			}

			if($_GET['action'] == "logout"){

				$data['result'] = "success";
				$data['message'][] = "You're been logged-out successfully...";

			}

		}

		$userModel = new UserModel();

		if(isset($_POST['loginSubmit'])){

			$loginUser = $userModel->loginUser($_POST);

			$data['result'] = $loginUser['result'];
			$data['message'] = $loginUser['message'];
			$data['login'] = $loginUser['login'];

			if($loginUser['login'] != false){

				//print_r($loginUser);
				//exit();

				$userSession = array(
					'uid' => $loginUser['login']['id'],
					'roles' => $loginUser['login']['roles'],
					'name' => $loginUser['login']['name'],
				);

				$session->set($userSession);

				return redirect()->to(base_url().'/dashboard');
			}

			//print_r($data);

		}


		/*
		$data['insert'] = array(
			'first_name' => 'Super',
			'middle_name' => 'SA',
			'last_name' => 'Administrator',
			'email' => 'zhockz@gmail.com',
			'mobile' => '543123123',
			'password' => md5('admin_003'),
			'password_reset' => '',
			'img_profile' => '',
			'job_title' => 'Super Administrator',
			'roles' => 1,
			'status' => 1,
			'hospital' => '',
			'created' => $dateNow,
			'created_uid' => 1,
			'updated' => $dateNow,
			'updated_uid' => 1,
		);

		$userModel = new LoginModel();
		$userModel->insertUser($data['insert']);
		*/

		print view("common/header",$data);
		print view("login",$data);
		print view("common/footer",$data);

	}

	//reset password
	public function resetPassword(){

		$session = session();

		helper(["form"]);

		if(isset($_SESSION['uid'])){
			return redirect()->to(base_url().'/dashboard');
		}

		$data = array();
		$data["title"] = "Azeer Online System | Reset Password";
		$data['login'] = '';

		$userNewResetPassword = new UserModel();

		//check code/id
		if(isset($_GET['id'])){

			$checkCode = $userNewResetPassword->resetPasswordIdCheck($_GET['id']);

			$data['result'] = $checkCode['result'];
			$data['message'] = $checkCode['message'];
			$data['login'] = $checkCode['login'];

		}

		//submit new password
		if(isset($_POST['submitNewPassword'])){

			$updateDetails = array(
				'action' => 1,
				'rp_hash' => $_GET['id'],
				'password' => $_POST['newPassword']
			);

			$changePassword = $userNewResetPassword->changePassword($updateDetails);

			if($changePassword == true){

				return redirect()->to(base_url().'?action=passwordchange&status=success');

			}else{

				return redirect()->to(base_url().'?action=passwordchange&status=error');

			}

		}

		//submit email
		if(isset($_POST['submit'])){

			$userResetPassword  = $userNewResetPassword->resetPassword($_POST);

			$data['result'] = $userResetPassword['result'];
			$data['message'] = $userResetPassword['message'];

		}

		print view("common/header",$data);
		print view("resetPassword",$data);
		print view("common/footer",$data);

	}


}
