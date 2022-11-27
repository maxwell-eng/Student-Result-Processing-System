<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
        //recent change
        $tid=intval($_GET['tid']);

$stid=intval($_GET['stid']);

$sql = "SELECT * from students WHERE StudentId= :stidx";
$query = $dbh->prepare($sql);
$query->execute(['stidx' => $stid]);
$results=$query->fetchAll(PDO::FETCH_OBJ);


foreach($results as $result){
    $clname=$result->ClassId; 
    $stNumber=$result->RollId;
   
}

$sql = "SELECT * from attendance WHERE StudentId=:idstudent";
$query = $dbh->prepare($sql);
$query->execute(['idstudent' => $stid]);
$results=$query->fetchAll(PDO::FETCH_OBJ);


foreach($results as $result){
    $daysattended=$result->DaysAttended; 
    $totaldays=$result->TotalDays;
    $year=$result->Year;
       
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student result</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
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
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->

                    <?php 

                    if($tid){
                        include('includes/teacher-leftbar.php');

                    } else{
                        include('includes/leftbar.php');
                  
                    }
                     
                    
                    ?>  
                   
                    <!-- /.left-sidebar -->

                    <div class="main-page" style=background-color:lightgray>

                     <div class="container-fluid">
                            <div class="row page-title-div" style=background-color:lightgray>
                                <div class="col-md-6">
                                    <h2 class="title">Student Results</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                     
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading" style=background-color:lightgray>
                                                <div class="panel-title">
                                                    <h5>The Student`s Results</h5>
                                                </div>
                                            </div>
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





                                        <section class="section" id="exampl">
                            <div class="container-fluid">

                                <div class="row">
                              
                             

                              <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading" style=background-color:lightgreen>
                                                <div class="panel-title">
                                                    <h3 align="center">Student Report Card</h3>
                                                    <hr />
<?php
// code Student Data
$rollid=$stNumber;
$classid=$clname;
$_SESSION['rollid']=$rollid;
$_SESSION['classid']=$classid;
$qery = "SELECT   students.StudentName,students.RollId,students.RegDate,students.StudentId,students.Status,classes.ClassName,classes.Section from students join classes on classes.id=students.ClassId where students.RollId=:rollid and students.ClassId=:classid ";
$stmt = $dbh->prepare($qery);
$stmt->bindParam(':rollid',$rollid,PDO::PARAM_STR);
$stmt->bindParam(':classid',$classid,PDO::PARAM_STR);
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($resultss as $row)
{  
    $studentIdx= $row->StudentId;

?>
<p><b>Name of Student :</b> <?php echo htmlentities($row->StudentName);?></p>
<p><b>Student Number :</b> <?php echo htmlentities($row->RollId);?>
<p><b>Grade:</b> <?php echo htmlentities($row->ClassName);?>(<?php echo htmlentities($row->Section);?>)
<p><b>Year:</b> <?php echo htmlentities($year);?> <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attendance:</b> <?php echo htmlentities($daysattended);?> <b>Out of </b> <?php echo htmlentities($totaldays);?> 



<?php }

    ?>
                                            </div>
                                            <div class="panel-body p-20">

                                            <table class="table table-hover table-bordered " border="1" width="100%" style="margin-bottom:0px" >

                                            <col style="width:53%">
                                            <col style="width:47%">
                                            
                                                <thead>
                                                        <tr style="text-align: center">
                                                            
                                                            <th style="text-align: center"> Mid Term Test</th>    
                                                            <th style="text-align: center">End of Term Test</th>
                                                            
                                                           
                                                        </tr>
                                               </thead>
                                               </table>

                                                <table class="table table-hover table-bordered " border="1" width="100%" >
                                                <thead>
                                                        <tr style="text-align: center">
                                                            <th style="text-align: center">#</th>
                                                            <th style="text-align: center"> Student`s Subjects</th>    
                                                            <th style="text-align: center">Marks Obtained</th>
                                                            <th style="text-align: center">Marks Out of</th>
                                                            <th style="text-align: center">Comments</th>
                                                            <th style="text-align: center">Marks Obtained</th>
                                                            <th style="text-align: center">Marks Out of</th>
                                                            <th style="text-align: center">Class Average</th>
                                                            <th style="text-align: center">Comments</th>
                                                           
                                                        </tr>
                                               </thead>
  
                                                	
                                                	<tbody>
<?php                                              
// Code for result
$sql = "SELECT * from gradingsystem WHERE ClassId= :clid";
$query = $dbh->prepare($sql);
$query->execute(['clid' => $classid]);
$results1=$query->fetchAll(PDO::FETCH_OBJ);
$classtotal=$query->rowcount();

foreach($results1 as $result2){
    $grTotal=$result2->TotalMark;
    
    $excelent=$result2->Excellent;
    $vg=$result2->VeryGood;
    $good=$result2->Good;
    $average=$result2->Average;
    $belowaverage=$result2->BelowAverage;
       
}


$sql = "SELECT * from midmeritlist WHERE StudentId= :clid";
$query = $dbh->prepare($sql);
$query->execute(['clid' => $studentIdx]);
$results1=$query->fetchAll(PDO::FETCH_OBJ);
$classtotal=$query->rowcount();
$rowNumbers=$query->rowcount();

foreach($results1 as $result2){
    $mtTotal=$result2->Total;
    $mtMarkObtain=$result2->MarkObtained;   
       
}


 $query ="select t.StudentName,t.RollId,t.ClassId,t.marks,t.passMark,SubjectId,subjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,tr.passMark,SubjectId from students as sts join  result as tr on tr.StudentId=sts.StudentId) as t join subjects on subjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
$query= $dbh -> prepare($query);
$query->bindParam(':rollid',$rollid,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query-> execute();  
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($countrow=$query->rowCount()>0)
{ 
foreach($results as $result){

    $passmark = $result->passMark;

    ?>

                                                		<tr>



<th scope="row" style="text-align: center" ><?php echo htmlentities($cnt);?></th>
<td style="text-align: center"><?php echo htmlentities($result->SubjectName);?></td>

<?php

$subid=$result->SubjectId;

$mytotal=0;
$count=0;

$sql5 = "SELECT * from result WHERE ClassId= :clid and  SubjectId=:idx";
$query5 = $dbh->prepare($sql5);
$query5->execute(['clid' => $classid, 'idx' => $subid]);
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$classtotal=$query5->rowcount();

foreach($results5 as $result6){

    $count++;
    $resTotal=$result6->marks;
    
    $mytotal += $resTotal;

    if($count==2){
        $mytotal2 =$mytotal;
        $count2=$count;
    }
    
    
       
}



$avgTotal=$mytotal2/$count2;


$counting=0;


$sql5 = "SELECT * from midresult WHERE ClassId= :clid and  SubjectId=:idx and StudentId=:iee";
$query5 = $dbh->prepare($sql5);
$query5->execute(['clid' => $classid, 'idx' => $subid, 'iee' => $studentIdx]);
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$classtotal=$query5->rowcount();

foreach($results5 as $result6){

    
    $midMarks=$result6->marks;
      
       
}


?>


<td style="text-align: center"><?php echo htmlentities($midMarks);?></td>

<?php 

  if($midMarks){
      $graTotal=$grTotal;
  } else{
      $graTotal=" ";
  }

?>
<td style="text-align: center"><?php echo htmlentities($graTotal);?></td>

<?php

if($midMarks){

$comment="null";



if($midMarks < $belowaverage){
    $comment="Below Average";
} else if($midMarks >= $belowaverage && $midMarks <= $average){
    $comment="Average";
} else if($midMarks >= $average && $midMarks <= $good){
    $comment="Good";
    
} else if($midMarks >= $good && $midMarks <= $vg){
    $comment="Very Good";
    
} else{
    $comment="Excellent";
    
}

} else{
    $comment=" ";
}



?>

<td style="text-align: center"><?php echo htmlentities($comment);?></td>


<td style="text-align: center"><?php echo htmlentities($totalmarks=$result->marks);?></td>
<td style="text-align: center"><?php echo htmlentities($grTotal);?></td>
<td style="text-align: center"><?php echo htmlentities($avgTotal);?></td>


<?php

$comment="null";

if($totalmarks < $belowaverage){
    $comment="Below Average";
} else if($totalmarks >= $belowaverage && $totalmarks <= $average){
    $comment="Average";
} else if($totalmarks >= $average && $totalmarks <= $good){
    $comment="Good";
    
} else if($totalmarks >= $good && $totalmarks <= $vg){
    $comment="Very Good";
    
} else{
    $comment="Excellent";
    
}

?>

<td style="text-align: center"><?php echo htmlentities($comment);?></td>

                                                		</tr>
<?php 
$totlcount+=$totalmarks;
$cnt++;}
?>
<tr>
<th scope="row" colspan="2" style="text-align: center">Total Marks</th>

<td style="text-align: center"><b><?php echo htmlentities($mtMarkObtain); ?></b> </td>
<td style="text-align: center"><b><?php echo htmlentities($mtTotal); ?></b></td>
<td style="text-align: center"><b><?php echo htmlentities(); ?></b></td>

<td style="text-align: center"><b><?php echo htmlentities($totlcount); ?></b> </td>
<td style="text-align: center"><b><?php echo htmlentities($outof=($cnt-1)*100); ?></b></td>
                                                        </tr>

                                                       

<tr>
<th scope="row" colspan="2" style="text-align: center">Percentage</th>

<?php
    
    $midTotal=round((($mtMarkObtain/$mtTotal) * 100),2);
    $finalTotal=round((($mtTotal/$mtTotal) * 100),2);

    
    $notvalue=is_nan($midTotal);
    $notvalue2=is_nan($finalTotal);

    
    if($notvalue){
        $midObtained=" ";
    } else{
        $midObtained=$midTotal ."%";
    }

    if($notvalue2){
        $midTotalPercent=" ";
    } else{
        $midTotalPercent=$finalTotal ."%";
    }


?>

<td style="text-align: center"><b><?php echo  htmlentities($midObtained); ?> </b></td>
<td style="text-align: center"><b><?php echo  htmlentities($midTotalPercent); $percent=$totlcount*(100)/$outof; ?> </b></td>
<th scope="row" style="text-align: center" ><?php echo htmlentities();?></th>

<td style="text-align: center"><b><?php echo  htmlentities(round($totlcount*(100)/$outof, 2)); $percent=$totlcount*(100)/$outof; ?> %</b></td>
<td style="text-align: center"><b><?php echo  htmlentities(round(100, 2)); $percent=$totlcount*(100)/$outof; ?> %</b></td>
</tr>

<!-- new addition starts here -->



<?php
$sql = "SELECT meritlist.StudentName,meritlist.UserName,meritlist.Total,meritlist.CurrentStatus,meritlist.MarkObtained from meritlist WHERE ClassId=:class ORDER BY MarkObtained DESC";
$query = $dbh->prepare($sql);
$query->execute(['class' => $classid]);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnts=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   
    $stnumber=$result->UserName;
    if($rollid == $stnumber){
        $test= $cnts;
        break;
    }

    $cnts =$cnts + 1;

}


$sql = "SELECT midmeritlist.StudentName,midmeritlist.UserName,midmeritlist.Total,midmeritlist.CurrentStatus,midmeritlist.MarkObtained from midmeritlist WHERE ClassId=:class ORDER BY MarkObtained DESC";
$query = $dbh->prepare($sql);
$query->execute(['class' => $classid]);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$counts=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   
    $stnumber=$result->UserName;
    if($rollid == $stnumber){
        $midterm= $counts;
        break;
    }

    $counts =$counts + 1;

}
}

?>

<tr>
<th scope="row" colspan="2" style="text-align: center">Position in Class</th> 

<td colspan="3" style="text-align: center"><b><?php echo  htmlentities($midterm); ?> </b></td>
<td colspan="4" style="text-align: center"><b><?php echo  htmlentities($test); ?> </b></td>
</tr>
<?php } ?>
 
                              
<td colspan="9" align="center"><i class="fa fa-print fa-2x" aria-hidden="true" style="cursor:pointer" OnClick="CallPrint(this.value)" ></i></td>
        </tr> 


 <?php } else { ?>     
<div class="alert alert-warning left-icon-alert" role="alert">
                                            <strong>Your results have not been published yet!</strong> 
 <?php }
?>
                                        </div>
 <?php 
 } else
 {?>

<div class="alert alert-danger left-icon-alert" role="alert">
<strong>Sorry!</strong>
<?php
echo htmlentities("Invalid Student Number");
 }
?>
                                        </div>



                                                	</tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="form-group">
                                                           
                                                      
                                                        </div>


                              </div>
                                <!-- /.row -->
  
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->
                                                
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

        <script>
            $(function($) {

            });


            function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

        </script>

        </div>
        <footer class="footer">

           <p>Copyright &copy; 2020; All Rights Reserved</p>

        </footer>
    </body>
</html>
<?PHP } ?>
