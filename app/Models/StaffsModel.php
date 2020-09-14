<?php namespace App\Models;

//use App\Controllers\EmailController;
use CodeIgniter\Model;

class StaffsModel extends Model{

	protected $DBGroup = 'default';
	protected $table = 'staffs';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
			'id',
      'uid',
			'name',
			'email',
      'mobile',
			'job_title',
			'created',
			'created_uid',
			'updated',
			'updated_uid',
	];

  //insert new staff
  public function insertStaff($data){

    //query
    $query = $this->insert($data);

    //return
    if($query){
      return true;
    }else{
      return false;
    }

  }

  //update staff
  public function updateDataStaffs($id,$data){

    //query
    $query = $this->set($data)
      ->where('id',$id)
      ->update();

    //return
    if($query){
      return true;
    }else{
      return false;
    }
  }

  //delete staff
  public function deleteStaffs($id){

    $query = $this->delete($id);

    if($query){
      return true;
    }else{
      return false;
    }
  }

  //get staff by id
  public function getStaffsDataById($id){

		$query = $this->where('id', $id)
			->findAll();

		return $query[0];

	}

  //get all staff
  public function getStaffsAll($uid){

    $userRoles = $_SESSION['roles'];

    //pagination 1 --------------------->
    if (isset($_GET['page'])) {
      $pageno = $_GET['page'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 5;
    $offset = ($pageno-1) * $no_of_records_per_page;
    //pagination end 1 --------------------->

    //query
    $queryCount = $this->where('uid',$uid)
      ->orderBy('name','ASC')
      ->findAll();

    $query = $this->where('uid',$uid)
      ->orderBy('name','ASC')
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
