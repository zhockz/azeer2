<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FlagModel;
use App\Models\StatusModel;
use App\Models\StatusTaskModel;
use App\Models\StatusEquipModel;
use App\Models\EquipStatusModel;
use App\Models\EquipmentsModel;
use App\Models\StatusSCModel;
use App\Models\RolesModel;
use App\Models\RegionModel;
use App\Models\CityModel;
use App\Models\StaffsModel;
use App\Models\EquipTypeModel;
use App\Models\EquipNameModel;
use App\Models\AttachModel;
use App\Models\TaskModel;
use App\Models\TaskHistoryModel;
use App\Models\TaskPartsModel;
use App\Models\TaskToolsModel;
use CodeIgniter\Controller;

class CommonController extends BaseController{

  //get taxonomy name
  public function getTaxoName($id,$tbl){

    $taxoname = "";

    //roles
    if($tbl == "user_roles"){
      $common = new RolesModel();
      $taxoName = $common->getRoleName($id);
    }

    //region
    if($tbl == "region"){
      $common = new RegionModel();
      $taxoName = $common->getRegionName($id);
    }

    //city
    if($tbl == "city"){
      $common = new CityModel();
      $taxoName = $common->getCityName($id);
    }

    //user status
    if($tbl == "user_status"){
      $common = new StatusModel();
      $taxoName = $common->getStatusName($id);
    }

    //equipment type
    if($tbl == "equip_type"){
      $common = new EquipTypeModel();
      $taxoName = $common->getEquipTypeName($id);
    }

    //equipment name
    if($tbl == "equip_name"){
      $common = new EquipNameModel();
      $taxoName = $common->getEquipName($id);
    }

    //equipment name
    if($tbl == "equip_status"){
      $common = new EquipStatusModel();
      $taxoName = $common->getEquipStatName($id);
    }

    //Task status
    if($tbl == "task_status"){
      $common = new StatusTaskModel();
      $taxoName = $common->getStatusName($id);
    }

    //Task status
    if($tbl == "sc_type"){
      $common = new StatusSCModel();
      $taxoName = $common->getStatusName($id);
    }



    //return
    return $taxoName;

  }

  //get select options
  public function getSelectOption($id,$tbl){

    //roles
    if($tbl == "user_roles"){
      $common = new RolesModel();
      $taxoArray = $common->getRolesAll();
      $taxoName = 'roles';
    }

    //status
    if($tbl == "user_status"){
      $common = new StatusModel();
      $taxoArray = $common->getStatusAll();
      $taxoName = 'status';
    }

    //region
    if($tbl == "region"){
      $common = new RegionModel();
      $taxoArray = $common->getRegionAll();
      $taxoName = 'region';
    }

    //city
    if($tbl == "city"){
      $common = new CityModel();
      $taxoArray = $common->getAllSelect();
      $taxoName = 'city';
    }

    //equipment type
    if($tbl == "equip_type"){
      $common = new EquipTypeModel();
      $taxoArray = $common->getEquipTypeAll();
      $taxoName = 'equip_type';
    }

    //equipment name
    if($tbl == "equip_name"){
      $common = new EquipNameModel();
      $taxoArray = $common->getAllSelect();
      $taxoName = 'equip_name';
    }

    //equipment status
    if($tbl == "equip_status"){
      $common = new EquipStatusModel();
      $taxoArray = $common->getEquipStatAll();
      $taxoName = 'status';
    }

    //engineers
    if($tbl == "users_eng"){
      $common = new UserModel();
      $taxoArray = $common->getUserEng();
      $taxoName = 'name';
    }

    //customers
    if($tbl == "users_cus"){
      $common = new UserModel();
      $taxoArray = $common->getUserCus();
      $taxoName = 'name';
    }

    //task status
    if($tbl == "task_status"){
      $common = new StatusTaskModel();
      $taxoArray = $common->getStatusAll();
      $taxoName = 'status';
    }

    //service type
    if($tbl == "sc_type"){
      $common = new StatusSCModel();
      $taxoArray = $common->getStatusAll();
      $taxoName = 'status';
    }

    //output
    $plsSelected = "";
    if($id == ""){
      $plsSelected = "selected";
    }
    $arrayList = array();
    $arrayList[] = '<option value="" '.$plsSelected.'>Please Select</option>';
    foreach($taxoArray['list'] as $row){

      $selected = "";
      if($id != "" && $id == $row['id']){
        $selected = "selected";
      }

      $arrayList[] = '<option value="'.$row['id'].'" '.$selected.'>'.$row[$taxoName].'</option>';
    }

    //print_r($arrayList);
    //return
    return implode("",$arrayList);

  }

  //get select options equipments
  public function getSelectOptionEquipments($column){

    $uid = '';
    if(isset($_GET['id']) && $_GET['id'] != ''){
      $uid = $_GET['id'];
    }else{
      $uid = $_SESSION['uid'];
    }

    $equipArray = '';

    //connect
    $common = new EquipmentsModel();

    //equipment type
    if($column == "equip_type"){
       $equipArray = $common->getEquipOptionType($uid);
    }

    $arrayList = array();
    $arrayList[] = '<option value="" selected>Please Select</option>';
    foreach($equipArray as $row){

      $arrayList[] = '<option value="'.$row.'">'.$this->getTaxoName($row,$column).'</option>';
    }

    //return $arrayList;
    return implode("",$arrayList);

  }

  //upload single image
  public function uploadImgSingle($data){

    //$uploadFolder = $_SERVER['DOCUMENT_ROOT']."/azeer/public/assets/imgs/uploads/profile/";
    //$uploadFolder = "/home/mohamme7/public_html/azeer/public/assets/imgs/uploads/profile/";
    $uploadFolder = "/home/corvtz2m4stm/public_html/public/assets/imgs/uploads/profile/";

    $errors = array();
    $success = "";
    $responce = array();

    if($data['post']['img']['size'] != 0){

      $file_name = $data['post']['img']['name'];
      $file_size = $data['post']['img']['size'];
      $file_tmp = $data['post']['img']['tmp_name'];
      $file_type = $data['post']['img']['type'];
      $filenamesExt = pathinfo($data['post']['img']['name']);
      $file_ext = $filenamesExt['extension'];
      $newName = 'azeerUser-00'.$data['uid'].'.'.$file_ext;

      $extensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$extensions) === false){
         $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152) {
         $errors[] = 'Image size must be less than 2MB';
      }

      if(empty($errors) == true) {

        $userModel = new UserModel();
        $updateImg = $userModel->updateUserPix($data['uid'],$newName);

        if($updateImg == true){
          $temp = $uploadFolder.$newName;
  				$tmp = $file_tmp;
  				move_uploaded_file($tmp,$temp);
  				$temp ='';
  				$tmp ='';
          $success = 'Profile Image has been successfully changed';
        }

         $responce = array(
           'status' => true,
           'result' => "success",
           'message' => $success,
         );

      }else{

         $responce = array(
           'status' => false,
           'result' => "danger",
           'message' => $errors,
         );
      }

    }

    return $responce;

  }

  //upload multiple size
  public function uploadMultipleFiles($uid,$data){

    //$uploadFolder = $_SERVER['DOCUMENT_ROOT']."/azeer/public/assets/imgs/uploads/attachment/";
    //$uploadFolder = "/home/mohamme7/public_html/azeer/public/assets/imgs/uploads/attachment/";
    $uploadFolder = "/home/corvtz2m4stm/public_html/public/assets/imgs/uploads/attachment/";

    $dateNow = date("Y-m-d H:i:s");
    $userUID = $_SESSION['uid'];

    $errors = array();
    $success = "";
    $responce = array();
    $extensions= array("jpeg","jpg","png","pdf","doc","docx","xls","xlsx","ppt","pptx");
    $countfiles = count($data['upload']['name']);
    $dateName = date("YmdHis");

    $AttachModel = new AttachModel();

    for($i=0;$i<$countfiles;$i++){

      $file_name = $data['upload']['name'][$i];
      $file_size = $data['upload']['size'][$i];
      $file_tmp =  $data['upload']['tmp_name'][$i];
      $file_type =  $data['upload']['type'][$i];
      $filenamesExt = pathinfo($data['upload']['name'][$i]);
      $file_ext = $filenamesExt['extension'];
      $newName = 'azeerAttach-00'.$uid.$dateName.[$i][0].'.'.$file_ext;

      if(in_array($file_ext,$extensions) === false){

         $errors[] = "One of the files are not allowed, please choose a image, pdf or document files.";
         $responce[] = array(
           'status' => false,
           'result' => "danger",
           'message' => $errors,
         );

      }else{

        $arrayListUpload = array(
          'uid' => $uid,
          'old_name' => $file_name,
          'new_name' => $newName,
          'type' => $file_ext,
          'created' => $dateNow,
          'created_uid' => $userUID,
          'updated' => $dateNow,
          'updated_uid' => $userUID,
        );

        $uploadAll = $AttachModel->insertData($arrayListUpload);

        if($uploadAll == true){
          $temp = $uploadFolder.$newName;
          $tmp = $file_tmp;
          move_uploaded_file($tmp,$temp);
          $temp ='';
          $tmp ='';
          $success = 'File has been successfully Added...';
        }

        $responce[] = array(
          'status' => true,
          'result' => "success",
          'message' => $success,
        );

      }

    }

    return $responce;
  }

  //upload single image
  public function uploadImgRepair($order_id,$type,$data){

    //$uploadFolder = $_SERVER['DOCUMENT_ROOT']."/azeer/public/assets/imgs/uploads/attachment/";
    //$uploadFolder = "/home/mohamme7/public_html/azeer/public/assets/imgs/uploads/attachment/";
    $uploadFolder = "/home/corvtz2m4stm/public_html/public/assets/imgs/uploads/attachment/";

    $errors = array();
    $success = "";
    $responce = array();

    if($data['size'] != 0){

      $file_name = $data['name'];
      $file_size = $data['size'];
      $file_tmp = $data['tmp_name'];
      $file_type = $data['type'];
      $filenamesExt = pathinfo($data['name']);
      $file_ext = $filenamesExt['extension'];
      $newName = $order_id.'-'.$type.'.'.$file_ext;

      $extensions= array("jpeg","jpg","png","doc","docx","pdf");

      if(in_array($file_ext,$extensions) === false){
         $errors[] = "Extension not allowed, please choose a JPEG, PNG, DOC or PDF file.";
      }


      if(empty($errors) == true) {

        $TaskModel = new TaskModel();
        $updateImg = $TaskModel->updateAttachments($order_id,$type,$newName);

        if($updateImg == true){
          $temp = $uploadFolder.$newName;
          $tmp = $file_tmp;
          move_uploaded_file($tmp,$temp);
          $temp ='';
          $tmp ='';
          $success = 'Profile Image has been successfully changed';
        }

         $responce = array(
           'status' => true,
           'result' => "success",
           'message' => $success,
         );

      }else{

         $responce = array(
           'status' => false,
           'result' => "danger",
           'message' => $errors,
         );
      }

    }

    return $responce;

  }

  //get list of region
  public function tblListRegion(){

    $regionModel = new RegionModel();
    $getTblRegion = $regionModel->getRegionAll();

    $arrayList = array();
    $tblList = array();

    $arrayList['count'] = $getTblRegion['count'];

    foreach($getTblRegion['list'] as $row){

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$row['id'].'</td>
          <td class="align-middle">'.$row['region'].'</td>
          <td>
            <center>
            <span>
              <button class="btn-editRegion btn btn-success btn-sm" rel="tooltip"  data-id="'.$row['id'].'" data-name="'.$row['region'].'" data-placement="bottom" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
            </span>
            <span>
              <a href="'.base_url().'/settings/locations?regionId='.$row['id'].'" class="btn btn-info btn-sm" rel="tooltip"  data-placement="bottom" title="Filter City">
                <i class="fas fa-filter"></i>
              </a>
            </span>
            </center>
          </td>
        </tr>
        ';

    }

    $arrayList['rows'] = implode('', $tblList);

    //return
    return $arrayList;

  }

  //get list of city
  public function tblListCity($regionId){

    $regionModel = new CityModel();
    $getTblCity = $regionModel->getCityAll($regionId);

    $arrayList = array();
    $tblList = array();

    foreach($getTblCity['list'] as $row){

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$row['id'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['region'],'region').'</td>
          <td class="align-middle">'.$row['city'].'</td>
          <td>
            <center>
            <span>
              <button class="btn-editCity btn btn-success btn-sm" rel="tooltip"  data-id="'.$row['id'].'" data-name="'.$row['city'].'" data-regionId="'.$row['region'].'" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
            </span>
            </center>
          </td>
        </tr>
        ';

    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['count'] = $getTblCity['count'];
    $arrayList['pager_count'] = $getTblCity['pager_count'];
    $arrayList['pagination'] = $getTblCity['pagination'];

    //return
    return $arrayList;

  }

  //get list of status
  public function tblListStatus($tbl){

    if($tbl == "user_status"){
        $statusModel = new StatusModel();
    }

    if($tbl == "task_status"){
        $statusModel = new StatusTaskModel();
    }

    if($tbl == "equip_status"){
        $statusModel = new StatusEquipModel();
    }

    if($tbl == "sc_type"){
        $statusModel = new StatusSCModel();
    }

    $getTblStatus = $statusModel->getStatusAll();

    $arrayList = array();
    $tblList = array();

    if($getTblStatus){

      foreach($getTblStatus['list'] as $row){
        $tblList[] = '
          <tr>
            <td class="align-middle">'.$row['id'].'</td>
            <td class="align-middle">'.$row['status'].'</td>
            <td>
              <center>
              <span>
                <button class="btn-editStatus btn btn-success btn-sm" rel="tooltip"  data-id="'.$row['id'].'" data-name="'.$row['status'].'" data-type="'.$tbl.'" data-placement="bottom" title="Edit">
                  <i class="fas fa-edit"></i>
                </button>
              </span>
              </center>
            </td>
          </tr>
          ';
      }

      $returArray = implode('', $tblList);

    }else{
      $returArray = '
        <div class="alert alert-warning">
          No Data yet...
        </div>
      ';
    }



    $arrayList['rows'] = $returArray;

    //return
    return $arrayList;

  }

  //get list of users
  public function tblListUser(){

    $userModel = new UserModel();
    $getTblUsers = $userModel->getUsersAll();

    $arrayList = array();
    $tblList = array();

    $arrayList['count'] = $getTblUsers['count'];
    $i = 1;
    foreach($getTblUsers['list'] as $row){

      if($row['roles'] == 1 || $row['roles'] == 2){
        $linkAction = "settings/users/admin";
      }
      if($row['roles'] == 3){
        $linkAction = "engineers";
      }
      if($row['roles'] == 4){
        $linkAction = "customers";
      }

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['id'].'</td>
          <td class="align-middle">'.$row['name'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['roles'],"user_roles").'</td>
          <td class="align-middle">'.$row['email'].'</td>
          <td class="align-middle">'.$row['mobile'].'</td>
          <td class="align-middle">'.$row['telephone'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['status'],"user_status").'</td>
          <td class="align-middle text-center">'.$row['created'].'</td>
          <td class="align-middle text-center">'.$row['last_login'].'</td>
          <td>
            <center>
            <span>
              <a href="'.base_url().'/'.$linkAction.'/view?id='.$row['id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                <i class="far fa-eye"></i>
              </a>
            </span>
            <span>
              <a href="'.base_url().'/'.$linkAction.'/edit?id='.$row['id'].'" class="btn btn-success btn-sm" rel="tooltip"  data-placement="bottom" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
            </span>
            </center>
          </td>
        </tr>
        ';


    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['pager_count'] = $getTblUsers['pager_count'];
    $arrayList['pagination'] = $getTblUsers['pagination'];

    //return
    return $arrayList;

  }

  //get list of customers
  public function tblListCustomers(){
    $userModel = new UserModel();

    if($_SESSION['roles'] <= 2){
      $getTblUsers = $userModel->getUserSpecific(4);
    }

    if($_SESSION['roles'] == 3){

      $getTblUsers = $userModel->getUserSpecific(4);
      /*
      $getEngDetails = $userModel->getUserDataById($_SESSION['uid']);
      $getTblUsers = $userModel->getEngCustomers($getEngDetails['hospital']);
      */
    }


    $arrayList = array();
    $tblList = array();

    $arrayList['count'] = $getTblUsers['count'];
    $i = 1;
    foreach($getTblUsers['list'] as $row){

      $editCus = '';
      if($_SESSION['roles'] <= 2){
        $editCus = '
          <span>
            <a href="'.base_url().'/customers/edit?id='.$row['id'].'" class="btn btn-success btn-sm" rel="tooltip"  data-placement="bottom" title="Edit">
              <i class="fas fa-edit"></i>
            </a>
          </span>';
      }

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['id'].'</td>
          <td class="align-middle">'.$row['name'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['region'],"region").'</td>
          <td class="align-middle">'.$this->getTaxoName($row['city'],"city").'</td>
          <td class="align-middle">'.$row['telephone'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['status'],"user_status").'</td>
          <td class="align-middle text-center">'.$row['created'].'</td>
          <td class="align-middle text-center">'.$row['last_login'].'</td>
          <td>
            <center>
            <span>
              <a href="'.base_url().'/customers/view?id='.$row['id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                <i class="far fa-eye"></i>
              </a>
            </span>
            '.$editCus.'
            </center>
          </td>
        </tr>
        ';


    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['pager_count'] = $getTblUsers['pager_count'];
    $arrayList['pagination'] = $getTblUsers['pagination'];

    //return
    return $arrayList;
  }

  //get list of staffs
  public function tblListStaffs(){
    $staffsModel = new StaffsModel();

    if(isset($_GET['id']) && $_GET['id'] != ""){
      $userID = $_GET['id'];
    }else{
      $userID = $_SESSION['uid'];
    }

    $getTblUsers = $staffsModel->getStaffsAll($userID);

    $arrayList = array();
    $tblList = array();

    $arrayList['count'] = $getTblUsers['count'];
    $i = 1;
    foreach($getTblUsers['list'] as $row){

      $delButton = '';
      if(!isset($_GET['staff'])){
        $delButton = '
          <span>
            <a href="'.base_url().'/customers/staffs/delete?id='.$userID.'&staff='.$row['id'].'" class="btn btn-danger btn-sm" rel="tooltip"  data-placement="bottom" title="Edit">
              <i class="fas fa-trash-alt"></i>
            </a>
          </span>
        ';
      }

      $actions = '';
      if(isset($_SESSION['roles']) && $_SESSION['roles'] <= 2){
        $actions = '
          <td>
            <center>
            <span>
              <a href="'.base_url().'/customers/staffs/edit?id='.$_GET['id'].'&staff='.$row['id'].'" class="btn btn-success btn-sm" rel="tooltip"  data-placement="bottom" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
            </span>
            '.$delButton.'
            </center>
          </td>
        ';
      }

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['name'].'</td>
          <td class="align-middle">'.$row['email'].'</td>
          <td class="align-middle">'.$row['mobile'].'</td>
          <td class="align-middle">'.$row['job_title'].'</td>
          '.$actions.'
        </tr>
        ';


    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['pager_count'] = $getTblUsers['pager_count'];
    $arrayList['pagination'] = $getTblUsers['pagination'];

    //return
    return $arrayList;
  }

  //get list of engineers
  public function tblListEngineers(){
    $userModel = new UserModel();
    $getTblUsers = $userModel->getUserSpecific(3);

    $arrayList = array();
    $tblList = array();

    $arrayList['count'] = $getTblUsers['count'];
    $i = 1;
    foreach($getTblUsers['list'] as $row){

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['id'].'</td>
          <td class="align-middle">'.$row['emp_id'].'</td>
          <td class="align-middle">'.$row['name'].'</td>
          <td class="align-middle">'.$row['email'].'</td>
          <td class="align-middle">'.$row['mobile'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['region'],"region").'</td>
          <td class="align-middle">'.$this->getTaxoName($row['city'],"city").'</td>
          <td class="align-middle">'.$this->getTaxoName($row['status'],"user_status").'</td>
          <td class="align-middle text-center">'.$row['created'].'</td>
          <td class="align-middle text-center">'.$row['last_login'].'</td>
          <td>
            <center>
            <span>
              <a href="'.base_url().'/engineers/view?id='.$row['id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                <i class="far fa-eye"></i>
              </a>
            </span>
            <span>
              <a href="'.base_url().'/engineers/edit?id='.$row['id'].'" class="btn btn-success btn-sm" rel="tooltip"  data-placement="bottom" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
            </span>
            </center>
          </td>
        </tr>
        ';


    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['pager_count'] = $getTblUsers['pager_count'];
    $arrayList['pagination'] = $getTblUsers['pagination'];

    //return
    return $arrayList;
  }

  //get list of equipment type
  public function tblListEquipType(){

    $EquipTypeModel = new EquipTypeModel();
    $getTblTypeModel= $EquipTypeModel->getEquipTypeAll();

    $arrayList = array();
    $tblList = array();

    $arrayList['count'] = $getTblTypeModel['count'];

    foreach($getTblTypeModel['list'] as $row){

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$row['id'].'</td>
          <td class="align-middle">'.$row['equip_type'].'</td>
          <td>
            <center>
            <span>
              <button class="btn-editEquipType btn btn-success btn-sm" rel="tooltip"  data-id="'.$row['id'].'" data-name="'.$row['equip_type'].'" data-placement="bottom" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
            </span>
            <span>
              <a href="'.base_url().'/settings/equipments?equipId='.$row['id'].'" class="btn btn-info btn-sm" rel="tooltip"  data-placement="bottom" title="Filter City">
                <i class="fas fa-filter"></i>
              </a>
            </span>
            </center>
          </td>
        </tr>
        ';

    }

    $arrayList['rows'] = implode('', $tblList);

    //return
    return $arrayList;

  }

  //get list of attachements
  public function tblListAttach(){

    $AttachModel = new AttachModel();

    if(isset($_GET['id']) && $_GET['id'] != ""){
      $userID = $_GET['id'];
    }else{
      $userID = $_SESSION['uid'];
    }

    $getTblAttach = $AttachModel->getAttachmentAll($userID);

    $arrayList = array();
    $tblList = array();

    $extMs= array("docx","xls","xlsx","ppt","pptx");
    $extPdf= array("pdf");
    $extImg= array("jpeg","jpg","png");

    $arrayList['count'] = $getTblAttach['count'];
    $i = 1;
    foreach($getTblAttach['list'] as $row){

      $viewAction = "";
      $delButton = "";

      if(in_array($row['type'],$extMs) === true){

        $viewAction = '
        <span>
          <a href="'.base_url().'/assets/imgs/uploads/attachment/'.$row['new_name'].'" class="btn btn-info btn-sm" rel="tooltip"  data-placement="bottom" title="Download" download>
            <i class="fas fa-download"></i>
          </a>
        </span>';

      }

      if(in_array($row['type'],$extImg) === true){

        $viewAction = '
        <span>
          <button class="btn btn-success btn-sm" rel="tooltip"  data-placement="bottom" title="View Image" data-toggle="modal" data-target="#img-'.$row['id'].'">
            <i class="far fa-file-image"></i>
          </button>
        </span>

        <div class="modal fade" id="img-'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body remPad">
                <img src="'.base_url().'/assets/imgs/uploads/attachment/'.$row['new_name'].'" class="img-fluid" />
              </div>
              <!--
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
              -->
            </div>
          </div>
        </div>


        ';


      }

      if(in_array($row['type'],$extPdf) === true){

        $viewAction = '
        <span>
          <a href="'.base_url().'/assets/imgs/uploads/attachment/'.$row['new_name'].'" class="btn btn-warning btn-sm" rel="tooltip"  data-placement="bottom" title="View PDF" target="_new">
            <i class="far fa-eye"></i>
          </a>
        </span>';

      }

      if(isset($_SESSION['roles']) && $_SESSION['roles'] <= 2){
        $delButton = '
          <span>
            <a data-href="'.base_url().'/customers/attachments/delete?attachId='.$row['id'].'" class="btn btn-danger btn-sm btn-delete" rel="tooltip"  data-placement="bottom" title="Delete">
              <i class="fas fa-trash-alt"></i>
            </a>
          </span>
        ';
      }

      $actions = '';
      if(isset($_SESSION['roles']) && $_SESSION['roles'] <= 3){
        $actions = '
          <td>
            <center>
            '.$viewAction.'
            '.$delButton.'
            </center>
          </td>
        ';
      }

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['old_name'].'</td>
          <td class="align-middle">'.$row['new_name'].'</td>
          <td class="align-middle">'.$row['type'].'</td>
          <td class="align-middle text-center">'.$row['created'].'</td>
          '.$actions.'
        </tr>
        ';


    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['pager_count'] = $getTblAttach['pager_count'];
    $arrayList['pagination'] = $getTblAttach['pagination'];

    //return
    return $arrayList;
  }

  //get list of equipment name
  public function tblListEquipName($equipTypeId){

    $EquipNameModel = new EquipNameModel();
    $getTblEquipName = $EquipNameModel->getEquipNameAll($equipTypeId);

    $arrayList = array();
    $tblList = array();

    foreach($getTblEquipName['list'] as $row){

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$row['id'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['equip_type'],'equip_type').'</td>
          <td class="align-middle">'.$row['equip_name'].'</td>
          <td>
            <center>
            <span>
              <button class="btn-editEquipName btn btn-success btn-sm" rel="tooltip"  data-id="'.$row['id'].'" data-name="'.$row['equip_name'].'" data-regionId="'.$row['equip_type'].'" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
            </span>
            </center>
          </td>
        </tr>
        ';

    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['count'] = $getTblEquipName['count'];
    $arrayList['pager_count'] = $getTblEquipName['pager_count'];
    $arrayList['pagination'] = $getTblEquipName['pagination'];

    //return
    return $arrayList;

  }

  //get list of Equipments
  public function tblListEquipments($uid){
    $EquipmentsModel = new EquipmentsModel();
    $getTblEquipments = $EquipmentsModel->getEquipmentsAll($uid);

    $arrayList = array();
    $tblList = array();

    $i = 1;
    foreach($getTblEquipments['list'] as $row){


      $visit1Check = $this->checkVisitExp($row['visit_1']);
      $visit2Check = $this->checkVisitExp($row['visit_2']);

      $tagExp1 = '';
      $tagExp2 = '';
      if($visit1Check == 2){
        $tagExp1 = 'td-warning';
      }
      if($visit1Check == 3){
        $tagExp1 = 'td-danger';
      }
      if($visit2Check == 2){
        $tagExp2 = 'td-warning';
      }
      if($visit2Check == 3){
        $tagExp2 = 'td-danger';
      }

      $editBtn = '';
      if($_SESSION['roles'] <= 2){
        $editBtn = '
          <span>
            <a href="'.base_url().'/customers/equipments/edit?id='.$row['uid'].'&equipId='.$row['id'].'" class="btn btn-success btn-sm" rel="tooltip"  data-placement="bottom" title="Edit">
              <i class="fas fa-edit"></i>
            </a>
          </span>
        ';
      }

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$this->getTaxoName($row['equip_name'],'equip_name').'</td>
          <td class="align-middle">'.$row['serial_no'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['equip_type'],'equip_type').'</td>
          <td class="align-middle">'.$row['manufacturer'].'</td>
          <td class="align-middle text-center '.$tagExp1.'">'.$row['visit_1'].'</td>
          <td class="align-middle text-center '.$tagExp2.'">'.$row['visit_2'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['status'],'equip_status').'</td>
          <td>
            <center>
            <span>
              <a href="'.base_url().'/customers/equipments/view?id='.$row['uid'].'&equipId='.$row['id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                <i class="far fa-eye"></i>
              </a>
            </span>
            '.$editBtn.'
            </center>
          </td>
        </tr>
        ';

    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['count'] = $getTblEquipments['count'];
    $arrayList['pager_count'] = $getTblEquipments['pager_count'];
    $arrayList['pagination'] = $getTblEquipments['pagination'];

    //return
    return $arrayList;
  }

  //get list of All Equipments
  public function tblListEquipmentsAll(){

    $EquipmentsModel = new EquipmentsModel();
    $UserModel = new UserModel();

    if($_SESSION['roles'] <= 2){
      $getTblEquipments = $EquipmentsModel->getEquipmentsAllList('');
    }

    if($_SESSION['roles'] == 3){
      $getEngDetails = $UserModel->getUserDataById($_SESSION['uid']);
      $getTblEquipments = $EquipmentsModel->getEquipmentsAllList($getEngDetails['hospital']);
    }


    $UserModel = new UserModel();


    $arrayList = array();
    $tblList = array();

    $i = $getTblEquipments['offset'];
    foreach($getTblEquipments['list'] as $row){

      $getCustomerDetails = $UserModel->getUserDataById($row['uid']);

      $visit1Check = $this->checkVisitExp($row['visit_1']);
      $visit2Check = $this->checkVisitExp($row['visit_2']);

      $tagExp1 = '';
      $tagExp2 = '';
      if($visit1Check == 2){
        $tagExp1 = 'td-warning';
      }
      if($visit1Check == 3){
        $tagExp1 = 'td-danger';
      }
      if($visit2Check == 2){
        $tagExp2 = 'td-warning';
      }
      if($visit2Check == 3){
        $tagExp2 = 'td-danger';
      }

      $editBtn = '';
      if($_SESSION['roles'] <= 2){
        $editBtn = '
          <span>
            <a href="'.base_url().'/customers/equipments/edit?id='.$row['uid'].'&equipId='.$row['id'].'" class="btn btn-success btn-sm" rel="tooltip"  data-placement="bottom" title="Edit">
              <i class="fas fa-edit"></i>
            </a>
          </span>
        ';
      }

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$getCustomerDetails['name'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['equip_type'],'equip_type').'</td>
          <td class="align-middle">'.$this->getTaxoName($row['equip_name'],'equip_name').'</td>
          <td class="align-middle">'.$row['serial_no'].'</td>
          <td class="align-middle">'.$row['manufacturer'].'</td>
          <td class="align-middle text-center '.$tagExp1.'">'.$row['visit_1'].'</td>
          <td class="align-middle text-center '.$tagExp2.'">'.$row['visit_2'].'</td>
          <td class="align-middle">'.$this->getTaxoName($row['status'],'equip_status').'</td>
          <td>
            <center>
            <span>
              <a href="'.base_url().'/customers/equipments/view?id='.$row['uid'].'&equipId='.$row['id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                <i class="far fa-eye"></i>
              </a>
            </span>
            '.$editBtn.'
            </center>
          </td>
        </tr>
        ';

    }

    $arrayList['rows'] = implode('', $tblList);
    $arrayList['count'] = $getTblEquipments['count'];
    $arrayList['pager_count'] = $getTblEquipments['pager_count'];
    $arrayList['pagination'] = $getTblEquipments['pagination'];

    //return
    return $arrayList;
  }

  //get list of task
  public function tblListTask($uid,$status){

    $TaskModel = new TaskModel();
    $EquipmentsModel = new EquipmentsModel();

    $UserModel = new UserModel();

    $getTask = $TaskModel->getTaskAll($uid,$status);

    $arrayList = array();
    $tblList = array();

    if($getTask){

      $i = 1;

      if(isset($_SESSION['roles']) && $_SESSION['roles'] == 1 || $_SESSION['roles'] == 2){


        foreach($getTask['list'] as $row){

          $equipDetails =  $EquipmentsModel->getEquipmentsSpecific($row['equipments']);
          $userName = $UserModel->getUserDataById($row['uid']);

          if($status > 1){
            $getEngName = $UserModel->getUserDataById($row['eng_uid']);
            $getEng = $getEngName['name'];
          }else{
            $getEng = '<select name="eng_uid" class="assignEng form-control selectpicker" data-orderId="'.$row['order_id'].'" data-live-search="true">'.$this->getSelectOption($row['eng_uid'],'users_eng').'</select>';
          }

          $tblList[] = '
            <tr>
              <td class="align-middle">'.$i++.'</td>
              <td class="align-middle">'.$row['order_id'].'</td>
              <td class="align-middle">'.$userName['name'].'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_type'],'equip_type').'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_name'],'equip_name').'</td>
              <td class="align-middle">'.$equipDetails['manufacturer'].'</td>
              <td class="align-middle">'.$equipDetails['serial_no'].'</td>
              <td class="align-middle text-center">'.$row['updated'].'</td>
              <td class="align-middle">
                '.$getEng.'
              </td>
              <td>
                <center>
                <span>
                  <a href="'.base_url().'/task/view?order_id='.$row['order_id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                    <i class="far fa-eye"></i>
                  </a>
                </span>
                </center>
              </td>
            </tr>
            ';
        }

      }

      if(isset($_SESSION['roles']) && $_SESSION['roles'] == 3){

        foreach($getTask['list'] as $row){

          $equipDetails =  $EquipmentsModel->getEquipmentsSpecific($row['equipments']);
          $userName = $UserModel->getUserDataById($row['uid']);

          $tblList[] = '
            <tr>
              <td class="align-middle">'.$i++.'</td>
              <td class="align-middle">'.$row['order_id'].'</td>
              <td class="align-middle">'.$userName['name'].'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_type'],'equip_type').'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_name'],'equip_name').'</td>
              <td class="align-middle">'.$equipDetails['manufacturer'].'</td>
              <td class="align-middle">'.$equipDetails['serial_no'].'</td>
              <td class="align-middle text-center">'.$row['updated'].'</td>
              <td>
                <center>
                <span>
                  <a href="'.base_url().'/task/view?order_id='.$row['order_id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                    <i class="far fa-eye"></i>
                  </a>
                </span>
                </center>
              </td>
            </tr>
            ';
        }

      }

      if(isset($_SESSION['roles']) && $_SESSION['roles'] == 4){

        foreach($getTask['list'] as $row){

          $equipDetails =  $EquipmentsModel->getEquipmentsSpecific($row['equipments']);

          $tblList[] = '
            <tr>
              <td class="align-middle">'.$i++.'</td>
              <td class="align-middle">'.$row['order_id'].'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_type'],'equip_type').'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_name'],'equip_name').'</td>
              <td class="align-middle">'.$equipDetails['manufacturer'].'</td>
              <td class="align-middle">'.$equipDetails['serial_no'].'</td>
              <td class="align-middle text-center">'.$row['updated'].'</td>
              <td>
                <center>
                <span>
                  <a href="'.base_url().'/request/view?order_id='.$row['order_id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                    <i class="far fa-eye"></i>
                  </a>
                </span>
                </center>
              </td>
            </tr>
            ';
        }

      }



      $returArray = implode('', $tblList);

    }else{
      $returArray = '
        <div class="alert alert-warning">
          No Data yet...
        </div>
      ';
    }



    $arrayList['rows'] = $returArray;
    $arrayList['count'] = $getTask['count'];
    $arrayList['pager_count'] = $getTask['pager_count'];
    $arrayList['pagination'] = $getTask['pagination'];


    //return
    return $arrayList;

  }

  //get list of task of engineers
  public function tblListTaskEngineers($uid,$status){

    $TaskModel = new TaskModel();
    $EquipmentsModel = new EquipmentsModel();

    $UserModel = new UserModel();

    $getTask = $TaskModel->getTaskByEngineer($uid,$status);

    $arrayList = array();
    $tblList = array();

    if($getTask){

      $i = $getTask['offset'];
      foreach($getTask['list'] as $row){

        $equipDetails =  $EquipmentsModel->getEquipmentsSpecific($row['equipments']);
        $userName = $UserModel->getUserDataById($row['uid']);

        $tblList[] = '
          <tr>
            <td class="align-middle">'.$i++.'</td>
            <td class="align-middle">'.$row['order_id'].'</td>
            <td class="align-middle">'.$userName['name'].'</td>
            <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_type'],'equip_type').'</td>
            <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_name'],'equip_name').'</td>
            <td class="align-middle">'.$equipDetails['manufacturer'].'</td>
            <td class="align-middle">'.$equipDetails['serial_no'].'</td>
            <td class="align-middle text-center">'.$row['updated'].'</td>
            <td class="align-middle text-center">'.$this->getTaxoName($row['status'],'task_status').'</td>
            <td>
              <center>
              <span>
                <a href="'.base_url().'/task/view?order_id='.$row['order_id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                  <i class="far fa-eye"></i>
                </a>
              </span>
              </center>
            </td>
          </tr>
          ';
      }

      $returArray = implode('', $tblList);

    }else{
      $returArray = '
        <div class="alert alert-warning">
          No Data yet...
        </div>
      ';
    }



    $arrayList['rows'] = $returArray;
    $arrayList['count'] = $getTask['count'];
    $arrayList['pager_count'] = $getTask['pager_count'];
    $arrayList['pagination'] = $getTask['pagination'];


    //return
    return $arrayList;

  }

  //get list of task of engineers
  public function tblListTaskEquipments($equipId){

    $TaskModel = new TaskModel();
    $EquipmentsModel = new EquipmentsModel();
    $UserModel = new UserModel();

    $getTask = $TaskModel->getTaskByEquipment($equipId);

    $arrayList = array();
    $tblList = array();

    if($getTask){

      $i = $getTask['offset'];
      foreach($getTask['list'] as $row){

        $equipDetails =  $EquipmentsModel->getEquipmentsSpecific($row['equipments']);
        $userEng = $UserModel->getUserDataById($row['eng_uid']);

        $tblList[] = '
          <tr>
            <td class="align-middle">'.$i++.'</td>
            <td class="align-middle">'.$row['order_id'].'</td>
            <td class="align-middle">'.$userEng['name'].'</td>
            <td class="align-middle">'.$row['issue'].'</td>
            <td class="align-middle">'.$this->getTaxoName($row['sc_type'],'sc_type').'</td>
            <td class="align-middle">'.$row['assessment'].'</td>
            <td class="align-middle">'.$row['action'].'</td>
            <td class="align-middle text-center">'.$row['updated'].'</td>
            <td class="align-middle text-center">'.$this->getTaxoName($row['status'],'task_status').'</td>
            <td class="align-middle text-center">
              <center>
              <span>
                <a href="'.base_url().'/task/view?order_id='.$row['order_id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                  <i class="far fa-eye"></i>
                </a>
              </span>
              </center>
            </td>
          </tr>
          ';
      }

      $returArray = implode('', $tblList);

    }else{
      $returArray = '
        <div class="alert alert-warning">
          No Data yet...
        </div>
      ';
    }



    $arrayList['rows'] = $returArray;
    $arrayList['count'] = $getTask['count'];
    $arrayList['pager_count'] = $getTask['pager_count'];
    $arrayList['pagination'] = $getTask['pagination'];


    //return
    return $arrayList;

  }

  //get task history
  public function tblListHistory(){

    $TaskModel = new TaskModel();
    $EquipmentsModel = new EquipmentsModel();
    $UserModel = new UserModel();
    $TaskHistoryModel = new TaskHistoryModel();

    if(isset($_GET['order_id']) && $_GET['order_id'] != ''){
      $getTask = $TaskHistoryModel->getTaskHistory($_GET['order_id']);
    }else{
      $getTask = $TaskModel->getTaskHistory();
    }

    $arrayList = array();
    $tblList = array();

    $orderDetailsHistory = array(
      'equip_type' => '',
      'equip_name' => '',
      'serial_no' => '',
      'manufacturer' => '',
      'created' => '',
      'created_by' => '',
      'customer' => '',
      'customer_id'=>'',
      'equip_id'=> ''
    );


    if($getTask){

      if(isset($_GET['order_id']) && $_GET['order_id'] != ''){

        $i = 1;
        foreach($getTask['list'] as $row){

          $equipDetails =  $EquipmentsModel->getEquipmentsSpecific($row['equipments']);
          $userName = $UserModel->getUserDataById($row['uid']);
          $createdName = $UserModel->getUserDataById($row['created_uid']);
          $getEngName = $UserModel->getUserDataById($row['eng_uid']);
          $getEng = $getEngName['name'];
          $getUpdaterName = $UserModel->getUserDataById($row['updated_uid']);
          $getUpdater = $getUpdaterName['name'];

          $orderDetailsHistory = array(
            'equip_type' => $this->getTaxoName($equipDetails['equip_type'],'equip_type'),
            'equip_name' => $this->getTaxoName($equipDetails['equip_type'],'equip_name'),
            'serial_no' => $equipDetails['serial_no'],
            'manufacturer' => $equipDetails['manufacturer'],
            'created' => date("Y-m-d", strtotime($equipDetails['created'])),
            'created_by' => $createdName['name'],
            'customer' => $userName['name'],
            'customer_id'=>$equipDetails['uid'],
            'equip_id'=> $equipDetails['id']
          );

          $tblList[] = '
            <tr>
              <td class="align-middle">'.$i++.'</td>
              <td class="align-middle text-center">'.$row['updated'].'</td>
              <td class="align-middle">'.$this->getTaxoName($row['status'],'task_status').'</td>
              <td class="align-middle">
                '.$getEng.'
              </td>
              <td class="align-middle">
                '.$getUpdater.'
              </td>
            </tr>
            ';
        }

      }else{

        $i = 1;
        foreach($getTask['list'] as $row){

          $equipDetails =  $EquipmentsModel->getEquipmentsSpecific($row['equipments']);
          $userName = $UserModel->getUserDataById($row['uid']);
          $getEngName = $UserModel->getUserDataById($row['eng_uid']);
          $getEng = $getEngName['name'];

          $tblList[] = '
            <tr>
              <td class="align-middle">'.$i++.'</td>
              <td class="align-middle">'.$row['order_id'].'</td>
              <td class="align-middle">'.$userName['name'].'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_type'],'equip_type').'</td>
              <td class="align-middle">'.$this->getTaxoName($equipDetails['equip_type'],'equip_name').'</td>
              <td class="align-middle">'.$equipDetails['manufacturer'].'</td>
              <td class="align-middle">'.$equipDetails['serial_no'].'</td>
              <td class="align-middle text-center">'.date("Y-m-d",strtotime($row['created'])).'</td>
              <td class="align-middle">'.$this->getTaxoName($row['status'],'task_status').'</td>
              <td class="align-middle">
                '.$getEng.'
              </td>
              <td>
                <center>
                <span>
                  <a href="'.base_url().'/task/history?order_id='.$row['order_id'].'" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View">
                    <i class="far fa-eye"></i>
                  </a>
                </span>
                </center>
              </td>
            </tr>
            ';
        }
      }



      $returArray = implode('', $tblList);

    }else{
      $returArray = '
        <div class="alert alert-warning">
          No Data yet...
        </div>
      ';
    }



    $arrayList['rows'] = $returArray;
    $arrayList['count'] = $getTask['count'];
    $arrayList['pager_count'] = $getTask['pager_count'];
    $arrayList['pagination'] = $getTask['pagination'];
    $arrayList['history_details'] = $orderDetailsHistory;

    //return
    return $arrayList;

  }

  //get list of task's parts
  public function tblListTaskParts($orderId){

    $TaskPartsModel = new TaskPartsModel();
    $getTblParts = $TaskPartsModel->getTaskPartsAll($orderId);

    $arrayList = array();
    $tblList = array();
    $i = 1;

    foreach($getTblParts['list'] as $row){

      $actionBtn = '';
      if($_SESSION['roles'] == 3){
        $actionBtn = '
          <td class="align-middle">
            <center>
              <button type="button" class="btn btn-danger btn-del-parts" btn-sm onClick="delParts('.$row['id'].');" >
                <i class="fas fa-trash-alt"></i>
              </button>
            </center>
          </td>
        ';
      }

      $tblList[] = '
        <tr id="trid-'.$row['id'].'">
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['part_number'].'</td>
          <td class="align-middle">'.$row['description'].'</td>
          <td class="align-middle">'.$row['qty'].'</td>
          '.$actionBtn.'
        </tr>
        ';
    }

    $arrayList['rows_parts'] = implode('', $tblList);

    //return
    return $arrayList;

  }

  //get list of task's parts
  public function tblListTaskPartsPdf($orderId){

    $TaskPartsModel = new TaskPartsModel();
    $getTblParts = $TaskPartsModel->getTaskPartsAll($orderId);

    $arrayList = array();
    $tblList = array();
    $i = 1;

    foreach($getTblParts['list'] as $row){

      $actionBtn = '';


      $tblList[] = '
        <tr id="trid-'.$row['id'].'">
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['part_number'].'</td>
          <td class="align-middle">'.$row['description'].'</td>
          <td class="align-middle">'.$row['qty'].'</td>
          '.$actionBtn.'
        </tr>
        ';
    }

    $arrayList['rows_parts'] = implode('', $tblList);

    //return
    return $arrayList;

  }

  //get list of task's tools
  public function tblListTaskTools($orderId){

    $TaskToolsModel = new TaskToolsModel();
    $getTblTools = $TaskToolsModel->getTaskToolsAll($orderId);

    $arrayList = array();
    $tblList = array();
    $i = 1;


    foreach($getTblTools['list'] as $row){

      $actionBtn = '';

      if($_SESSION['roles'] == 3){
        $actionBtn = '
          <td>
            <center>
              <button type="button" class="btn btn-danger btn-del-tools btn-sm" onClick="delTools('.$row['id'].');" >
                <i class="fas fa-trash-alt"></i>
              </button>
            </center>
          </td>
        ';
      }

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['name'].'</td>
          <td class="align-middle">'.$row['serial_tools'].'</td>
          <td class="align-middle text-center">'.$row['calib_date'].'</td>
          '.$actionBtn.'
        </tr>
        ';
    }

    $arrayList['rows_tools'] = implode('', $tblList);

    //return
    return $arrayList;

  }

  //get list of task's tools
  public function tblListTaskToolsPdf($orderId){

    $TaskToolsModel = new TaskToolsModel();
    $getTblTools = $TaskToolsModel->getTaskToolsAll($orderId);

    $arrayList = array();
    $tblList = array();
    $i = 1;


    foreach($getTblTools['list'] as $row){

      $actionBtn = '';

      $tblList[] = '
        <tr>
          <td class="align-middle">'.$i++.'</td>
          <td class="align-middle">'.$row['name'].'</td>
          <td class="align-middle">'.$row['serial_tools'].'</td>
          <td class="align-middle text-center">'.$row['calib_date'].'</td>
          '.$actionBtn.'
        </tr>
        ';
    }

    $arrayList['rows_tools'] = implode('', $tblList);

    //return
    return $arrayList;

  }

  //insert datas
  public function insertData($tbl,$data){

    $sendData = "";
    $dateNow = date("Y-m-d H:i:s");
    $userUID = $_SESSION['uid'];

    //region
    if($tbl == "region"){
      $arrayInsert = array(
        'region' => $data['region']
      );
      $regionModel = new RegionModel();
      $sendData = $regionModel->insertDataRegion($arrayInsert);
    }

    //city
    if($tbl == "city"){
      $arrayInsert = array(
        'region' => $data['region'],
        'city' => $data['city'],
      );
      $regionModel = new CityModel();
      $sendData = $regionModel->insertDatacity($arrayInsert);
    }

    //user
    if($tbl == "users"){

      //connect
      $userModel = new UserModel();

      //check user if exist
      $checkUserExists = $userModel->checkUserExist($data['email']);

      //output
      if($checkUserExists){
        $sendData = false;
      }else{
        $arrayInsert = array(
          'name' => $data['name'],
          'email' => $data['email'],
          'emp_id' => $data['emp_id'],
          'mobile' => $data['mobile'],
          'telephone' => $data['telephone'],
          'fax' => $data['fax'],
          'address' => $data['address'],
          'po_box' => $data['po_box'],
          'region' => $data['region'],
          'city' => $data['city'],
          'website' => $data['website'],
          'password' => md5($data['password']),
          'job_title' => $data['job_title'],
          'roles' => $data['roles'],
          'zipcode' => $data['zipcode'],
          'status' => $data['status'],
          'created' => $dateNow,
          'created_uid' => $userUID,
          'updated' => $dateNow,
          'updated_uid' => $userUID,
        );
        $sendData = $userModel->insertUser($arrayInsert);
      }
    }

    //staffs
    if($tbl == "staffs"){

      $arrayInsert = array(
        'uid' => $_GET['id'],
        'name' => $data['name'],
        'mobile' => $data['mobile'],
        'email' => $data['email'],
        'job_title' => $data['job_title'],
        'created' => $dateNow,
        'created_uid' => $userUID,
        'updated' => $dateNow,
        'updated_uid' => $userUID,

      );
      $staffsModel = new StaffsModel();
      $sendData = $staffsModel->insertStaff($arrayInsert);
    }

    //user status
    if($tbl == "user_status"){
      $arrayInsert = array(
        'status' => $data['status']
      );
      $statusModel = new StatusModel();
      $sendData = $statusModel->insertData($arrayInsert);
    }

    //task status
    if($tbl == "task_status"){
      $arrayInsert = array(
        'status' => $data['status']
      );
      $statusTaskModel = new StatusTaskModel();
      $sendData = $statusTaskModel->insertData($arrayInsert);
    }

    //equipment status
    if($tbl == "equip_status"){
      $arrayInsert = array(
        'status' => $data['status']
      );
      $StatusEquipModel = new StatusEquipModel();
      $sendData = $StatusEquipModel->insertData($arrayInsert);
    }

    //service type
    if($tbl == "sc_type"){
      $arrayInsert = array(
        'status' => $data['status']
      );
      $StatusSCModel = new StatusSCModel();
      $sendData = $StatusSCModel->insertData($arrayInsert);
    }

    //equipment type
    if($tbl == "equip_type"){
      $arrayInsert = array(
        'equip_type' => $data['equip_type']
      );
      $EquipTypeModel = new EquipTypeModel();
      $sendData = $EquipTypeModel->insertData($arrayInsert);
    }

    //equipment name
    if($tbl == "equip_name"){
      $arrayInsert = array(
        'equip_type' => $data['equip_type'],
        'equip_name' => $data['equip_name']
      );
      $EquipNameModel = new EquipNameModel();
      $sendData = $EquipNameModel->insertData($arrayInsert);
    }

    //equipments
    if($tbl == "equipments"){

      $arrayInsert = array(
        'uid' => $_GET['id'],
        'equip_type' => $data['equip_type'],
        'equip_name' => $data['equip_name'],
        'manufacturer' => $data['manufacturer'],
        'serial_no' => $data['serial_no'],
        'location' => $data['location'],
        'region' => $data['region'],
        'city' => $data['city'],
        'sc_no' => $data['sc_no'],
        'sc_start' => $data['sc_start'],
        'sc_end' => $data['sc_end'],
        'warranty' => $data['warranty'],
        'visit_1' => $data['visit_1'],
        'visit_2' => $data['visit_2'],
        'install_no' => $data['install_no'],
        'status' => $data['status'],
        'created' => $dateNow,
        'created_uid' => $userUID,
        'updated' => $dateNow,
        'updated_uid' => $userUID,
      );
      $EquipmentsModel = new EquipmentsModel();
      $sendData = $EquipmentsModel->insertData($arrayInsert);
    }

    //task from customer
    if($tbl == "task_customer"){

      $arrayInsert = array(
        'uid' => $userUID,
        'order_id' => $data['order_id'],
        'order_date' => $dateNow,
        'sc_type' => $data['sc_type'],
        'equipments' => $data['equipments'],
        'issue' => $data['issue'],
        'created' => $dateNow,
        'created_uid' => $userUID,
        'updated' => $dateNow,
        'updated_uid' => $userUID,
      );
      $TaskModel = new TaskModel();
      $sendData = $TaskModel->insertData($arrayInsert);
    }

    //task from customer
    if($tbl == "task_engineer"){

      $TaskModel = new TaskModel();

      $dateId = date("yjd");
      $getTaskCount = $TaskModel->getTaskCount($data['uid']) + 1;
      $order_id = "AZR0".$data['uid'].'0'.$getTaskCount;

      $arrayInsert = array(
        'uid' => $data['uid'],
        'order_id' => $order_id,
        'order_date' => $dateNow,
        'sc_type' => $data['sc_type'],
        'equipments' => $data['equipments'],
        'issue' => $data['issue'],
        'eng_uid' => $data['eng_uid'],
        'created' => $dateNow,
        'created_uid' => $userUID,
        'updated' => $dateNow,
        'updated_uid' => $userUID,
      );

      $TaskModel = new TaskModel();
      $sendData = $TaskModel->insertData($arrayInsert);
    }

    //return
    return $sendData;

  }

  //update datas
  public function updateData($tbl,$data){

    $sendData = "";
    $dateNow = date("Y-m-d H:i:s");
    $userUID = $_SESSION['uid'];

    //region
    if($tbl == "region"){
      $arrayUpdate = array(
        'region' => $data['region']
      );
      $regionModel = new RegionModel();
      $sendData = $regionModel->updateDataRegion($data['id'],$arrayUpdate);
    }

    //city
    if($tbl == "city"){
      $arrayUpdate = array(
        'region' => $data['region'],
        'city' => $data['city']
      );
      $cityModel = new CityModel();
      $sendData = $cityModel->updateDataCity($data['id'],$arrayUpdate);
    }

    //staffs
    if($tbl == "staffs"){
      $arrayUpdate = array(
        'uid' => $_GET['id'],
        'name' => $data['name'],
        'mobile' => $data['mobile'],
        'email' => $data['email'],
        'job_title' => $data['job_title'],
        'updated' => $dateNow,
        'updated_uid' => $userUID,
      );
      $staffsModel = new StaffsModel();
      $sendData = $staffsModel->updateDataStaffs($data['id'],$arrayUpdate);
    }

    //user status
    if($tbl == "user_status"){
      $arrayUpdate = array(
        'status' => $data['status']
      );
      $StatusModel = new StatusModel();
      $sendData = $StatusModel->updateData($data['id'],$arrayUpdate);
    }

    //task Status
    if($tbl == "task_status"){
      $arrayUpdate = array(
        'status' => $data['status']
      );
      $StatusTaskModel = new StatusTaskModel();
      $sendData = $StatusTaskModel->updateData($data['id'],$arrayUpdate);
    }

    //task Status
    if($tbl == "equip_status"){
      $arrayUpdate = array(
        'status' => $data['status']
      );
      $StatusEquipModel = new StatusEquipModel();
      $sendData = $StatusEquipModel->updateData($data['id'],$arrayUpdate);
    }

    //service type
    if($tbl == "sc_type"){
      $arrayUpdate = array(
        'status' => $data['status']
      );
      $StatusSCModel = new StatusSCModel();
      $sendData = $StatusSCModel->updateData($data['id'],$arrayUpdate);
    }

    //equipment type
    if($tbl == "equip_type"){
      $arrayUpdate = array(
        'equip_type' => $data['equip_type']
      );
      $EquipTypeModel = new EquipTypeModel();
      $sendData = $EquipTypeModel->updateData($data['id'],$arrayUpdate);
    }

    //equipment name
    if($tbl == "equip_name"){
      $arrayUpdate = array(
        'equip_type' => $data['equip_type'],
        'equip_name' => $data['equip_name']
      );
      $EquipNameModel = new EquipNameModel();
      $sendData = $EquipNameModel->updateData($data['id'],$arrayUpdate);
    }

    //equipment name
    if($tbl == "equipments"){
      $arrayUpdate = array(
        'equip_type' => $data['equip_type'],
        'equip_name' => $data['equip_name'],
        'manufacturer' => $data['manufacturer'],
        'serial_no' => $data['serial_no'],
        'status' => $data['status'],
        'install_no' => $data['install_no'],
        'location' => $data['location'],
        'region' => $data['region'],
        'location' => $data['location'],
        'city' => $data['city'],
        'warranty' => $data['warranty'],
        'sc_no' => $data['sc_no'],
        'sc_start' => $data['sc_start'],
        'sc_end' => $data['sc_end'],
        'visit_1' => $data['visit_1'],
        'visit_2' => $data['visit_2'],
        'updated' => $dateNow,
        'updated_uid' => $userUID,
      );
      $EquipmentsModel = new EquipmentsModel();
      $sendData = $EquipmentsModel->updateData($_GET['equipId'],$arrayUpdate);
    }


    //return
    return $sendData;

  }

  public function notifEquipDue(){

    $EquipmentsModel = new EquipmentsModel();
    $UserModel = new UserModel();

    $visit1 = '';
    $visit2 = '';
    $countList = '';

    if(isset($_SESSION['roles']) && $_SESSION['roles'] != ''){
      if($_SESSION['roles'] <= 2){
        $visit1 = $EquipmentsModel->getNotifEquipments('visit_1','');
        $visit2 = $EquipmentsModel->getNotifEquipments('visit_2','');
      }

      if($_SESSION['roles'] == 3){
        $getEngDetails = $UserModel->getUserDataById($_SESSION['uid']);
        $visit1 = $EquipmentsModel->getNotifEquipments('visit_1',$getEngDetails['hospital']);
        $visit2 = $EquipmentsModel->getNotifEquipments('visit_2',$getEngDetails['hospital']);
      }

      $arrayList = array();
      if($visit1){
        foreach($visit1 as $row1){
          $chkWarning1 = $this->checkVisitExp($row1);
          if($chkWarning1 == 2){
            $arrayList[] = $chkWarning1;
          }
        }
      }

      if($visit2){
        foreach($visit2 as $row2){
          $chkWarning2 = $this->checkVisitExp($row2);
          if($chkWarning2 == 2){
            $arrayList[] = $chkWarning2;
          }
        }
      }

      $countList = count($arrayList);
    }


    return $countList;

  }

  //check visits
  public function checkVisitExp($date){

    $visit = strtotime($date);
    $dateToday = time();

    $difference = $visit - $dateToday;
    $numDays =  floor($difference / 86400) + 1;

    if($numDays < 0){
      return 3;
    }
    if($numDays >= 0 && $numDays <= 30){
      return 2;
    }
    if($numDays > 30){
      return 1;
    }


  }
}
