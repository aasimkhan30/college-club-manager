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
        function submit(){
          var name=$("#name").val();
          var short=$("#short").val();
          var date=$("#date").val();
          var site=$("#site").val();
          var disc=$("#disc").val();

          if(name=="" || short=="" || date == "" || site =="" || disc == ""){
             $(".toast").hide();
            Materialize.toast("All Field Are Necessary",5000);
          }
          else{
            if(!/^[a-zA-Z ]+$/.test(name)){
              $(".toast").hide();
               Materialize.toast("Name is not correct",5000);
            }
            else{
                console.log(date);

            var file_data = $('#file').prop('files')[0];  
            var form_data = new FormData();                  
    form_data.append('image', file_data);
    form_data.append('name', name);
    form_data.append('short', short);
    form_data.append('site', site);
    form_data.append('date', date);
       form_data.append('disc', disc);
        form_data.append('id', $("#club").val());                    
    $.ajax({
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    Materialize.toast("Activity Created",5000); // display response from the PHP script, if any
                    setTimeout(function () { location.reload(1); }, 5000);
                }
             });


 
      }
      }
    

             }
      </script>
      <title>Activities | ECA </title>
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
               <li  class="active"><a href="club_home.php">ACTIVITIES</a></li>
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
                           <li class="tab col s3"><a  class="active" href="#test1">ACTIVITY MANAGER</a></li>
                           <li class="tab col s3"><a href="#test4">CREATE ACTIVITY</a></li>
                        </ul>
                     </div>
                     <div id="test1" class="col s12">
                        <div class="row" style="margin-top:20px;">
                        <div class="col s12">
                      
                         <table>
                            <thead>
                                 <tr>
                                    <th data-field="Name">Activity Name</th>
                                    <th data-field="Date">Date</th>
                                    <th data-field="Manage">Manage</th>
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
                                  <td><?php  echo "<a class='btn' href='activity_manager.php?act=".$row["id"]."'>Manage Registrations</a>" ?></td>
                                </tr>
                              <?php
                                }

                              ?>
                              </tbody>
                            </table>
                          
                          </div>
                        </div>
                     </div>
                     <div id="test4" class="col s12">
                        <div class="row" style="margin-top:20px;">
                          <div class="col s12">
                             <div class="row">
        <div class="input-field col s6">
          <input id="name" type="text" class="validate">
          <label for="icon_prefix">Name</label>
        </div>
        <div class="input-field col s6">
          <input id="short" type="tel" class="validate">
          <label for="icon_telephone">Short Discription</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s6">
<input type="date" class="datepicker" id="date">
          <label for="date">Date</label>
         
        </div>
        <div class="input-field col s6">
          <input id="site" type="tel" class="validate">
          <label for="icon_telephone">Site</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s6">
         
            <textarea id="disc" class="materialize-textarea"></textarea>
          <label for="textarea1">Discription</label>
        </div>
      </div>

       <div class="row">
       <h6>Activity Image</h6>
        <div class="input-field col s6">
          <input id="file" type="file" class="validate">
        </div>
      </div>
      <input type="hidden" id= "club" value=" <?php echo $_SESSION["club_id"]; ?>">
      <a class="waves-effect waves-light btn" onclick="submit()" >Create Activity</a>
                          
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <!-- Modal Structure -->
      <div id="modal2" class="modal modal-fixed-footer">
         <div class="modal-content">
            <h4 id="title">Test Title</h4>
            <h4 id="date"></h4>
            <img id="image" src="test.img" width="100px" height="100px">
            <p id="description" class="flow-text">A bunch of text</p>
         </div>
         <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
            <a href="#!" id="registerm" class="waves-effect waves-green btn-flat green white-text " onclick="submit()">REGISTER</a> 
         </div>
      </div>
   </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
      $('select').material_select();
      $('.slider').slider({
         full_width: true,
         interval: 5000,
         height: 300,
         transition: 800
      });
      $('.datepicker').pickadate({
         selectMonths: true, // Creates a dropdown to control month
         selectYears: 100, // Creates a dropdown of 15 years to control year
         format:'dd-mm-yyyy'
      });

   });
</script>