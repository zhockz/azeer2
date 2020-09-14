<?php namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'user_roles';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'roles',
	];

  //get user roles by id
  public function getRoleName($id){

    $roleName = "";

    if($id != ""){
      $query = $this->where('id', $id)
        ->findAll();
      $roleName = $query[0]['roles'];
    }

    return $roleName;

  }

  //get all roles
  public function getRolesAll(){

    if(isset($_SESSION['roles']) && $_SESSION['roles'] > 1){
      $query = $this->where('id >', 2)
        ->findAll();
    }else{
      $query = $this->findAll();
    }

    $arrayList = array(
      'count' => count($query),
      'list' => $query
    );

    return $arrayList;

  }

}
