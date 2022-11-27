<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['update']))
{
$daysAttended=$_POST['daysattended'];
$totalDays=$_POST['totaldays']; 
$year=$_POST['year'];
$cid=intval($_GET['stid']);
$sql="update  attendance set DaysAttended=:daysattended,TotalDays=:totaldays,Year=:year where StudentId=:cid ";
$query = $dbh->prepare($sql);
$query->bindParam(':daysattended',$daysAttended,PDO::PARAM_STR);
$query->bindParam(':totaldays',$totalDays,PDO::PARAM_STR);
$query->bindParam(':year',$year,PDO::PARAM_STR);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$msg="The class has been updated";

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Attendance</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > 
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="css/customized.css">
        <script src="js/modernizr/modernizr.min.js"></script>
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
                                    <h2 class="title">Edit Attendance</h2>
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
                                                    <h5>Edit Student Attendance</h5>
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
<?php 
$cid=intval($_GET['stid']);
$sql = "SELECT * from attendance where StudentId=:cid";
$query = $dbh->prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;

if($query->rowCount() > 0)
{
foreach($results as $result)
{
    
    ?>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label" style=color:black>Days Attended</label>
                                                		<div class="">
                                                			<input type="number" name="daysattended" value="<?php echo htmlentities($result->DaysAttended);?>" required="required" class="form-control" id="success">
                                                            
                                                		</div>
                                                	</div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label" style=color:black>Total Number of Days</label>
                                                        <div class="">
                                                            <input type="number" name="totaldays" value="<?php echo htmlentities($result->TotalDays);?>" required="required" class="form-control" id="success">
                                                           
                                                        </div>
                                                    </div>
                                                     <div class="form-group has-success">
                                                        <label for="success" class="control-label" style=color:black>Year</label>
                                                        <div class="">
                                                            <input type="number" name="year" value="<?php echo htmlentities($result->Year);?>" class="form-control" required="required" id="success">
                                                            
                                                        </div>
                                                    </div>
                                                    <?php }} ?>
  <div class="form-group has-success">

                                                        <div class="">
                                                           <button type="submit" name="update" class="btn btn-primary" style=background-color:orange>Update</button>
                                                           
                                                    </div>
                                                    
                                                </form>

                                              
                                            </div>
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

             
                    <!-- /.right-sidebar -->

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
