<?php namespace App\Models;

use CodeIgniter\Model;

class RegionModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'region';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'region',
	];

  //get region name by id
  public function getRegionName($id){

    //vars
    $regionName = "";

    //query
    if($id != ""){
      $query = $this->where('id', $id)
        ->findAll();
        if($query){
          $regionName = $query[0]['region'];
        }else{
          $regionName = "";
        }

    }

    //return
    return $regionName;

  }

  //get all regions
  public function getRegionAll(){

    $query = $this->orderBy('region','ASC')->findAll();

    $arrayList = array(
      'count' => count($query),
      'list' => $query
    );

    return $arrayList;

  }

  //insert new region
  public function insertDataRegion($data){

    $query = $this->insert($data);

    if($query){
      return true;
    }else{
      return false;
    }
  }

  //update existing region
  public function updateDataRegion($id,$data){

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
