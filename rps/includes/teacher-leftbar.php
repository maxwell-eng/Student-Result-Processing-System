<?php

session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
        $sql = "SELECT * FROM teachers";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
            foreach($results as $result){
                $teach=$result->TeacherId;

            }
 
           

        }




    }

?>







<div class="left-sidebar bg-black-300 box-shadow " >
                        <div class="sidebar-content">
                            
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class="nav-header">
                                        <span class="">Main Menu</span>
                                    </li>
                                    <li style=color:orange>
                                        <a href="teacher-dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
                                     
                                    </li>

                                    <li class="nav-header" >
                                        <span class="">More Options</span>
                                    </li>

                                    <li class="has-children" style=color:orange>
                                        <a href="#"><i class="fa fa-file-text"></i> <span>Attendance</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                             
                                            <li><a href="manage-attendance.php"><i class="fa fa-bars"></i> <span>Attendance</span></a></li>
                                           
                                        </ul>
                                    </li>

                                    <li class="has-children" style=color:orange>
                                        <a href="#"><i class="fa fa-info-circle"></i> <span>Merit List</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            
                                            <li><a href="check-meritlist.php?stid=<?php echo htmlentities($teach); ?>"><i class="fa fa-bars"></i> <span>End of Term Merit List</span></a></li>
                                            <li><a href="check-midmeritlist.php?stid=<?php echo htmlentities($teach); ?>"><i class="fa fa-bars"></i> <span>Mid Term Merit List</span></a></li>
                                           
                                        </ul>
                                    </li>
                                    
   
<li class="has-children" style=color:orange>
                                        <a href="#"><i class="fa fa-info-circle"></i> <span>Results</span> <i class="fa fa-angle-right arrow"></i></a>
                                        <ul class="child-nav">
                                            
                                            <li><a href="manage-results.php?tid=<?php echo htmlentities($teach);?>"><i class="fa fa fa-server"></i> <span>End of Term Results</span></a></li>
                                            <li><a href="manage-midresults.php?tid=<?php echo htmlentities($teach);?>"><i class="fa fa fa-server"></i> <span>Mid Term Results</span></a></li>
                                           
                                        </ul>
                                        <li style=color:orange><a href="change-teacherpassword.php"><i class="fa fa fa-server"></i> <span>Update Password</span></a></li>
                                           
                                    </li>
                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>