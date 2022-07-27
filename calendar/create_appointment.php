<?php

    if(isset($_POST['title']) && isset($_POST['comments']) && isset($_POST['start']) && isset($_POST['start'])){

        $title = $_POST['title'];
        $comments = $_POST['comments'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        $json = file_get_contents('./../appointments.json');

        $json_to_array = json_decode($json);
        
        
        if(!empty($json_to_array)){
            $new_id = $json_to_array[count($json_to_array) - 1]->id + 1;
            $appointment = "$new_id|$title|$comments|$start|$end";
            file_put_contents('./../_lg/ajax_calls/calendar/database.txt', PHP_EOL.trim($appointment), FILE_APPEND);
        }else{
            $new_id = 1;
            $appointment = "$new_id|$title|$comments|$start|$end";
            file_put_contents('./../_lg/ajax_calls/calendar/database.txt', trim($appointment), FILE_APPEND);
        }
        echo json_encode($appointment);
    }else{
        header("Location: ./../index.php");
    }

?>