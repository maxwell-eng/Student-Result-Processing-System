<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
        ?>


<?php


$name = $_SESSION['alogin'];



$sql = "SELECT * from teachers WHERE UserName= :username";
$query = $dbh->prepare($sql);
$query->execute(['username' => $name]);
$results=$query->fetchAll(PDO::FETCH_OBJ);


foreach($results as $result){
    $clname=$result->ClassId;
    $teachid=$result->TeacherId; 
    
}


$sql = "SELECT * from subjectcombination WHERE ClassId= :clss";
$query = $dbh->prepare($sql);
$query->execute(['clss' => $clname]);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$subjectstotal=$query->rowcount();


$sql = "SELECT * from teachers WHERE TeacherId= :idteach and ClassId= :clsa";
$query = $dbh->prepare($sql);
$query->execute(['idteach' => $teachid, 'clsa' => $clname]);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$classtotal=$query->rowcount();

     

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Teacher Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen" >
        <link rel="stylesheet" href="css/icheck/skins/line/blue.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/red.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/green.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="css/customized.css">
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>

    <body>
    <?php include('includes/titlebar.php');?>

    <div class="">
        <div class="main-wrapper">

              <?php include('includes/topbar.php');?>
            <div class="content-wrapper">
                <div class="content-container">

                    <?php include('includes/teacher-leftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div" style=background-color:lightgray>
                                <div class="col-sm-6">
                                    <h2 class="title">Dashboard</h2>
                                  
                                </div>
                                <!-- /.col-sm-6 -->
                            </div>
                            <!-- /.row -->
                      
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    

<!-- Subjects-->
<div class="col-lg-3">
<div class="panel panel-info">
    <div class="panel-heading" style=background-color:blue>
        <div class="row">
            <div class="col-xs-6">
                <i class="fa fa-file fa-5x"></i>
            </div>


            <div class="col-xs-6 text-right">
                <p class="announcement-heading" style=font-size:30px><?php echo htmlentities($subjectstotal);?></p>
                <p class="announcement-text" style=margin-bottom:2px>Class</p>
                <p class="announcement-text">Subjects</p>
            </div>
        </div>
    </div>
    <a href="teacher-subjects.php">
        <div class="panel-footer announcement-bottom">
            <div class="row">
                <div class="col-xs-6">
                    View
                </div>
                <div class="col-xs-6 text-right">
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
    </a>
</div>
</div>


<!-- Classes-->
<div class="col-lg-3">
<div class="panel panel-info">
    <div class="panel-heading" style=background-color:green>
        <div class="row">
            <div class="col-xs-6">
                <i class="fa fa-bank fa-5x"></i>
            </div>


            <div class="col-xs-6 text-right">
                <p class="announcement-heading" style=font-size:30px><?php echo htmlentities($classtotal);?></p>
                <p class="announcement-text">Teacher`s Classes</p>
            </div>
        </div>
    </div>
    <a href="teacher-classes.php">
        <div class="panel-footer announcement-bottom">
            <div class="row">
                <div class="col-xs-6">
                    View
                </div>
                <div class="col-xs-6 text-right">
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
    </a>
</div>
</div>





<!-- Mid Term Results -->
<div class="col-lg-3">
<div class="panel panel-info">
    <div class="panel-heading" style=background-color:red>
        <div class="row">
            <div class="col-xs-6">
                <i class="fa fa-file-text fa-5x"></i>
            </div>

            <?php 
$sql3="SELECT  distinct StudentId from  midresult ";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totalmidresults=$query3->rowCount();
?>

            


            <div class="col-xs-6 text-right">
                <p class="announcement-heading" style=font-size:30px><?php echo htmlentities($totalmidresults);?></p>
                <p class="announcement-text">Mid Term Results</p>
            </div>
        </div>
    </div>
    <a href="manage-midresults.php?tid=<?php echo htmlentities($teach);?>">
        <div class="panel-footer announcement-bottom">
            <div class="row">
                <div class="col-xs-6">
                    View
                </div>
                <div class="col-xs-6 text-right">
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
    </a>
</div>
</div>   


<!-- End of Term Results -->
<div class="col-lg-3">
<div class="panel panel-info">
    <div class="panel-heading" style=background-color:orange>
        <div class="row">
            <div class="col-xs-6">
                <i class="fa fa-file-text fa-5x"></i>
            </div>

            <?php 
$sql3="SELECT  distinct StudentId from  result ";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totalresults1=$query3->rowCount();
?>


            <div class="col-xs-6 text-right">
                <p class="announcement-heading" style=font-size:30px><?php echo htmlentities($totalresults1);?></p>
                <p class="announcement-text">End of Term Results</p>
            </div>
        </div>
    </div>
    <a href="manage-results.php?tid=<?php echo htmlentities($teach);?>">
        <div class="panel-footer announcement-bottom">
            <div class="row">
                <div class="col-xs-6">
                    View
                </div>
                <div class="col-xs-6 text-right">
                    <i class="fa fa-arrow-circle-right"></i>
                </div>
            </div>
        </div>
    </a>
</div>
</div>   

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                    
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/waypoint/waypoints.min.js"></script>
        <script src="js/counterUp/jquery.counterup.min.js"></script>
        <script src="js/amcharts/amcharts.js"></script>
        <script src="js/amcharts/serial.js"></script>
        <script src="js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="js/amcharts/themes/light.js"></script>
        <script src="js/toastr/toastr.min.js"></script>
        <script src="js/icheck/icheck.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script src="js/production-chart.js"></script>
        <script src="js/traffic-chart.js"></script>
        <script src="js/task-list.js"></script>
        <script>
            $(function(){

                // Counter for dashboard stats
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });

                // Welcome notification
                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr["success"]( "Welcome <?php echo $_SESSION['alogin']; ?>!");

            });
        </script>
    </div>

    <footer class="footer">

        <p>Copyright &copy; 2020; All Rights Reserved</p>

    </footer>

    </body>
</html>
<?php } ?>
