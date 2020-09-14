<?php namespace App\Models;

use App\Controllers\EmailController;
use CodeIgniter\Model;


class UserModel extends Model{

	protected $DBGroup = 'default';
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
			'id',
			'name',
			'email',
			'emp_id',
			'mobile',
			'telephone',
			'fax',
			'address',
			'po_box',
			'region',
			'city',
			'zipcode',
			'website',
			'password',
			'password_reset',
			'img_profile',
			'job_title',
			'roles',
			'status',
			'hospital',
			'last_login',
			'created',
			'created_uid',
			'updated',
			'updated_uid',
	];

	//login & reset password -------->

	//login index
	//index
	public function loginUser($data){

		//$session = session();

		$dateNow = date("Y-m-d H:i:s");
		$username = $data['username'];
		$password = $data['password'];
		$responce = '';
		$msg = array();

		//validate input if empty
		if(empty($username) || empty($password)){

			if(empty($username)){
				$msg[] = "Username field cannot be empty...";
				$responce = "danger";
				$loginResponce = false;
			}

			if(empty($password)){
				$msg[] = "Password field cannot be empty...";
				$responce = "danger";
				$loginResponce = false;
			}
		}else{

			//check user if exists
			$checkUserExist = $this->checkUserExist($username);

			if($checkUserExist){

				$inputArray = array(
					'email' => $username,
					'password' => md5($password)
				);

				//user validation
				$validateUser = $this->loginValidation($inputArray);

				if($validateUser){

					//check user status
					if($validateUser[0]['status'] == 6){

						$msg[] = "Your account has been blocked...";
						$msg[] = "Please contact our support to resolve the issue";
						$responce = "danger";
						$loginResponce = false;

					}else{

						//authenticated user
						$userLastLogin = $this->userLastLogin($validateUser);

						$msg[] = "Your account has been authenticated...";
						$msg[] = "Loading... Please wait.";
						$responce = "success";
						$loginResponce = $validateUser[0];

						//print_r($validateUser);
						//exit();

						//usleep(5000000);


					}

				}else{

					//flag attemps
					$flagThisUser = array(
						'uid' => $checkUserExist[0]['id'],
						'type' => 4,
						'created' => $dateNow
					);

					$attemp = 5;

					$userFlagAttemp = new FlagModel();
					$flagUser = $userFlagAttemp->flagUser($flagThisUser);

					$tries = $attemp - $flagUser;

					if($tries <= 0){

						$blockUser = $this->blockUser($username);

						//block user
						$msg[] = "Password Incorrect...";
						$msg[] = "Your account has been blocked due to exceeded attemps.";
						$msg[] = "Please contact our support to resolve the issue";
						$responce = "danger";
						$loginResponce = false;

					}else{

						//send warning to user
						$msg[] = "Password Incorrect...";
						$msg[] = "You only have ".$tries." more attemps.";
						$responce = "danger";
						$loginResponce = false;

					}
				}

			}else{

				//user doesnt exist
				$msg[] = "User doesn't exist...";
				$responce = "danger";
				$loginResponce = false;

			}

		}

		$result = array(
			'result' => $responce,
			'message' => $msg,
			'login' => $loginResponce
		);

		return $result;

	}

	//insert new user
	public function insertUser($data){

		//query
		$query = $this->insert($data);

		//return
		if($query){
			return true;
		}else{
			return false;
		}

	}

	//check user exist by email
	public function checkUserExist($email){

		$query = $this->where('email', $email)
			->findAll();

		return $query;

	}

	//login validation
	public function loginValidation($data){

		$query = $this->where('email', $data['email'])
			->where('password', $data['password'])
			->findAll();

		return($query);

	}

	//blocking user
	public function blockUser($email){

		$this->set('status',6);
		$this->where('email',$email);
		$this->update();

	}

	//user last login
	public function userLastLogin($data){

		$dateNow = date("Y-m-d H:i:s");

		$this->set('last_login',$dateNow);
		$this->set('updated',$dateNow);
		$this->set('updated_uid',$data[0]['id']);
		$this->where('id',$data[0]['id']);
		$queryUser = $this->update();

		if($queryUser){

			$flagThisUser = array(
				'uid' => $data[0]['id'],
				'type' => 1,
				'created' => $dateNow
			);

			$userFlagLastLogin = new FlagModel();
			$flagUser = $userFlagLastLogin->flagUser($flagThisUser);

			return true;

		}else{

			return false;
		}

	}

	//reset password index
	public function resetPassword($data){

		$dateNow = date("Y-m-d H:i:s");
		$email = $data['email'];

		//check user if exists
		$checkUserExist = $this->checkUserExist($email);

		if($checkUserExist){

			//update user tbl
			$this->set('password_reset',1);
			$this->set('updated',$dateNow);
			$this->set('updated_uid',$checkUserExist[0]['id']);
			$this->where('id',$checkUserExist[0]['id']);
			$query1 = $this->update();

			if($query1){

					//flag request to reset password
					$flagThisUser = array(
						'uid' => $checkUserExist[0]['id'],
						'type' => 2,
						'rp_hash' => md5($checkUserExist[0]['id'].$dateNow),
						'created' => $dateNow
					);

					$userFlagResetPassword = new FlagModel();
					$flagUser = $userFlagResetPassword->flagUser($flagThisUser);

					if($flagUser){

						/*
						$link = '<a href="'.base_url().'/reset-password?id='.$flagUser[0]['rp_hash'].'" target="_new">
							'.base_url().'/reset-password?id='.$flagUser[0]['rp_hash'].'
						</a>';
						*/

						$link = base_url().'/reset-password?id='.$flagUser[0]['rp_hash'];

						$emailMessage = '

						<p>Please click the button or copy this link ( '.$link.' ) to reset your password.</p>

						<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td> <a href="'.$link.'" target="_blank">Reset Password</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>

						';

						$mailContent = array(
							'email' => $email,
							'subject' => "Password Reset",
							'message' => $emailMessage
						);

						$sendEmailControl = new EmailController();
						$sendEmail = $sendEmailControl->sendEmail($mailContent);

					}

			}

			//user exist
			$msg[] = "A one (1) time link has been sent to your email for authentication...";
			$msg[] = "Please check your email.";
			//$msg[] = $emailMessage;
			$responce = "success";

		}else{

			//user doesnt exist
			$msg[] = "User doesn't exist...";
			$responce = "danger";

		}


		$result = array(
			'result' => $responce,
			'message' => $msg
		);

		return $result;


	}

	//check user id for password reset
	public function resetPasswordIdCheck($id){

		if($id == ''){

			$msg[] = "This page to reset your password are already expired or the ID cannot be found...";
			$responce = "danger";
			$resetPasswordResponce = false;

		}else{

			//flag check rp hash
			$flagThisUser = array(
				'rp_hash' => $id,
				'rp_expiration' => 0
			);

			$userFlagResetPassword = new FlagModel();
			$flagUser = $userFlagResetPassword->flagUserCheckHash($flagThisUser);

			$msg = array();

			if($flagUser == true){

				$msg[] = "Please change your password";
				$responce = "success";
				$resetPasswordResponce = true;

			}else{

				$msg[] = "This page to reset your password are already expired or the ID cannot be found...";
				$responce = "danger";
				$resetPasswordResponce = false;

			}
		}

		$result = array(
			'result' => $responce,
			'message' => $msg,
			'login' => $resetPasswordResponce
		);

		return $result;

	}

	//change password
	public function changePassword($data){

		/*
			action:
				- 1 = reset password page
				- 2 = change password from profile page
		*/

		$dateNow = date("Y-m-d H:i:s");

		if($data['action'] == "1"){

			$flagThisUser = array(
				'rp_hash' => $data['rp_hash'],
				'rp_expiration' => 1
			);

			$userFlagid = new FlagModel();
			$flagUser = $userFlagid->getUserIdHashed($flagThisUser);

			$uid = $flagUser[0]['uid'];
			$password = $data['password'];

			$this->set('password',md5($password));
			$this->set('password_reset',0);
			$this->set('updated',$dateNow);
			$this->set('updated_uid',$uid);
			$this->where('id',$uid);
			$queryUser = $this->update();

			if($queryUser){

				return true;

			}else{

				return false;

			}

		}

	}

	//profile -------->
	//get user by id for profile

	//get user by ID
	public function getUserDataById($id){

		$query = $this->where('id', $id)
			->findAll();

		if($query){
			return $query[0];
		}else{
			return false;
		}


	}

	//updating user's profile
	public function updateUserProfile($data){

		//vars
		$dateNow = date("Y-m-d H:i:s");

		/*
		if(isset($_GET['id']) && $_GET['id'] != ""){
			$updateUid = $_GET['id'];
		}else{
			$updateUid = $data['uid'];
		}
		*/

		//data
		$arrayList = array();

		if(isset($data['post']['name']) && $data['post']['name'] != ""){
			$arrayList['name'] = $data['post']['name'];
		}
		if(isset($data['post']['email']) && $data['post']['email'] != ""){
			$arrayList['email'] = $data['post']['email'];
		}
		if(isset($data['post']['address']) && $data['post']['address'] != ""){
			$arrayList['address'] = $data['post']['address'];
		}
		if(isset($data['post']['region']) && $data['post']['region'] != ""){
			$arrayList['region'] = $data['post']['region'];
		}
		if(isset($data['post']['city']) && $data['post']['city'] != ""){
			$arrayList['city'] = $data['post']['city'];
		}
		if(isset($data['post']['zipcode']) && $data['post']['zipcode'] != ""){
			$arrayList['zipcode'] = $data['post']['zipcode'];
		}
		if(isset($data['post']['job_title']) && $data['post']['job_title'] != ""){
			$arrayList['job_title'] = $data['post']['job_title'];
		}
		if(isset($data['post']['mobile']) && $data['post']['mobile'] != ""){
			$arrayList['mobile'] = $data['post']['mobile'];
		}
		if(isset($data['post']['status']) && $data['post']['status'] != ""){
			$arrayList['status'] = $data['post']['status'];
		}
		if(isset($data['post']['roles']) && $data['post']['roles'] != ""){
			$arrayList['roles'] = $data['post']['roles'];
		}
		if(isset($data['post']['telephone']) && $data['post']['telephone'] != ""){
			$arrayList['telephone'] = $data['post']['telephone'];
		}
		if(isset($data['post']['fax']) && $data['post']['fax'] != ""){
			$arrayList['fax'] = $data['post']['fax'];
		}
		if(isset($data['post']['po_box']) && $data['post']['po_box'] != ""){
			$arrayList['po_box'] = $data['post']['po_box'];
		}
		if(isset($data['post']['website']) && $data['post']['website'] != ""){
			$arrayList['website'] = $data['post']['website'];
		}
		if(isset($data['post']['emp_id']) && $data['post']['emp_id'] != ""){
			$arrayList['emp_id'] = $data['post']['emp_id'];
		}
		if(isset($data['post']['hospital']) && $data['post']['hospital'] != ""){
			$arrayList['hospital'] = $data['post']['hospital'];
		}


		$arrayList['updated'] = $dateNow;
		$arrayList['updated_uid'] = $_SESSION['uid'];


		//query
		$query = $this->set($arrayList)
			->where('id',$data['uid'])
			->update();

		//return
		if($query){
			return true;
		}else{
			return false;
		}

	}

	//update user's password
	public function updateUserPassword($data){

		$dateNow = date("Y-m-d H:i:s");

		$arrayList = array(
			'password' => md5($data['password']),
			'updated' => $dateNow,
			'updated_uid' => $data['uid'],
		);

		$query = $this->set($arrayList)
			->where('id',$data['uid'])
			->update();

		if($query){
			return true;
		}else{
			return false;
		}

	}

	//updating profile picture
	public function updateUserPix($uid,$filename){

		$dateNow = date("Y-m-d H:i:s");

		$arrayList = array(
			'img_profile' => $filename,
			'updated' => $dateNow,
			'updated_uid' => $uid,
		);

		$query = $this->set($arrayList)
			->where('id',$uid)
			->update();

			if($query){
				return true;
			}else{
				return false;
			}

	}

	//get all users
	public function getUsersAll(){

		$userRoles = $_SESSION['roles'];

		//pagination 1 --------------------->
		if (isset($_GET['page'])) {
			$pageno = $_GET['page'];
		} else {
				$pageno = 1;
		}
		$no_of_records_per_page = 20;
		$offset = ($pageno-1) * $no_of_records_per_page;
		//pagination end 1 --------------------->

		//query
		if($userRoles == 1){
			$queryCount = $this->orderBy('name','ASC')
				->findAll();

			$queryz = $this->orderBy('name','ASC');


			//search
			if(isset($_GET['name']) && $_GET['name'] != ''){
				$queryz->builder()->like('name',$_GET['name']);
			}
			if(isset($_GET['roles']) && $_GET['roles'] != ''){
				$queryz->where('roles',$_GET['roles']);
			}
			if(isset($_GET['status']) && $_GET['status'] != ''){
				$queryz->where('status',$_GET['status']);
			}
			if(isset($_GET['city']) && $_GET['city'] != ''){
				$queryz->where('city',$_GET['city']);
			}

			$query = $this->findAll($no_of_records_per_page,$offset);

		}

		if($userRoles == 2){
			$queryCount = $this->where('id !=', 1)
				->orderBy('name','ASC')
				->findAll();

			$query = $this->where('id !=', 1)
				->orderBy('name','ASC')
				->findAll($no_of_records_per_page,$offset);
		}

		if($userRoles > 2){
			$queryCount = $this->where('id >', 2)
				->orderBy('name','ASC')
				->findAll();

			$query = $this->where('id >', 2)
					->orderBy('name','ASC')
					->findAll($no_of_records_per_page,$offset);
		}

		//pagination 2 --------------------->
		$total_pages = ceil(count($queryCount) / $no_of_records_per_page);
		$pagination = "";
		if($no_of_records_per_page < count($queryCount)){
			$pagination .= '<nav aria-label="">';
			$pagination .= '<ul class="pagination justify-content-center"">';
			for ($i=1; $i<=$total_pages; $i++){
							$active = "";
							if(isset($_GET['page']) && $_GET['page'] != ""){
								if($i == $_GET['page']){
									$active = "active";
								}
							}
							 $pagination .= "
							 	<li class='page-item ".$active."'>
									<a class='page-link'href='?page=".$i."'>".$i."</a>
								</li>";
			 };
			$pagination .= '</ul>';
			$pagination .= '</nav>';
		}
		//pagination end 2 --------------------->

		//output
		$arrayList = array(
			'count' => count($queryCount),
			'pager_count' => count($query),
			'list' => $query,
			'pagination' => $pagination,
			'offset' => $offset + 1
		);

		//return
		return $arrayList;

	}

	//get specific roles
	public function getUserSpecific($roleId){

		$userRoles = $_SESSION['roles'];

		//pagination 1 --------------------->
		if (isset($_GET['page'])) {
			$pageno = $_GET['page'];
		} else {
				$pageno = 1;
		}
		$no_of_records_per_page = 20;
		$offset = ($pageno-1) * $no_of_records_per_page;
		//pagination end 1 --------------------->

		$queryCount = $this->where('roles',$roleId)
			->orderBy('name','ASC')
			->findAll();

		$queryz = $this->where('roles',$roleId);
		$queryz->orderBy('name','ASC');

		//search
		if(isset($_GET['name']) && $_GET['name'] != ''){
			$queryz->builder()->like('name',$_GET['name']);
		}
		if(isset($_GET['status']) && $_GET['status'] != ''){
			$queryz->where('status',$_GET['status']);
		}
		if(isset($_GET['city']) && $_GET['city'] != ''){
			$queryz->where('city',$_GET['city']);
		}

		$query = $queryz->findAll($no_of_records_per_page,$offset);

		//pagination 2 --------------------->
		$total_pages = ceil(count($queryCount) / $no_of_records_per_page);
		$pagination = "";
		if($no_of_records_per_page < count($queryCount)){
			$pagination .= '<nav aria-label="">';
			$pagination .= '<ul class="pagination justify-content-center"">';
			for ($i=1; $i<=$total_pages; $i++){
							$active = "";
							if(isset($_GET['page']) && $_GET['page'] != ""){
								if($i == $_GET['page']){
									$active = "active";
								}
							}
							 $pagination .= "
								<li class='page-item ".$active."'>
									<a class='page-link'href='?page=".$i."'>".$i."</a>
								</li>";
			 };
			$pagination .= '</ul>';
			$pagination .= '</nav>';
		}
		//pagination end 2 --------------------->

		//output
		$arrayList = array(
			'count' => count($queryCount),
			'pager_count' => 0,
			'list' => $query,
			'pagination' => $pagination,
			'offset' => $offset + 1
		);

		//return
		return $arrayList;

	}

	//get user engineer
	public function getUserEng(){

		$query = $this->where('roles', 3)
			->findAll();

			$arrayList = array(
				'list' => $query,
			);

		return $arrayList;

	}

	//get user customer
	public function getUserCus(){

		$query = $this->where('roles', 4)
			->findAll();

			$arrayList = array(
				'list' => $query,
			);

		return $arrayList;

	}

	//get engineer's customer
	public function getEngCustomers($custId){

		$userRoles = $_SESSION['roles'];

		//pagination 1 --------------------->
		if (isset($_GET['page'])) {
			$pageno = $_GET['page'];
		} else {
				$pageno = 1;
		}
		$no_of_records_per_page = 20;
		$offset = ($pageno-1) * $no_of_records_per_page;
		//pagination end 1 --------------------->

		$queryCount = $this->where('id',$custId)
			->findAll();

		$queryz = $this->where('id',$custId);
		$queryz->orderBy('name','ASC');

		//search
		if(isset($_GET['name']) && $_GET['name'] != ''){
			$queryz->builder()->like('name',$_GET['name']);
		}
		if(isset($_GET['status']) && $_GET['status'] != ''){
			$queryz->where('status',$_GET['status']);
		}
		if(isset($_GET['city']) && $_GET['city'] != ''){
			$queryz->where('city',$_GET['city']);
		}

		$query = $queryz->findAll($no_of_records_per_page,$offset);

		//pagination 2 --------------------->
		$total_pages = ceil(count($queryCount) / $no_of_records_per_page);
		$pagination = "";
		if($no_of_records_per_page < count($queryCount)){
			$pagination .= '<nav aria-label="">';
			$pagination .= '<ul class="pagination justify-content-center"">';
			for ($i=1; $i<=$total_pages; $i++){
							$active = "";
							if(isset($_GET['page']) && $_GET['page'] != ""){
								if($i == $_GET['page']){
									$active = "active";
								}
							}
							 $pagination .= "
								<li class='page-item ".$active."'>
									<a class='page-link'href='?page=".$i."'>".$i."</a>
								</li>";
			 };
			$pagination .= '</ul>';
			$pagination .= '</nav>';
		}
		//pagination end 2 --------------------->

		//output
		$arrayList = array(
			'count' => count($queryCount),
			'pager_count' => 0,
			'list' => $query,
			'pagination' => $pagination,
			'offset' => $offset + 1
		);

		//return
		return $arrayList;

	}


}
