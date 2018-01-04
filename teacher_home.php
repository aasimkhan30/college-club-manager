<?php
	include 'include/db_connect.php';
	session_start();
	 date_default_timezone_set('Asia/Kolkata');
	if(!isset($_SESSION["teacher_id"]))
		header("Location:teacher_login.php");
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
var studentid;
  function loadmodal1(v,sid){
  	studentid=sid;
  	 $.ajax({
              type:"POST",
              url:"activitymodalapi.php",
              dataType:"json",
              data:{
                id:v
              },
              success:function(data){
              	console.log(data.image);

                $("#title").html("Title: "+data.name);
  				$("#date").html("Date "+data.date);
  				$("#image").attr("src","img/"+data.image);
  				$("#description").text(data.description);
          $("#registerm").text("REGISTER");
  				$("#registerm").attr("onclick","register1("+ studentid+","+  data.id+")");
  				$("")
                }});
  	
  	$('#modal1').openModal();

  }
   function loadmodal2(v,sid){
  	 $.ajax({
              type:"POST",
              url:"activitymodalapi.php",
              dataType:"json",
              data:{
                id:v
              },
              success:function(data){
              	console.log(data);
                $("#title").html("Title: "+data.name);
  				$("#date").html("Date "+data.date);
  				$("#image").attr("src","img/"+data.image);
  				$("#description").text(data.description);
  				$("#registerm").attr("onclick","");
  				$("#registerm").text("REGISTERED");
                }});
  	
  	$('#modal1').openModal();

  }
  function register1(sid1,aid1){
  	console.log(sid1+"/"+aid1);
  		 $.ajax({
              type:"POST",
              url:"student_registerapi.php",
              dataType:"json",
              data:{
                sid:sid1,
                aid:aid1,
              },
              success:function(data){
              	console.log(data);

              	$("#"+aid1).html("REGISTERED");
                }});
  	$('#modal1').closeModal();

   document.location = "student_home.php";

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
      <li  class="active"><a href="student_home.php">ACTIVITIES</a></li>
      <li><a class="waves-effect waves-light btn-large deep-purple darken-4" href="teacher_logout.php" >Logout</a></li>
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
        <li class="tab col s3"><a  class="active" href="#test1">ACTIVITY REQUEST</a></li>
        <li class="tab col s3"><a href="#test2">APPROVED ACTIVITY</a></li>
      </ul>
    </div>
     <div id="test1" class="col s12">
     <div class="row" style="margin-top:20px;">
                         <div class="col s12">
<table>
<tr>
<th>UID</th>
<th>Name</th>
<th>Contact</th>
<th>Payment</th>
</tr>
<?php 
     include 'include/db_connect.php';
       $sql="SELECT c.activity_name as activity,d.club_name as club,c.activity_date as dates,c.activity_id as id
      FROM activity_master c
      INNER JOIN club_master d ON c.club_id = d.id AND activity_verified=0
      INNER JOIN manage_master ON teacher_id = ".$_SESSION["teacher_id"];
      echo $sql;
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
        ?>
          <tr>
          <td><?php echo $row["studentid"] ?></td>
          <td><?php echo $row["studname"] ?></td>
          <td><?php echo $row["studphone"] ?></td>
          <td><?php echo "<button class='btn' onclick='register(".$row["studentid"].",".$_GET["act"].")'>Payment</button"?></td>
          </tr>
        <?php
        }
        
?>

</table>

                         </div>
                         </div>
     
     </div>
    <div id="test4" class="col s12">
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
      <img id="image" src="test.img" width="100px" height="100px">
      <p id="description" class="flow-text">A bunch of text</p>
    </div>
    <div class="modal-footer">
     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
      <a href="#!" id="registerm" class="waves-effect waves-green btn-flat green white-text ">REGISTER</a> 
    </div>
  </div>
       
        
           
    </body>
    
  </html>
  