<?php

if (isset($_REQUEST['mykey'])){
    $d = $_REQUEST['mykey'];
}
$reponseAr = array();
$responseAr['draw'] = $_REQUEST['draw'];
$responseAr['recordsTotal'] = 3;
$responseAr['recordsFiltered']=3;
$responseAr['data']= array(["david", "beckham", "<a  class='btn  btn-primary ' onclick='deletebtn(this)'>delete</a>"],["paul", "scholes","<a class='btn  btn-primary disabled' click='delete(this)'>delete</a>"],["Roy", "Keane","<a click='delete(this)'>delete</a>"]);
if (isset($d)){
    $responseAr['recordsTotal'] = 2;
    $responseAr['data']= array(["david", "beckham", "<a onclick='deletebtn(this)'>delete</a>"],["paul", "scholes","<a click='delete(this)'>delete</a>"]);
    
}
if (isset($_REQUEST['order'])){
   // $responseAr['data']= array(["david", "beckham", "<a onclick='deletebtn(this)'>delete</a>"],["Roy", "Keane","<a click='delete(this)'>delete</a>"],["paul", "scholes","<a click='delete(this)'>delete</a>"]);
    
}
echo json_encode($responseAr);