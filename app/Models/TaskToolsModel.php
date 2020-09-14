<?php namespace App\Models;

use App\Models\TaskHistoryModel;
use CodeIgniter\Model;

class TaskToolsModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'task_tools';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'order_id',
      'name',
      'serial_tools',
      'calib_date',

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

  public function getTaskToolsAll($orderId){

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
