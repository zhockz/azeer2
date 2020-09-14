<?php namespace App\Models;

use CodeIgniter\Model;

class StatusTaskModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'task_status';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'status',
	];

  //get user status by ids
  public function getStatusName($id){

    $statusName = "";

    if($id != ""){
      $query = $this->where('id', $id)
        ->findAll();
      $statusName = $query[0]['status'];
    }

    return $statusName;

  }

  //get all user status
  public function getStatusAll(){

    if($_SESSION['roles'] <= 2){
      $query = $this->orderBy('status','ASC')->findAll();
    }

    if($_SESSION['roles'] == 3){
      $query = $this->orderBy('status','ASC')->findAll();
    }

    if($_SESSION['roles'] == 4){
      $query = $this->where('id !=', 5)
        ->orderBy('status','ASC')
        ->findAll();
    }

    $arrayList = array(
      'count' => count($query),
      'list' => $query
    );

    return $arrayList;

  }

  //insert new data
  public function insertData($data){

    $query = $this->insert($data);

    if($query){
      return true;
    }else{
      return false;
    }
  }

  //update existing data
  public function updateData($id,$data){

    $query = $this->set($data)
      ->where('id',$id)
      ->update();

    if($query){
      return true;
    }else{
        return false;
    }
  }



}
