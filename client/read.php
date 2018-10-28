<?php
require './vendor/autoload.php';

$params = [
  'tcp://127.0.0.1:7000',
  'tcp://127.0.0.1:7001',
  'tcp://127.0.0.1:7002',
  'tcp://127.0.0.1:7003',
  'tcp://127.0.0.1:7004',
  'tcp://127.0.0.1:7005'
];
$options = ['cluster' => 'redis'];

$insertedDataNumber = 0;
$readableDataNumber = 0;
try{
  $client = new Predis\Client($params, $options);
  
  $set_num = 10000;
  for($i=0;$i<$set_num;$i++){
    $key = "key".strval($i);
    $res = $client->executeRaw(['GET', $key]);
    if($res){
      $readableDataNumber++;
      // print("{ key : ".$key.", value : ".$res." }\n");
    }else{
      $value = "hoge".strval($i);
      $client->executeRaw(['SET', $key, $value]);
      //print("inserted: "."{ key : ".$key.", value : ".$value." }\n");
      $insertedDataNumber++;
    }
  }

  print("ReadableData : ".$readableDataNumber.", InsertedData : ".$insertedDataNumber."\n");
}catch(Predis\Connection\ConnectionException $e){
  print("Predis Connection Error \n");
}catch(Exception $e){
  print($e);
}

?>
