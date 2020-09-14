<?php namespace App\Models;

use App\Models\TaskHistoryModel;
use CodeIgniter\Model;

class TaskModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'task';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'uid',
      'order_id',
      'order_date',
      'equipments',
      'issue',
      'eng_uid',
      'arrival_date',
      'arrival_time',
      'start_time',
      'end_time',
      'contractor',
      'contact_name',
      'sc_type',
      'img_before',
      'img_after',
      'assessment',
      'action',
      'spare_parts',
      'test_tools',
      'img_attach',
      'status',
      'created',
      'created_uid',
      'updated',
      'updated_uid',

	];

  //insert new task
  public function insertData($data){

    $validate = $this->validateData($data);

    if($validate == true){

      $query = $this->insert($data);

      if($query){
        $TaskHistoryModel = new TaskHistoryModel();
        $sendData = $TaskHistoryModel->insertData($data);
        return true;
      }else{
        return false;
      }

    }else{

      return false;

    }
  }

  //update existing task
  public function updateData($id,$data,$files){

    $dateNow = date("Y-m-d H:i:s");
    $userUID = $_SESSION['uid'];

    $query = $this->set($data)
      ->set('updated',$dateNow )
      ->set('updated_uid',$userUID)
      ->where('order_id',$id)
      ->update();

    if($query){

      $getOrderDetails = $this->getTaskByOrderId($id);
      $arrayListUpdate = array(
        'uid' => $getOrderDetails['uid'],
        'order_id' => $getOrderDetails['order_id'],
        'order_date' => $getOrderDetails['order_date'],
        'equipments' => $getOrderDetails['equipments'],
        'issue' => $getOrderDetails['issue'],
        'eng_uid' => $getOrderDetails['eng_uid'],
        'arrival_date' => $getOrderDetails['arrival_date'],
        'arrival_time' => $getOrderDetails['arrival_time'],
        'start_time' => $getOrderDetails['start_time'],
        'end_time' => $getOrderDetails['end_time'],
        'contractor' => $getOrderDetails['contractor'],
        'contact_name' => $getOrderDetails['contact_name'],
        'img_before' => $getOrderDetails['img_before'],
        'img_after' => $getOrderDetails['img_after'],
        'assessment' => $getOrderDetails['assessment'],
        'action' => $getOrderDetails['action'],
        'spare_parts' => $getOrderDetails['spare_parts'],
        'test_tools' => $getOrderDetails['test_tools'],
        'img_attach' => $getOrderDetails['img_attach'],
        'status' => $getOrderDetails['status'],
        'created' => $getOrderDetails['created'],
        'created_uid' => $getOrderDetails['created_uid'],
        'updated' => $getOrderDetails['updated'],
        'updated_uid' => $getOrderDetails['updated_uid']
      );

      $TaskHistoryModel = new TaskHistoryModel();
      $sendData = $TaskHistoryModel->insertData($arrayListUpdate);

      if($sendData){
        return true;
      }else{
        return true;
      }


    }else{
      return false;
    }
  }

  public function updateAttachments($orderId,$column,$name){

    $query = $this->set($column,$name)
      ->where('order_id',$orderId)
      ->update();


    if($query){
      return true;
    }else{
      return false;
    }

  }

  //validate task
  public function validateData($data){

    $query = $this->where('uid', $data['uid'])
      ->where('equipments', $data['equipments'])
      ->where('status !=', 5)
      ->where('status !=', 4)
      ->findAll();

      $count = count($query);

      if($count == 0){
        return true;
      }else{
        return false;
      }

  }

  //get all task by task
  public function getTaskAll($uid,$status){

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

    if($uid == ''){

      $queryCount = $this->where('status',$status)
        ->orderBy('updated','DESC')
        ->findAll();

      $queryz = $this->where('status',$status);

      //search query
      if(isset($_GET['from_date']) && isset($_GET['to_date'])){
        if($_GET['from_date'] != '' && $_GET['to_date'] != ''){

          $frDate = date("Y-m-d",strtotime($_GET['from_date']));
          $toDate = date("Y-m-d",strtotime($_GET['to_date'] . " +1 day"));

          $queryz->where("updated BETWEEN '$frDate' AND '$toDate'");
        }

      }

      $query = $queryz->orderBy('updated','DESC')
        ->findAll($no_of_records_per_page,$offset);


    }else{


      if($_SESSION['roles'] == 3){
        $whereId = 'eng_uid';
      }
      if($_SESSION['roles'] == 4){
        $whereId = 'uid';
      }

      $queryCount = $this->where($whereId,$uid)
        ->where('status',$status)
        ->orderBy('updated','ASC')
        ->findAll();

      $queryz = $this->where($whereId,$uid)
        ->where('status',$status);

      //search query
      if(isset($_GET['from_date']) && isset($_GET['to_date'])){
        if($_GET['from_date'] != '' && $_GET['to_date'] != ''){

          $frDate = date("Y-m-d",strtotime($_GET['from_date']));
          $toDate = date("Y-m-d",strtotime($_GET['to_date'] . " +1 day"));

          $queryz->where("updated BETWEEN '$frDate' AND '$toDate'");
        }

      }

      $query = $queryz->orderBy('updated','DESC')
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

  //get task by order id
  public function getTaskByOrderId($orderId){

    $query = $this->where('order_id',$orderId)
      ->findAll();

    return $query[0];
  }

  //get all task by task
  public function getTaskHistory(){

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

    $queryCount = $this->orderBy('updated','DESC')
      ->findAll();

    //search
    $queryz = $this;

		if(isset($_GET['id']) && $_GET['id'] != ''){
			$queryz->builder()->like('order_id',$_GET['id']);
		}
		if(isset($_GET['status']) && $_GET['status'] != ''){
			$queryz->where('status',$_GET['status']);
		}

    $query = $queryz->orderBy('updated','DESC')
      ->findAll($no_of_records_per_page,$offset);

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

  //get all task by task
  public function getTaskByEngineer($uid,$status){

    //pagination 1 --------------------->
    if (isset($_GET['page'])) {
      $pageno = $_GET['page'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    //pagination end 1 --------------------->

    $queryCountz = $this->where('eng_uid',$uid);

    if(isset($_GET['task']) && isset($_GET['task'])){
      $queryCountz->where('status',$_GET['task']);
    }

    $queryCount = $queryCountz->orderBy('updated','DESC')
      ->findAll();

    $queryz = $this;

    $taskId = '';
    if(isset($_GET['task']) && isset($_GET['task'])){
      $queryz->where('status',$_GET['task']);
      $taskId = "&task=".$_GET['task'];
    }

    $query = $queryz->where('eng_uid',$uid)
      ->orderBy('updated','DESC')
      ->findAll($no_of_records_per_page,$offset);

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
                  <a class='page-link'href='?id=".$_GET['id'].$taskId."&page=".$i."'>".$i."</a>
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

  //get all task by task
  public function getTaskByEquipment($equipId){

    //pagination 1 --------------------->
    if (isset($_GET['page'])) {
      $pageno = $_GET['page'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    //pagination end 1 --------------------->

    $queryCount = $this->where('equipments',$equipId)
      ->orderBy('updated','DESC')
      ->findAll();

    $query = $this->where('equipments',$equipId)
      ->orderBy('updated','DESC')
      ->findAll($no_of_records_per_page,$offset);

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
                  <a class='page-link'href='?id=".$_GET['id']."&equipId=".$_GET['equipId']."&page=".$i."'>".$i."</a>
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

  //get count task
  public function getTaskCount($uid){

    $query = $this->where('uid', $uid)
      ->findColumn('uid');

    if($query){
      return count($query);
    }else{
      return 0;
    }


  }
}
