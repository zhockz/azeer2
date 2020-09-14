<?php namespace App\Models;

use App\Models\TaskHistoryModel;
use CodeIgniter\Model;

class TaskPartsModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'task_parts';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'order_id',
      'part_number',
      'description',
      'qty',

	];

  //insert new task
  public function insertData($data){

      $query = $this->insert($data);

      if($query){
        return true;
      }else{
        return false;
      }

  }

  public function getTaskPartsAll($orderId){

    $query = $this->where('order_id',$orderId)
      ->orderBy('id','DESC')
      ->findAll();

      $arrayList = array(
        'list' => $query,
      );

      return $arrayList;

  }

  public function delData($data){
    
    $query = $this->where('id',$data)
      ->delete();

      if($query){
        return true;
      }else{
        return false;
      }
  }

}
