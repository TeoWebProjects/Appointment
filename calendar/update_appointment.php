<?php

if(isset($_POST['new_data']) && $_POST['current_data']){

    $current_data = $_POST['current_data'];
    $new_data = $_POST['new_data'];

    $database = file_get_contents('./../_lg/ajax_calls/calendar/database.txt');
    $db_array = explode("\n", $database);

    $result = [];

    foreach ($db_array as $key => $data) {
    
        if(trim($data) === trim($current_data)){
            array_push($result, $new_data.PHP_EOL);
        }else{
            array_push($result, preg_replace("/\r|\n/", "", $data).PHP_EOL);
        }
    }

    $count_array = count($result);

    $result[$count_array - 1] = preg_replace("/\r|\n/", "", $result[$count_array - 1] );

    file_put_contents('./../_lg/ajax_calls/calendar/database.txt', $result);
    echo json_encode($result);

}else{
    header("Location: ./../index.php");   
}

?>