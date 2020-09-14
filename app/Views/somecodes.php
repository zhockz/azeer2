<?php

//search form
if(isset($_POST['submitSearch'])){
  return redirect()->to(base_url()."/task/history?search=1&id=".$_POST['order_id']."&status=".$_POST['status']."");
}

//search query
if(isset($_GET['id']) && $_GET['id'] != ''){
  $queryz->builder()->like('order_id',$_GET['id']);
}
if(isset($_GET['status']) && $_GET['status'] != ''){
  $queryz->where('status',$_GET['status']);
}

?>
