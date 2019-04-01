<?php
$aa = $core->getMemberDetail(['bnk_name' => 'Cherprang'], ['bnk_slug'], ['bnk_name', 'ASC']);
//print_r($aa);
die($aa[0]['bnk_slug']);
header('Content-Type: application/json; charset=utf-8');
$object['status'] = 1;
//$object['data'] = $core->getTopGraph(10 ,'fb', '2');
$object['data'] = $core->getTopGraph(10);
echo json_encode($object, JSON_PRETTY_PRINT);
?>