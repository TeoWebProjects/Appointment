<?php
session_start();

// set language session with var url
if(isset($_GET['language'])){
    $_SESSION["lang"] = $_GET['language'];
}else{
    // default session
    $_SESSION["lang"] = "greek";
}

// include the right language from $_SESSION["lang"]
if(isset($_SESSION["lang"])){
    if($_SESSION["lang"] === "english"){
        include("./_lg/lang/english.php");
    }else{
        include("./_lg/lang/greek.php");
    }

}

?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="customLab.gr">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <?php define('ETAIREIA', 'ETAIREIA');?>
    <title><?=ETAIREIA?> | by customLab</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css' rel='stylesheet' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/green.css" id="theme" rel="stylesheet">

</head>
  <!-- Run the script to convert database to json -->
<?php include("./_lg/ajax_calls/calendar/convert_to_json.php"); ?>
<body class="fix-header fix-sidebar card-no-border ">    
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include("_head/header.php"); ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include("_head/left_menu.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    
                    <div class="col-md-5 col-8 align-self-center" id="breadcrumbs">
                        <h3 class="text-themecolor"><?php echo APPOINTMENT ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><?php echo HOME ?></a></li>
                            <li class="breadcrumb-item active"><?php echo CALENDARS ?></li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center"></div>
                
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include("_head/footer.php"); ?>
      
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/calendar/jquery-ui.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/popper/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    
    <!--Custom JavaScript -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js'></script>
    <script src="./calendar/modals.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(".preloader").fadeOut()

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                eventClassNames: 'boxes',
                editable: true,
                selectable: true,
                select:  function (info){
                    // day of cell
                    let selectDate = JSON.stringify(info.end).substring(1, JSON.stringify(info.end).indexOf("T"))
                   // check if cell is empty
                    let isEmpty = true
                    calendar.getEvents().forEach(event => {
                        let eventDate = JSON.stringify(event.start).substring(1, JSON.stringify(event.start).indexOf("T"))
                        if(eventDate === selectDate){
                            isEmpty = false
                        }
                    });
                    
                    if(isEmpty){  
                        // create modal ui you can find in ./calendar/modal.js
                        createModal()

                        const form = document.querySelector('.form-create')
                    
                        form.addEventListener('submit', (e) => {

                            e.preventDefault()

                            const title = document.querySelector('#title').value
                            const comments = document.querySelector('#comments').value
                            let startTime = document.querySelector('#starttime').value
                            let endTime = document.querySelector('#endtime').value

                            // display seconds if its 0
                            if(startTime.length === 5){
                                startTime = startTime+':00'
                            }

                            if(endTime.length === 5){
                                endTime = endTime+':00'
                            }
                                
                           
                            const data = {
                                title: title,
                                comments: comments,
                                start: `${selectDate} ${startTime}`,
                                end: `${selectDate} ${endTime}`,
                            }

                            $.ajax({
                                type: 'POST',
                                url: 'calendar/create_appointment.php',
                                data: data,
                                success: function (data) {
                                    console.log(data) 
                                    location.reload()
                                },
                            })
                        })
                        
                    }
                },
                dayMaxEvents: true, // allow "more" link when too many events
                headerToolbar: {
                    left: 'prev,myCustomButton,next',
                    center: 'title',
                    right: 'timeGridDay dayGridWeek dayGridMonth'
                },
                resourceAreaWidth:"10%",
                slotMinTime: "08:00:00",
                slotMaxTime: "23:00:00",
                nowIndicator: true,
                slotDuration:'00:15:00',
                events: 'appointments.json',
                eventClick: function(info) {
                    // create modal ui you can find in ./calendar/modal.js
                    updateModal(info)

                    // get the event date
                    let selectDate = JSON.stringify(info.event.end).substring(1, JSON.stringify(info.event.end).indexOf("T"))

                    const id = info.event.id;
                    const title = document.querySelector('#title').value
                    const comments = document.querySelector('#comments').value
                    const startTime = document.querySelector('#starttime').value
                    const endTime = document.querySelector('#endtime').value
                    const formUpdate = document.querySelector('.form-update')
                        
                    const current_data = `${id}|${title}|${comments}|${selectDate} ${startTime}|${selectDate} ${endTime}`


                    formUpdate.addEventListener('submit', (e)=>{
                        e.preventDefault()

                        const newTitle = document.querySelector('#title').value
                        const newComments = document.querySelector('#comments').value
                        let newStartTime = document.querySelector('#starttime').value
                        let newEndTime = document.querySelector('#endtime').value

                        // display seconds if its 0
                        if(newStartTime.length === 5){
                            newStartTime = newStartTime+':00'
                        }

                        if(newEndTime.length === 5){
                            newEndTime = newEndTime+':00'
                        }
                    
                        const newData = `${id}|${newTitle}|${newComments}|${selectDate} ${newStartTime}|${selectDate} ${newEndTime}`
                    
                        const data = {
                            current_data : current_data,
                            new_data: newData
                        }

                        $.ajax({
                            type: 'POST',
                            url: './calendar/update_appointment.php',
                            data: data,
                            success: function (data) {
                                    console.log(data) 
                                    location.reload()
                            },
                        })
                    })
                }
                });
            calendar.render();
          });

    </script>
</body>



</html>