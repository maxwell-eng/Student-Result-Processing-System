<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    } else{


        $cid=intval($_GET['classid']);
        $sid=intval($_GET['subjectid']);
        $gradingSystem=intval($_GET['class']);

        $attendance=intval($_GET['atte']);

        $endOfTerm=intval($_GET['student']);
        $midTerm=intval($_GET['student2']);


        $scc=intval($_GET['did']);

        $student=intval($_GET['stid']);

        $sccd=intval($_GET['stidx']);


        if($cid){
        $sql="DELETE FROM  classes where id=:cid ";
        $query = $dbh->prepare($sql);

        $query->bindParam(':cid',$cid,PDO::PARAM_STR);
        $query->execute();
        $msg="The class has been deleted";

        header("Location: manage-classes.php");

        }else if($sid){
            
            $subjectname=$_POST['subjectname'];
            $subjectcode=$_POST['subjectcode']; 
            $sql="DELETE FROM  subjects where id=:sid";
            $query = $dbh->prepare($sql);

            $query->bindParam(':sid',$sid,PDO::PARAM_STR);
            $query->execute();
            $msg="Subject Info deleted successfully";

            header("Location: manage-subjects.php");


        } else if($scc){

            $sql="DELETE FROM  subjectcombination where id=:did";
            $query = $dbh->prepare($sql);

            $query->bindParam(':did',$scc,PDO::PARAM_STR);
            $query->execute();
            $msg="Subject Info deleted successfully";

            header("Location: manage-subjectcombination.php");

        } else if($student){
            $sql="DELETE FROM students WHERE StudentId=:stid ";
            $query = $dbh->prepare($sql);

            $query->bindParam(':stid',$student,PDO::PARAM_STR);
            $query->execute();

            $msg="The student has been successfully deleted from the database";

            $sql1="DELETE FROM result WHERE StudentId=:stid ";
            $query1 = $dbh->prepare($sql1);

            $query1->bindParam(':stid',$student,PDO::PARAM_STR);
            $query1->execute();

            $msg="The student has been successfully deleted from the database";


            $sql2="DELETE FROM meritlist WHERE StudentId=:stid ";
            $query2 = $dbh->prepare($sql2);

            $query2->bindParam(':stid',$student,PDO::PARAM_STR);
            $query2->execute();

            $msg="The student has been successfully deleted from the database";

            $sql1="DELETE FROM midresult WHERE StudentId=:stid ";
            $query1 = $dbh->prepare($sql1);

            $query1->bindParam(':stid',$student,PDO::PARAM_STR);
            $query1->execute();

            $msg="The student has been successfully deleted from the database";


            $sql2="DELETE FROM midmeritlist WHERE StudentId=:stid ";
            $query2 = $dbh->prepare($sql2);

            $query2->bindParam(':stid',$student,PDO::PARAM_STR);
            $query2->execute();

            $msg="The student has been successfully deleted from the database";

            $sql3="DELETE FROM attendance WHERE StudentId=:stid ";
            $query3 = $dbh->prepare($sql3);

            $query3->bindParam(':stid',$student,PDO::PARAM_STR);
            $query3->execute();

            $msg="The student has been successfully deleted from the database";

            header("Location: manage-students.php");

        } else if($sccd){
            $sql="DELETE FROM teachers where TeacherId=:stid ";
            $query = $dbh->prepare($sql);

            $query->bindParam(':stid',$sccd,PDO::PARAM_STR);
            $query->execute();

            $msg="The teacher has been successfully deleted from the database";

            header("Location: manage-teachers.php");

        } else if($endOfTerm){
            $sql1="DELETE FROM result WHERE StudentId=:stid ";
            $query1 = $dbh->prepare($sql1);

            $query1->bindParam(':stid',$endOfTerm,PDO::PARAM_STR);
            $query1->execute();

            $msg="The student has been successfully deleted from the database";


            $sql2="DELETE FROM meritlist WHERE StudentId=:stid ";
            $query2 = $dbh->prepare($sql2);

            $query2->bindParam(':stid',$endOfTerm,PDO::PARAM_STR);
            $query2->execute();

            $msg="The student has been successfully deleted from the database";

            header("Location: manage-results.php?tid=1");



        } else if($midTerm){

            $sql1="DELETE FROM midresult WHERE StudentId=:stid ";
            $query1 = $dbh->prepare($sql1);

            $query1->bindParam(':stid',$midTerm,PDO::PARAM_STR);
            $query1->execute();

            $msg="The student has been successfully deleted from the database";


            $sql2="DELETE FROM midmeritlist WHERE StudentId=:stid ";
            $query2 = $dbh->prepare($sql2);

            $query2->bindParam(':stid',$midTerm,PDO::PARAM_STR);
            $query2->execute();

            $msg="The student has been successfully deleted from the database";

            header("Location: manage-midresults.php?tid=1");
            
        } else if($gradingSystem){

            $sql1="DELETE FROM gradingsystem WHERE ClassId=:stid ";
            $query1 = $dbh->prepare($sql1);

            $query1->bindParam(':stid',$gradingSystem,PDO::PARAM_STR);
            $query1->execute();

            $msg="The student has been successfully deleted from the database";
            header("Location: manage-gradingsystem.php");

        } else if($attendance){

            $sql1="DELETE FROM attendance WHERE StudentId=:stid ";
            $query1 = $dbh->prepare($sql1);

            $query1->bindParam(':stid',$attendance,PDO::PARAM_STR);
            $query1->execute();

            $msg="The student has been successfully deleted from the database";
            header("Location: manage-attendance.php");


        }

    }

?>