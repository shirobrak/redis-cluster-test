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

$client = new Predis\Client($params, $options);

$set_num = 10000;
for($i=0;$i<$set_num;$i++){
  $key = "key".strval($i);
  $value = "hoge".strval($i);
  $res = $client->executeRaw(['SET', $key, $value]);
}

?>
