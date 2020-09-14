<?php namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model{

  protected $DBGroup = 'default';
	protected $table = 'city';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $allowedFields = [
      'id',
			'region',
      'city',
	];

  //get city name by id
  public function getCityName($id){

    //vars
    $cityName = "";

    //query
    if($id != ""){
      $query = $this->where('id', $id)
        ->findAll();
        if($query){
          $cityName = $query[0]['city'];
        }else{
          $cityName = "";
        }
    }

    //return
    return $cityName;

  }

  //get all cities
  public function getCityAll($id){

    //pagination 1 --------------------->
		if (isset($_GET['page'])) {
			$pageno = $_GET['page'];
		} else {
				$pageno = 1;
		}
		$no_of_records_per_page = 10;
		$offset = ($pageno-1) * $no_of_records_per_page;
		//pagination end 1 --------------------->

    if($id != ""){
      $queryCount = $this->where('region',$id)
        ->orderBy('city','ASC')->findAll();

        $query = $this->where('region',$id)
          ->orderBy('city','ASC')
          ->findAll($no_of_records_per_page,$offset);

    }else{
      $queryCount = $this->orderBy('city','ASC')->findAll();

      $query = $this->orderBy('city','ASC')
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
      'pagination' => $pagination
    );

    return $arrayList;

  }

  //get all for select
  public function getAllSelect(){

    $query = $this->orderBy('city','ASC')
      ->findAll();

      $arrayList = array(
        'list' => $query
      );

      return $arrayList;
  }

  //get ajax
  public function getAjaxRequest($id){

    $query = $this->where('region',$id)
      ->orderBy('city','ASC')
      ->findAll();

      return $query;
  }

  //insert new city
  public function insertDataCity($data){

    $query = $this->insert($data);

    if($query){
      return true;
    }else{
      return false;
    }
  }

  //update existing city
  public function updateDataCity($id,$data){

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
