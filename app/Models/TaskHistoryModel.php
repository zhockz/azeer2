<?php namespace App\Models;

use CodeIgniter\Model;

class TaskHistoryModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'task_history';
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

    $query = $this->insert($data);

    if($query){
      return true;
    }else{
      return false;
    }
  }

  //update existing task
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

  //get all task by task
  public function getTaskHistory($orderId){

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

    $queryCount = $this->where('order_id',$orderId)
      ->orderBy('updated','DESC')
      ->findAll();

    $query = $this->where('order_id',$orderId)
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

}
