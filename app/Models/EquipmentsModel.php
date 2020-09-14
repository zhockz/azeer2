<?php namespace App\Models;

use CodeIgniter\Model;
use App\Controllers\CommonController;

class EquipmentsModel extends Model{

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

  //get region name by id
  public function getEquipmentsName($id){

    //vars
    $equipName = "";

    //query
    if($id != ""){
      $query = $this->where('id', $id)
        ->findAll();
        if($query){
          $equipName = $query[0]['name'];
        }else{
          $equipName = "";
        }

    }

    //return
    return $equipName;

  }

  //get region name by id
  public function getEquipmentsSpecific($id){

    $query = $this->where('id', $id)
      ->findAll();

    //return
    return $query[0];

  }

  //get all equipments
  public function getEquipmentsAll($uid){

    //pagination 1 --------------------->
    if (isset($_GET['page'])) {
      $pageno = $_GET['page'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 10;
    $offset = ($pageno-1) * $no_of_records_per_page;
    //pagination end 1 --------------------->

    $queryCount = $this->where('uid',$uid)
      ->orderBy('created','ASC')->findAll();

    $query = $this->where('uid',$uid)
      ->orderBy('created','ASC')
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
                  <a class='page-link'href='?id=".$_GET['id']."&page=".$i."'>".$i."</a>
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

    return $arrayList;

  }

  //get all equipments
  public function getEquipmentsAllList($hospitalId){

    //pagination 1 --------------------->
    if (isset($_GET['page'])) {
      $pageno = $_GET['page'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 20;
    $offset = ($pageno-1) * $no_of_records_per_page;
    //pagination end 1 --------------------->

    if($_SESSION['roles'] <= 2){

      $queryCount = $this->orderBy('created','ASC')->findAll();
      $query = $this->orderBy('created','ASC')
        ->findAll($no_of_records_per_page,$offset);

    }
    if($_SESSION['roles'] == 3){

      $queryCount = $this->orderBy('created','ASC')->findAll();
      $query = $this->orderBy('created','ASC')
        ->findAll($no_of_records_per_page,$offset);

      /*
      $queryCount = $this->where('uid',$hospitalId)
        ->orderBy('created','ASC')->findAll();
      $query = $this->where('uid',$hospitalId)
        ->orderBy('created','ASC')
        ->findAll($no_of_records_per_page,$offset);
      */
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

    return $arrayList;

  }

  //get all equipments notif
  public function getNotifEquipments($column,$hospitalId){

    $dateNow = date('Y-m-d');

    if($_SESSION['roles'] <= 2){
      $query = $this->where($column." >=", $dateNow)
        ->findColumn($column);
    }

    if($_SESSION['roles'] == 3){

      $query = $this->where($column." >=", $dateNow)
        ->findColumn($column);
      /*
      $query = $this->where('uid',$hospitalId)
        ->where($column." >=", $dateNow)
        ->findColumn($column);
      */
    }


    return $query;

  }

  //get all equipments for request
  public function getEquipOptionType($uid){

    $query = $this->where('uid',$uid)
      ->distinct()
      ->orderBy('equip_type','ASC')
      ->findColumn('equip_type');

    //output
    return $query;

  }

  public function getAjaxRequestEquipType($uid){

    $common = new CommonController();

    $query = $this->where('uid',$uid)
      ->distinct()
      ->orderBy('equip_type','ASC')
      ->findColumn('equip_type');

    $arrayList = array();
    foreach($query as $row){
      $arrayList[] = array(
        'id' => $row,
        'equip_type' => $common->getTaxoName($row,'equip_type')
      );
    }

    //output
    return $arrayList;

  }

  public function getAjaxRequestEquipName($uid,$parentId){

    $common = new CommonController();

    $query = $this->where('uid',$uid)
      ->where('equip_type',$parentId)
      ->distinct()
      ->orderBy('equip_name','ASC')
      ->findColumn('equip_name');

    $arrayList = array();
    foreach($query as $row){
      $arrayList[] = array(
        'id' => $row,
        'equip_name' => $common->getTaxoName($row,'equip_name')
      );
    }

    //output
    return $arrayList;

  }

  public function getAjaxRequestSerialNo($uid,$parentId){

    $query = $this->where('uid',$uid)
      ->where('equip_name',$parentId)
      ->orderBy('serial_no','ASC')
      ->findAll();

    //output
    return $query;
  }

  //insert new equipments
  public function insertData($data){

    $query = $this->insert($data);

    if($query){
      return true;
    }else{
      return false;
    }
  }

  //update existing equipments
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

  //check serial no.
  public function checkSerialNo($serialNo,$equipName){
    if($serialNo == ''){
      return false;
    }else{
      $query = $this->where('serial_no', $serialNo)
        ->where('equip_name',$equipName)
        ->findAll();

        if($query){
          return true;
        }else{
          return false;
        }
    }
  }

}
