
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
        $tid=intval($_GET['tid']);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manage Mid Term Results</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > 
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
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
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">


                <?php 
                   
                   if($tid){
                    include('includes/teacher-leftbar.php');

                   } else{
                     include('includes/leftbar.php');
                   }
                   
                   ?>  


                    <div class="main-page" style=background-color:lightgray>
                        <div class="container-fluid">
                            <div class="row page-title-div" style=background-color:lightgray>
                                <div class="col-md-6">
                                    <h2 class="title">Mid Term Results</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                     
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading" style=background-color:lightgray>
                                                <div class="panel-title">
                                                    <h4>Edit Mid Term Results</h4>
                                                    <h5>Click on Edit in the Action Column</h5>
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
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr >
                                                            <th>#</th>
                                                            <th>Name of Student</th>
                                                            <th>Student Number</th>
                                                            <th>Class</th>
                                                            <th>Registration Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                         
                                                    <tbody>
<?php $sql = "SELECT  distinct students.StudentName,students.RollId,students.RegDate,students.StudentId,students.Status,classes.ClassName,classes.Section from midresult join students on students.StudentId=midresult.StudentId  join classes on classes.id=midresult.ClassId";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<tr>
 <td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($result->StudentName);?></td>
                                                            <td><?php $stNumber=$result->RollId; echo htmlentities($result->RollId);?></td>
                                                            <td><?php echo htmlentities($result->ClassName);?>(<?php echo htmlentities($result->Section);?>)</td>
                                                            <td><?php echo htmlentities($result->RegDate);?></td>
                                                             <td><?php if($result->Status==1){
echo htmlentities('Active');
}
else{
   echo htmlentities('Blocked'); 
}
                                                                ?></td>

<?php 
$name = $_SESSION['alogin'];



$sql = "SELECT * from teachers WHERE UserName= :username";
$query = $dbh->prepare($sql);
$query->execute(['username' => $name]);
$results=$query->fetchAll(PDO::FETCH_OBJ);


foreach($results as $result){
    $clname=$result->ClassId;
    $namex=$result->TeacherId;
    
}


$sql = "SELECT * from students WHERE RollId= :clss";
$query = $dbh->prepare($sql);
$query->execute(['clss' => $stNumber]);
$results=$query->fetchAll(PDO::FETCH_OBJ);


foreach($results as $result){
    $clnames=$result->ClassId; 
    
}
?>

<td>

<?php 

if($clname != $clnames)
{   
    
?>

<a href="edit-midresult.php?stid=<?php echo htmlentities($result->StudentId);?>&tid=<?php echo htmlentities($stid); ?>" style=color:blue><u>View</u></i> </a>

<?php } else{ ?>
<a href="edit-midresult.php?stid=<?php echo htmlentities($result->StudentId);?>&tid=<?php echo htmlentities($stid); ?>" style=color:blue><u>Edit</u></i> </a> 
<a href="delete-user.php?student2=<?php echo htmlentities($result->StudentId);?>&stidxx=<?php echo htmlentities($tid); ?>" style=color:blue><u>Delete</u></i> </a>
<a href="view-result.php?stid=<?php echo htmlentities($result->StudentId);?>&tid=<?php echo htmlentities($tid); ?>" style=color:blue><u>View</u></i> </a>  
<?php } ?>


</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table>

                                                <div class="" align=center >
                                                            <a href="add-midresult.php" ><button type="" name="" class="btn btn-primary" style=background-color:orange >Publish Result</button></a>
                                                        </div>


                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

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
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
        </div>

        <footer class="footer">

           <p>Copyright &copy; 2020; All Rights Reserved</p>

        </footer>
    </body>
</html>
<?php } ?>

