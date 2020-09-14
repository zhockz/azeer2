<?php namespace App\Models;

use CodeIgniter\Model;

class StatusEquipModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'equip_status';
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

    $query = $this->orderBy('status','ASC')->findAll();

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
