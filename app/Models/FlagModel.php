<?php namespace App\Models;

use App\Models\FlagModel;
use CodeIgniter\Model;

class FlagModel extends Model{

	protected $DBGroup = 'default';
	protected $table = 'user_flag';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
			'uid',
			'type',
			'rp_hash',
			'rp_expiration',
			'created',

	];

	/*
	login flags
	- 1.Last Login
	- 2.Request to Reset Password
	- 3.Reset Password
	- 4.Login Attempt
	*/

	//insert user flag
	public function flagUser($data){

		$dateNow = date("Y-m-d");

		$query = $this->insert($data);

		if($query){

			if($data['type'] == 4){

				$query2 = $this->where('uid', $data['uid'])
					->where('type', $data['type'])
					->like('created', $dateNow)
					->findAll();

				return count($query2);
			}

			if($data['type'] == 2){
				$query2 = $this->where('uid', $data['uid'])
					->where('type', $data['type'])
					->where('rp_expiration !=', 1)
					->orderBy('created', 'DESC')
					->findAll();

				return $query2;
			}

			if($data['type'] == 1){
				return true;
			}

		}

	}

	//check user's flag hash for email authentication
	public function flagUserCheckHash($data){

		$dateNow = date("Y-m-d H:i:s");

		$query = $this->where('rp_hash', $data['rp_hash'])
			->where('rp_expiration', $data['rp_expiration'])
			->findAll();

		if($query){

			$this->set('rp_expiration', 1)
				->where('rp_hash', $data['rp_hash'])
				->where('rp_expiration', $data['rp_expiration']);
			$hashUpdate = $this->update();

			return true;

		}else{

			return false;

		}

	}

	//authenticate hash
	public function getUserIdHashed($data){

		$query = $this->where('rp_hash', $data['rp_hash'])
			->where('rp_expiration', $data['rp_expiration'])
			->findAll();

		return $query;

	}
}
