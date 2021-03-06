<?php
   include 'include/db_connect.php';
   session_start();
    date_default_timezone_set('Asia/Kolkata');
   if(!isset($_SESSION["club_id"]))
     header("Location:club_login.php");
   ?>
<!-- 
   Things to this in page
   Tab Layout 
   1. Student Registered activities tab1
   2. Student Activity Calendar tab2
   3. Logout navbar
   4. Clubs navbar
   5. Activity Link navbar
   -->
<html>
   <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style type="text/css">
         nav {
         height: 100px;
         line-height: 100px;
         }
      </style>
      <script>
         function loadmodal(v,sid){
            $.ajax({
                     type:"POST",
                     url:"clubmodalapi.php",
                     dataType:"json",
                     data:{
                       id:v
                     },
                     success:function(data){
                       console.log(data);
                       $("#title").html("Title: "+data.name);
                 $("#date").html("Date "+data.date);
                 $("#image").attr("src",data.image);
                 $("#description").text(data.description);
                 $("#registerm").attr("onclick","register1("+data.id+","+sid+")");
                 $("")
                       }});
           
           $('#modal1').openModal();
         
         }
          function loadmodal2(v,sid){
            $.ajax({
                     type:"POST",
                     url:"clubmodalapi.php",
                     dataType:"json",
                     data:{
                       id:v
                     },
                     success:function(data){
                       console.log(data);
                       $("#title").html("Title: "+data.name);
                 $("#date").html("Date "+data.date);
                 $("#image").attr("src",data.image);
                 $("#description").text(data.description);
                 $("#registerm").attr("onclick","");
                 $("#registerm").text("JOINED");
                       }});
           
           $('#modal1').openModal();
         
         }
         function register1(sid1,cid1){
              $.ajax({
                     type:"POST",
                     url:"studentregister2api.php",
                     dataType:"json",
                     data:{
                       sid:sid1,
                       cid:cid1,
                     },
                     success:function(data){
                       console.log(data);
         
                       $("#"+cid1).html("JOINED");
                       }});
           $('#modal1').closeModal();
         }
      </script>
      <title>Clubs | ECA </title>
   </head>
   <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <ul id="dropdown1" class="dropdown-content">
         <li><a href="#!">one</a></li>
         <li><a href="#!">two</a></li>
         <li class="divider"></li>
         <li><a href="#!">three</a></li>
      </ul>
      <nav >
         <div class="nav-wrapper orange darken-3" >
            <a href="student_home.php" class="brand-logo" style="margin-left:10px;">ECA</a>
            <ul class="right hide-on-med-and-down">
               <li  ><a href="club_home.php">ACTIVITIES</a></li>
               <li class="active"><a href="club_membership.php">MEMBERSHIP</a></li>
               <li><a class="waves-effect waves-light btn-large deep-purple darken-4" href="club_logout.php" >Logout</a></li>
            </ul>
         </div>
      </nav>
      <div class="row">
         <div class="col s12">
            <div class="card">
               <div class="row">
                  <div class="col s12">
                     <div class="col s12">
                        <ul class="tabs">
                           <li class="tab col s3"><a  class="active" href="#test1">MEMBERSHIP REQUEST</a></li>
                           <li class="tab col s3 $row = $result->fetch_assoc()"><a href="#test3">MEMBERS</a></li>
                        </ul>
                     </div>
                     <div id="test1" class="col s12">
                        <div class="row" style="margin-top:20px;">
                         <div class="col s12">
                      
                         <table>
                            <thead>
                                 <tr>
                                    <th data-field="Name">Students</th>
                                    <th data-field="Date">Date</th>
                                    <th data-field="Manage">Verify</th>
                                 </tr>
                              </thead>
                              <tbody>
                          <?php 
                              include 'include/db_connect.php';
                            $sql="select * from activity_master  where date > '".date("Y-m-d")."' AND club_id = '".$_SESSION["club_id"]."' order by date";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc())
                              {?>
                                <tr>
                                  <td><?php echo $row["name"] ?></td>
                                  <td><?php  echo $row["date"] ?></td>
                                  <td><?php  echo "<a class='btn' href='activity_manager.php?".$row["id"]."'>Verify</a>" ?></td>
                                </tr>
                              <?php
                                }

                              ?>
                              </tbody>
                            </table>
                          
                          </div>
                        </div>
                     </div>
                     <div id="test3" class="col s12">
                        <div class="row" style="margin-top:20px;">
                         <div class="col s12">
                      
                         <table>
                            <thead>
                                 <tr>
                                    <th data-field="Name">Student Name</th>
                                    <th data-field="Manage">Manage</th>
                                 </tr>
                              </thead>
                              <tbody>
                          <?php 
                              include 'include/db_connect.php';
                            $sql="select * from clubregister  where AND club_id = '".$_SESSION["club_id"]."' order by date";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc())
                              {?>
                                <tr>
                                  <td><?php echo $row["name"] ?></td>
                                  <td><?php  echo "<a class='btn' href='activity_manager.php?".$row["id"]."'>Remove</a>" ?></td>
                                </tr>
                              <?php
                                }

                              ?>
                              </tbody>
                            </table>
                          
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal Structure -->
      <div id="modal1" class="modal modal-fixed-footer">
         <div class="modal-content">
            <h4 id="title">Test Title</h4>
            <h4 id="date"></h4>
            <img id="image" src="test.img">
            <p id="description" class="flow-text">A bunch of text</p>
         </div>
         <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
            <a href="#!" id="registerm" class="waves-effect waves-green btn-flat green white-text ">JOIN</a> 
         </div>
      </div>
   </body>
</html>