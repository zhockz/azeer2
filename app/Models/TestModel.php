<?php namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'equipments';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'uid',
      'equip_type',
      'equip_name',
      'manufacturer',
      'serial_no',
      'location',
      'region',
      'city',
      'sc_no',
      'sc_start',
      'sc_end',
      'warranty',
      'visit_1',
      'visit_2',
      'install_no',
      'status',
      'created',
      'created_uid',
      'updated',
      'updated_uid',
	];

  public function getDate($equipId){

    $query = $this
      ->where('id',$equipId)
      ->findAll();

    return $query[0];

  }




}
