<?php

$data = array('as', 'df', 'gh');

// Execute the python script with the JSON data
$result = exec('python pay.py ' . escapeshellarg(json_encode($data)));
print_r($result);
// Decode the result
$resultData = json_decode($result, true);

// This will contain: array('status' => 'Yes!')
var_dump($resultData);