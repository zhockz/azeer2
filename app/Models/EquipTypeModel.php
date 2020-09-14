<?php namespace App\Models;

use CodeIgniter\Model;

class EquipTypeModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'equip_type';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'equip_type',
	];

  //get region name by id
  public function getEquipTypeName($id){

    //vars
    $equipName = "";

    //query
    if($id != ""){
      $query = $this->where('id', $id)
        ->findAll();
        if($query){
          $equipName = $query[0]['equip_type'];
        }else{
          $equipName = "";
        }

    }

    //return
    return $equipName;

  }

  //get all regions
  public function getEquipTypeAll(){

    $query = $this->orderBy('equip_type','ASC')->findAll();

    $arrayList = array(
      'count' => count($query),
      'list' => $query
    );

    return $arrayList;

  }

  //insert new region
  public function insertData($data){

    $query = $this->insert($data);

    if($query){
      return true;
    }else{
      return false;
    }
  }

  //update existing region
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
