<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

        $student=intval($_GET['stu']);

if(isset($_POST['submit']))
{
$daysAttended=$_POST['daysattended'];
$totalDays=$_POST['totaldays']; 
$year=$_POST['year'];
$sql="INSERT INTO  attendance(DaysAttended,TotalDays,Year,StudentId) VALUES(:dayattended,:totadays,:yr,:idStudent)";
$query = $dbh->prepare($sql);

$query->bindParam(':dayattended',$daysAttended,PDO::PARAM_STR);
$query->bindParam(':totadays',$totalDays,PDO::PARAM_STR);
$query->bindParam(':yr',$year,PDO::PARAM_STR);
$query->bindParam(':idStudent',$student,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($query)
{
$msg="The Class has been added successfully";
}
else 
{
$error="An error occured. Try again";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Attendance</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > 
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="css/customized.css">
        <script src="js/modernizr/modernizr.min.js"></script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>

    <body>

    <?php include('includes/titlebar.php');?> 

    <div class="">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php');?>   
          <!-----End Top bar>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

<!-- ========== LEFT SIDEBAR ========== -->
<?php include('includes/teacher-leftbar.php');?>                   
 <!-- /.left-sidebar -->

                    <div class="main-page" style=background-color:lightgray>
                        <div class="container-fluid">
                            <div class="row page-title-div" style=background-color:lightgray>
                                <div class="col-md-6">
                                    <h2 class="title">Add Attendance</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                          
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Add Student Attendace</h5>
                                                </div>
                                            </div>
           <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Congratulations!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Sorry!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
  
                                            <div class="panel-body">

                                                <form method="post">
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label" style=color:black>Days Attended</label>
                                                		<div class="" >
                                                			<input type="number" name="daysattended" class="form-control" required="required" id="success" placeholder="Number of Days Attended" >
                                                            
                                                		</div>
                                                	</div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label" style=color:black>Total Number Of Days</label>
                                                        <div class="">
                                                            <input type="number" name="totaldays" required="required" class="form-control" id="success" placeholder="Total number of days">
                                                            
                                                        </div>
                                                    </div>
                                                     <div class="form-group has-success">
                                                        <label for="success" class="control-label" style=color:black>Year</label>
                                                        <div class="">
                                                            <input type="number" name="year" class="form-control" required="required" id="success" placeholder="Year">
                                                            
                                                        </div>
                                                    </div>
  <div class="form-group has-success">

                                                    
                                                        <div class="" >
                                                            <button type="submit" name="submit" class="btn btn-primary" style=background-color:orange >Submit</button>
                                                        </div>
                                                                       
                                                </form>

                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
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

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>


    </div>

    <footer class="footer">

        <p>Copyright &copy; 2020; All Rights Reserved</p>

    </footer>


    </body>
</html>
<?php  } ?>
