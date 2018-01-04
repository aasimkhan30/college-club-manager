<?php
	include 'include/db_connect.php';
	session_start();
	 date_default_timezone_set('Asia/Kolkata');
	if(!isset($_SESSION["student_id"]))
		header("Location:student_login.php");
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
      <li><a href="student_club.php">CLUBS</a></li>
      <li><a class="waves-effect waves-light btn-large deep-purple darken-4" href="student_logout.php" >Logout</a></li>
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
        <li class="tab col s3"><a  class="active" href="#test1">ACTIVITY  CALENDAR</a></li>
        <li class="tab col s3"><a href="#test4">CLUB ACTIVITIES</a></li>
        <li class="tab col s3"><a href="#test3">REGISTERED ACTIVITIES</a></li>
      </ul>
    </div>
     <div id="test1" class="col s12">
     	<div class="row" style="margin-top:20px;">
     		<?php
           $sql="select * from activity_master  where date > '".date("Y-m-d")."' and verified=1 order by date";
     			$result = $conn->query($sql);
     			while($row = $result->fetch_assoc())
     			{
             $sql1="select * from register_master where student_id=".$_SESSION["student_id"]." and activity_id=".$row["id"];
        $result1 = $conn->query($sql1);
        if($row1 = $result1->fetch_assoc()){
        }
     				$event=strtotime($row["date"]);
     				$today=strtotime(date("Y-m-d"));
     				$datediff = $event - $today;
     				$diff= floor($datediff / (60 * 60 * 24));
     				$color="white";
     				if($diff<10)
     					$color="red lighten-3";
     				else if($diff<20)
     					$color="orange lighten-3";
     				else
     					$color="light-green lighten-3";
     		?>
     		<div class="col m4 s12">
     			 <div class="card <?php echo $color; ?>">
   				 <div class="card-image waves-effect waves-block waves-light">
    				  <img class="activator" height="300" width="300" src="img/<?php echo $row["image"]; ?>">
    			</div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4"><?php echo $row["name"] ?><i class="material-icons right">more_vert</i></span>
      <p>Event Date: <?php echo $row["date"];?> </p>
      <p class="truncate"><?php echo $row["shortdisc"];?></p>
    
     <?php $sql1="select * from register_master where student_id=".$_SESSION["student_id"]." and activity_id=".$row["id"];
        $result1 = $conn->query($sql1);
        if($row1 = $result1->fetch_assoc()){
          $colort="orange darken-3";
       ?>
   <p><a href="#activitymodal" onclick="loadmodal2(<?php echo $row["id"]; ?>)">read more</a></p>
           <?php if($row1["payment"]==1){ ?>
         <span  style="padding:5px; " class="green-text " >PAID </span>
        <?php } else{ ?>
         <span style="padding:5px; " class="red-text ">NOT PAID</span>
        <?php } ?>
        
         </div>
    <div class="card-action <?php echo $colort;?> white-text darken-4" id="<?php echo $row["id"];?>">
      
        <a class="waves-effect waves-light btn-flat orange darken-4 white-text" style="margin-left:-20px;"> REGISTERED </a>
        <?php
        }else{
          $colort="green darken-3"
        ?>
        <p><a href="#activitymodal" onclick="loadmodal1(<?php echo $row["id"]; ?>)">read more</a></p>
        <br>
       
    </div>
        <div class="card-action  white-text darken-4" id="<?php echo $row["id"];?>">
        <a class="white-text green darken-3 waves-effect waves-light btn" onclick="register1(<?php echo $_SESSION["student_id"]."," .$row["id"];?>)">REGISTER</a>
        <?php
    }
        ?>
        </div>
  </div>
            </div>
     		<?php
     		  }
             ?>
     	</div>
     
     </div>
    <div id="test4" class="col s12">
        <div class="row" style="margin-top:20px;">
        <?php
          $sql="select * from activity_master  where club_id in (select club_id from clubregister where student_id=".$_SESSION["student_id"].") and verified=1 and date > '".date("Y-m-d")."' order by date";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc())
          {
            $sql1="select * from register_master where student_id=".$_SESSION["student_id"]." and activity_id=".$row["id"];
        $result1 = $conn->query($sql1);
        if($row1 = $result1->fetch_assoc()){
        }
    
            $event=strtotime($row["date"]);
            $today=strtotime(date("Y-m-d"));
            $datediff = $event - $today;
            $diff= floor($datediff / (60 * 60 * 24));
            $color="white";
            if($diff<10)
              $color="red lighten-3";
            else if($diff<20)
              $color="orange lighten-3";
            else
              $color="light-green lighten-3";
        ?>
        <div class="col m4 s12">
           <div class="card <?php echo $color; ?>">
           <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" height="300" width="300" src="img/<?php echo $row["image"]; ?>">
          </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4"><?php echo $row["name"] ?><i class="material-icons right">more_vert</i></span>
      <p>Event Date: <?php echo $row["date"];?> </p>
      <p class="truncate"><?php echo $row["shortdisc"];?></p>
     
   
       <?php $sql1="select * from register_master where student_id=".$_SESSION["student_id"]." and activity_id=".$row["id"];
        $result1 = $conn->query($sql1);
        if($row1 = $result1->fetch_assoc()){
          $colort="orange darken-4";
       ?>
        <p><a href="#activitymodal" onclick="loadmodal2(<?php echo $row["id"]; ?>)">read more</a></p>
          <?php if($row1["payment"]==1){ ?>
         <span  style="padding:5px; " class="green-text" >PAID </span>
        <?php } else{ ?>
         <span style="padding:5px; " class="red-text ">NOT PAID</span>
        <?php } ?>
         </div>
    <div class="card-action <?php echo $colort;?> white-text darken-4" id="<?php echo $row["id"];?>">
    
        <a class="waves-effect waves-light btn-flat orange darken-4 white-text" style="margin-left:-20px;"> REGISTERED </a>
        <?php
        }else{
          $colort="green darken-4"
        ?>
         <p><a onclick="loadmodal(<?php echo $row["id"].",".$_SESSION["student_id"] ;?>)">read more</a></p>
         <br>
         </div>
         <div class="card-action  white-text darken-4" id="<?php echo $row["id"];?>">
      <a class="white-text green darken-3 waves-effect waves-light btn" onclick="register1(<?php echo $_SESSION["student_id"]."," .$row["id"];?>)">REGISTER</a>
        <?php
    }
        ?>
        </div>
  </div>
            </div>
        <?php
          }
             ?>
     
    </div></div>
    <div id="test3" class="col s12">
    	<div class="row" style="margin-top:20px;">
     		<?php
     			$sql="select * from activity_master  where date > '".date("Y-m-d")."' and verified=1  order by date";
     			$result = $conn->query($sql);
     			$flag=0;
     			while($row = $result->fetch_assoc())
     			{
     				$event=strtotime($row["date"]);
     				$today=strtotime(date("Y-m-d"));
     				$datediff = $event - $today;
     				$diff= floor($datediff / (60 * 60 * 24));
     				$color="white";
     				if($diff<10)
     					$color="red lighten-3";
     				else if($diff<20)
     					$color="orange lighten-3";
     				else
     					$color="light-green lighten-3";
     				$sql1="select * from register_master where student_id=".$_SESSION["student_id"]." and activity_id=".$row["id"];
       	$result1 = $conn->query($sql1);
       	if($row1 = $result1->fetch_assoc()){

     		?>
     		<div class="col m4 s12">
     			 <div class="card <?php echo $color; ?>">
   				 <div class="card-image waves-effect waves-block waves-light">
    				  <img class="activator" height="300" width="300" src="img/<?php echo $row["image"]; ?>">
    			</div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4"><?php echo $row["name"] ?><i class="material-icons right">more_vert</i></span>
      <p>Event Date: <?php echo $row["date"];?> </p>
      <p class="truncate"><?php echo $row["shortdisc"];?></p>
      <p><a href="#activitymodal" onclick="loadmodal2(<?php echo $row["id"]; ?>)">read more</a></p><br>
      <?php if($row1["payment"]==1){ ?>
      	 <span  style="padding:5px; " class="green-text " >PAID </span>
      	<?php } else{ ?>
       	 <span style="padding:5px; " class="red-text ">NOT PAID</span>
      	<?php } ?>
    </div>
    <div class="card-action green darken-4 white-text darken-4">
        REGISTERED
        </div>
  </div>
            </div>
     		<?php
     		$flag=1;
     		  }}
     		   if($flag==0)
          {
            echo "NO ACTIVITIES REGISTERED";
          }
             ?>
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
  