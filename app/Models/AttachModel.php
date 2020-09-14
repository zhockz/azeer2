<?php namespace App\Models;

use CodeIgniter\Model;

class AttachModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'attachments';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'uid',
      'old_name',
      'new_name',
      'new_name',
      'type',
      'status',
      'created',
      'created_uid',
      'updated',
      'updated_uid'
	];

  /*
    types
    1 = images
    2 = pdf
    3 = ms docs
    4 = uknown
  */

  //get all cities
  public function getAttachmentAll($id){

    //pagination 1 --------------------->
		if (isset($_GET['page'])) {
			$pageno = $_GET['page'];
		} else {
				$pageno = 1;
		}
		$no_of_records_per_page = 10;
		$offset = ($pageno-1) * $no_of_records_per_page;
		//pagination end 1 --------------------->

    $queryCount = $this->where('uid',$id)
      ->where('status', 1)
      ->orderBy('id','ASC')->findAll();

      $query = $this->where('uid',$id)
        ->where('status', 1)
        ->orderBy('id','ASC')
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
      'pagination' => $pagination
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

  public function deleteData($id){

    $query = $this->set('status', 0)
      ->where('id',$id)
      ->update();

    if($query){
      return true;
    }else{
      return false;
    }

  }

}
