<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
    
    $stid=intval($_GET['stid']);
    
if(isset($_POST['submit']))
{
    $marks=array();
$class=$_POST['class'];
$passmark=$_POST['passmark'];
$studentid=$_POST['studentid']; 
$mark=$_POST['marks'];

 $stmt = $dbh->prepare("SELECT subjects.SubjectName,subjects.id FROM subjectcombination join  subjects on  subjects.id=subjectcombination.SubjectId WHERE subjectcombination.ClassId=:cid order by subjects.SubjectName");
 $stmt->execute(array(':cid' => $class));
  $sid1=array();
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {

array_push($sid1,$row['id']);
   }
   
  
   $sum=0;

   $total=0;
  
for($i=0;$i<count($mark);$i++){
    $mar=$mark[$i];
  $sid=$sid1[$i];
$sql="INSERT INTO  result(StudentId,ClassId,SubjectId,marks, passMark) VALUES(:studentid,:class,:sid,:marks, :passmark)";


$sum= $sum + $mar;
$total= $total + 1;


$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':class',$class,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':marks',$mar,PDO::PARAM_STR);
$query->bindParam(':passmark',$passmark,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="The student results have been added successfully";

}
else 
{
$error="An error occured. Try again";
}
}


$sql = "SELECT * from students WHERE StudentId= :cls";
$query = $dbh->prepare($sql);
$query->execute(['cls' => $studentid]);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$subjectstotal=$query->rowcount();

foreach($results as $result){
    $stname=$result->StudentName; 
    $compNumber=$result->RollId;
    $stId=$result=$result->StudentId;
  
}

$sql = "SELECT * from classes WHERE id= :clsaa";
$query = $dbh->prepare($sql);
$query->execute(['clsaa' => $class]);
$results1=$query->fetchAll(PDO::FETCH_OBJ);
$classtotal=$query->rowcount();

foreach($results1 as $result2){
    $classname=$result2->ClassName; 
    $clsection=$result2->Section;
       
}


$totals=100*$total;
$passpercent=($sum/$totals)*100;


$classnames=$classname ."(" .$clsection .")";

if($passpercent >= $passmark){
    $state= "null";
} else{
    $state= "null";
}

$status=1;


$sql="INSERT INTO  meritlist(StudentName,UserName,Total,ClassId,MarkObtained,CurrentStatus,Status,StudentId, ClassName) VALUES(:studentname,:username,:total,:classid, :sumx, :currentstatus,:status, :studid, :classname)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentname',$stname,PDO::PARAM_STR);
$query->bindParam(':username',$compNumber,PDO::PARAM_STR);
$query->bindParam(':total',$totals,PDO::PARAM_STR);
$query->bindParam(':classid',$class,PDO::PARAM_STR);
$query->bindParam(':sumx',$sum,PDO::PARAM_STR);
$query->bindParam(':currentstatus',$state,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':studid',$stId,PDO::PARAM_STR);
$query->bindParam(':classname',$classnames,PDO::PARAM_STR);
$query->execute();

}

?>

<?php

$name = $_SESSION['alogin'];

$sql = "SELECT * from teachers WHERE UserName= :username";
$query = $dbh->prepare($sql);
$query->execute(['username' => $name]);
$results=$query->fetchAll(PDO::FETCH_OBJ);


foreach($results as $result){
    $clname=$result->ClassId; 
    
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add End of Term Result </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <link rel="stylesheet" type="text/css" href="css/customized.css">
        <script src="js/modernizr/modernizr.min.js"></script>
        <script>
function getStudent(val) {
    $.ajax({
    type: "POST",
    url: "get_student.php",
    data:'classid='+val,
    success: function(data){
        $("#studentid").html(data);
        
    }
    });
$.ajax({
        type: "POST",
        url: "get_student.php",
        data:'classid1='+val,
        success: function(data){
            $("#subject").html(data);
            
        }
        });
}
    </script>
<script>

function getresult(val,clid) 
{   
    
var clid=$(".clid").val();
var val=$(".stid").val();;
var abh=clid+'$'+val;

    $.ajax({
        type: "POST",
        url: "get_student.php",
        data:'studclass='+abh,
        success: function(data){
            $("#reslt").html(data);
            
        }
        });
}
</script>


    </head>

    <body>

    <?php include('includes/titlebar.php'); ?>

    <div class="">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->

                    
                   <?php include('includes/teacher-leftbar.php'); ?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page" style=background-color:lightgray>

                     <div class="container-fluid">
                            <div class="row page-title-div" style=background-color:lightgray>
                                <div class="col-md-6">
                                    <h2 class="title">Publish End of Term Results</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                    
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                           
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Congratulations!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Sorry!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">

 <div class="form-group">
<label for="default" class="col-sm-2 control-label">Name of Class</label>
 <div class="col-sm-10">
 <select name="class" class="form-control clid" id="classid" onChange="getStudent(this.value);" required="required">
<option value="">Select Class</option>
<?php $sql = "SELECT * from classes WHERE id=:clname";
$query = $dbh->prepare($sql);
$query->execute(['clname' => $clname]);
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
     $myname=$result->ClassName;
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Division-<?php echo htmlentities($result->Section); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>
<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Student Name</label>
                                                        <div class="col-sm-10">
                                                    <select name="studentid" class="form-control stid" id="studentid" required="required" onChange="getresult(this.value);">
                                                    </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                      
                                                        <div class="col-sm-10">
                                                    <div  id="reslt">
                                                    </div>
                                                        </div>
                                                    </div>
                                                    
<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label">Subjects</label>
                                                        <div class="col-sm-10">
                                                    <div  id="subject">
                                                    </div>
                                                        </div>
                                                    </div>
                         
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary" style=background-color:orange>Publish Result</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
        </div>
        <footer class="footer">

           <p>Copyright &copy; 2020; All Rights Reserved</p>

        </footer>
    </body>
</html>
<?PHP } ?>
