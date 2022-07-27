<?php

// check if database.txt exist
if (!file_exists('./_lg/ajax_calls/calendar/database.txt')) {
    // create database.txt
    file_put_contents('./_lg/ajax_calls/calendar/database.txt','');
} 


$data_txt = file_get_contents('./_lg/ajax_calls/calendar/database.txt');


// format data to array and remove chunks
$new_data = array_filter(explode("\n", $data_txt), fn($value) => !is_null($value) && $value !== '');

$result = [];

if(count($new_data) > 0){

  foreach ($new_data as $key => $data) {
        $array = explode('|', $data);
        array_push($result,[
          'id' => $array[0],
          'title' => $array[1],
          'comments' => $array[2],
          'start' => $array[3],
          'end' => preg_replace("/\r|\n/", "", $array[4]),
        ]);
  }

  file_put_contents('appointments.json', json_encode($result));

}else{
  file_put_contents('appointments.json', '');
}

?>