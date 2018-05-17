<?php

$data = array('as', 'df', 'gh');


// Execute the python script with the JSON data

$result = exec('python test-satish.py ' . escapeshellarg(json_encode($data)));


$result = shell_exec('python pay.py ' . escapeshellarg(json_encode($data)));

// Decode the result
$resultData = json_decode($result, true);

// This will contain: array('status' => 'Yes!')
var_dump($resultData);