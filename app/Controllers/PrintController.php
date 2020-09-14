<?php
namespace App\Controllers;

include(APPPATH . 'Libraries/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\CommonController;
use App\Models\UserModel;
use App\Models\EquipmentsModel;
use App\Models\TaskModel;
use CodeIgniter\Controller;


class PrintController extends BaseController{

  public function index(){

    $session = session();

    if(!isset($_SESSION['uid'])){
      return redirect()->to(base_url());
    }

    //data
    $data = array();
    $data['result'] = "";
    $data['message'] = "";

    //connect
    $TaskModel = new TaskModel();
    $common = new CommonController();
    $EquipmentsModel = new EquipmentsModel();
    $UserModel = new UserModel();

    //vars
    $dateNow = date("Y-m-d");
    $dateId = date("YmdHis");
    $userUID = $_SESSION['uid'];

    $getOrderDetails = $TaskModel->getTaskByOrderId($_GET['order_id']);
    $getEquipmentDetails = $EquipmentsModel->getEquipmentsSpecific($getOrderDetails['equipments']);
    $getCustomerDetails = $UserModel->getUserDataById($getOrderDetails['uid']);
    $getEngineerDetails = $UserModel->getUserDataById($getOrderDetails['eng_uid']);
    $getTaskParts = $common->tblListTaskPartsPdf($_GET['order_id']);
    $getTaskTools = $common->tblListTaskToolsPdf($_GET['order_id']);

    if($getEngineerDetails == false){
      $engId = '';
    }else{
      $engId = $getOrderDetails['eng_uid'];
    }

    $engSelectOption = $common->getSelectOption($engId,'users_eng');
    $taskStatusSelectOption = $common->getSelectOption($getOrderDetails['status'],'task_status');
    $scStatusSelectOption = $common->getSelectOption($getOrderDetails['sc_type'],'sc_type');

    $data['orderId'] = $getOrderDetails['order_id'];
    $data['orderDate'] = date("Y-m-d", strtotime($getOrderDetails['created']));
    $data['eng_option'] = $engSelectOption;
    $data['engName'] = $getEngineerDetails['name'];
    $data['taskStatus_option'] = $taskStatusSelectOption;
    $data['taskStatusName'] = $common->getTaxoName($getOrderDetails['status'],'task_status');

    $data['arrival_date'] = $getOrderDetails['arrival_date'];
    $data['arrival_time'] = $getOrderDetails['arrival_time'];
    $data['start_time'] = $getOrderDetails['start_time'];
    $data['end_time'] = $getOrderDetails['end_time'];

    $data['customer'] = $getCustomerDetails['name'];
    $data['contact_name'] = $getOrderDetails['contact_name'];
    $data['contractor'] = $getOrderDetails['contractor'];

    $data['equip_type'] = $common->getTaxoName($getEquipmentDetails['equip_type'],'equip_type');
    $data['equip_name'] = $common->getTaxoName($getEquipmentDetails['equip_name'],'equip_name');
    $data['serial_no'] = $getEquipmentDetails['serial_no'];
    $data['issue'] = $getOrderDetails['issue'];
    $data['equip_status'] = $common->getTaxoName($getEquipmentDetails['status'],'equip_status');
    $data['sc_option'] = $scStatusSelectOption;
    $data['scName'] = $common->getTaxoName($getOrderDetails['sc_type'],'sc_type');
    $data['install_no'] = $getEquipmentDetails['install_no'];
    $data['manufacturer'] = $getEquipmentDetails['manufacturer'];
    $data['img_before'] = $getOrderDetails['img_before'];
    $data['img_after'] = $getOrderDetails['img_after'];

    $data['assessment'] = $getOrderDetails['assessment'];
    $data['action'] = $getOrderDetails['action'];

    $data['img_attach'] = $getOrderDetails['img_attach'];

    $data['rows_parts'] = $getTaskParts['rows_parts'];
    $data['rows_tools'] = $getTaskTools['rows_tools'];

    $html = $this->pdfHtml($data);

    $options = new Options();
    $options->setIsRemoteEnabled(true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    //$dompdf->stream($getOrderDetails['order_id'],array('Attachment'=>0));
    $dompdf->stream($getOrderDetails['order_id'].".pdf");


  }

  public function pdfHtml($data){

    /*
    if($data['img_before'] == ''){
      $imgBefore = '<img src="'.base_url().'/assets/imgs/default-noimg.png" class="img-fluid"/>';
    }else{
      $imgBefore = '<img src="'.base_url().'/assets/imgs/uploads/attachment/'.$data['img_before'].'" class="img-fluid"/>';
    }

    if($data['img_after'] == ''){
      $imgAfter = '<img src="'.base_url().'/assets/imgs/default-noimg.png" class="img-fluid"/>';
    }else{
      $imgAfter = '<img src="'.base_url().'/assets/imgs/uploads/attachment/'.$data['img_after'].'" class="img-fluid"/>';
    }
    */

    $html = '';

    //header
    $header ='
    <!doctype html>
    <html lang="en">
    	<head>
    		<!-- Required meta tags -->
    		<meta charset="utf-8">
    		<!-- Custom CSS -->
    		<link rel="stylesheet" href="'.base_url().'/assets/css/pdf.css"/>

    		<title>Azzeer</title>
    	</head>
    	<body id="full-width" class="fnt-wht">

        <div class="header">
            <img src="'.base_url().'/assets/imgs/azeer-logo-big-dark.png" class="logo" />
            <hr />
        </div>
    ';

    //body
    $html .= '
      <div class="content">

        '.$header.'

        <!-- row 1 -->
        <div class="row">
          <div class="div50">
            <p><b class="w-90">Order Id :</b> '.$data['orderId'].'</p>
            <p><b class="w-90">Engineer :</b> '.$data['engName'].'</p>
            <p><b class="w-90">Status : </b> '.$data['taskStatusName'].'</p>
          </div>
          <div class="div50">
            <!--<p><b class="w-90">Order Date :</b> '.$data['orderDate'].'</p>-->
            <p><b class="w-90">Date :</b> ____________________________________</p>
            <p><b class="w-90">Service Type :</b> '.$data['scName'].'</p>
            <p><b class="">Azeer Signature and Date :</b> ___________________________</p>
          </div>
        </div>

        <div class="fl-clear"></div>
        <div class="spacer-6"></div>
        <hr />

        <!-- row 2 -->
        <div>
          <p><b>Service Date and Time :</b></p>
          <div class="spacer-6"></div>
          <table>
            <thead>
              <tr>
                <td>Arrival Date</td>
                <td>Arrival Time</td>
                <td>Start Time</td>
                <td>End Time</td>
              </tr>
            </thead>
            <tbody>
              <tr style="text-align:center;">
                <td >'.$data['arrival_date'].'</td>
                <td>'.$data['arrival_time'].'</td>
                <td>'.$data['start_time'].'</td>
                <td>'.$data['end_time'].'</td>
              </tr>
            </tbody>
          </table>
        </div>

        <hr />

        <!-- row 3 -->
        <div>
          <div class="row">
            <div class="div50">
              <p><b class="w-90">Customer :</b> '.$data['customer'].'</p>
              <p><b class="w-90">Contact : </b> '.$data['contact_name'].'</p>
              <p><b class="w-90">Contractor : </b> '.$data['contractor'].'</p>
            </div>
            <div class="div50">

              <p><b class="w-90">Installation No. : </b> '.$data['install_no'].'</p>
              <p><b class="w-90">Manufacturer : </b> '.$data['manufacturer'].'</p>
              <p><b class="">Customer Signature and Date : </b> _______________________</p>
            </div>
          </div>

          <div class="fl-clear"></div>
          <div class="spacer-6"></div>

          <p><b>Equipment :</b></p>
          <div class="spacer-6"></div>
          <table>
            <thead>
              <tr>
                <td>Type</td>
                <td>Model</td>
                <td>Serial No.</td>
                <td>Issue</td>
                <!--
                <td>Status</td>
                -->
              </tr>
            </thead>
            <tbody>
              <tr>
                <td >'.$data['equip_type'].'</td>
                <td>'.$data['equip_name'].'</td>
                <td>'.$data['serial_no'].'</td>
                <td>'.$data['issue'].'</td>
                <!--
                <td>'.$data['equip_status'].'</td>
                -->
              </tr>
            </tbody>
          </table>

          <hr />
          <div class="spacer-6"></div>

          <!-- row 3 -->
          <div>
            <p><b>Notes :</b></p>
            <div class="spacer-6"></div>
            <table>
              <thead>
                <tr>
                  <td>Troubleshoot</td>
                  <td>Action to be Taken</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td >'.$data['assessment'].'</td>
                  <td>'.$data['action'].'</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="spacer-6"></div>
          <hr />

          <!-- row 4 -->
          <div>
            <p><b>Recommended/Replaced Spare Parts :</b></p>
            <div class="spacer-6"></div>
            <table>
              <thead>
                <tr>
                  <td style="width:5%;">#</td>
                  <td>Part Number</td>
                  <td>Description</td>
                  <td style="width:10%;">Quantity</td>
                </tr>
              </thead>
              <tbody>
                  '.$data['rows_parts'].'
              </tbody>
            </table>
          </div>

          <hr />

          <!-- row 5 -->
          <div>
            <p><b>Test Tools: :</b></p>
            <div class="spacer-6"></div>
            <table>
              <thead>
                <tr>
                  <td style="width:5%;">#</td>
                  <td>Name</td>
                  <td>Serial No.</td>
                  <td style="width:20%;">Calibration Due Date</td>
                </tr>
              </thead>
              <tbody>
                  '.$data['rows_tools'].'
              </tbody>
            </table>
          </div>

          <hr />

          <!-- row 6 -->
          <div>
            <p><b class="w-90">Attachment :</b> "Please see the downloaded attachment in the system."</p>
          </div>

          <!--
          <div class="spacer-100"></div>

          <div>
          <div class="row">
              <div class="div50">
                <p>___________________________________</p>
                <p><b>Azeer Signature</b></p>
              </div>
              <div class="div50">
                <p>__________________________________</p>
                <p><b>Customer Signature</b></p>
              </div>
          </div>
          </div>

        </div>
        -->

      </div>
    ';

    return $html;
  }

  public function imgBA(){

    $html = '
      <div class="spacer-6"></div>

              <div class="row">
                <div class="div50">
                  <p><b>Image Before Repairing :</b></p>
                  <div class="spacer-6"></div>
                  '.$imgBefore.'
                </div>
                <div class="div50">
                  <p><b>Image After Repairing :</b></p>
                  <div class="spacer-6"></div>
                  '.$imgAfter.'
                </div>
              </div>

              <div class="fl-clear"></div>

              <div class="spacer-6"></div>'
    ;

  }

}
