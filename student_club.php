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
      <a href="#" data-activates="mobile-demo" class="button-collapse " style="margin-left:10px;z-index:0;"><i class="material-icons">menu</i></a>
    <a href="student_home.php" class="brand-logo" style="margin-left:10px;">ECA</a>
    <ul class="right hide-on-med-and-down">
      <li  ><a href="student_home.php">ACTIVITIES</a></li>
      <li class="active"><a href="student_club.php">CLUBS</a></li>
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
        <li class="tab col s3"><a  class="active" href="#test1">ALL CLUBS</a></li>
        <li class="tab col s3 $row = $result->fetch_assoc()"><a href="#test3">JOINED CLUBS</a></li>
      </ul>
    </div>
     <div id="test1" class="col s12">
      <div class="row" style="margin-top:20px;">
        <?php
          $sql="select * from club_master ";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc())
          {
            $flag=0;
            $sql1="select * from clubregister where student_id=".$_SESSION["student_id"]." and club_id=".$row["id"];
            $result1 = $conn->query($sql1);
            if($row1 = $result1->fetch_assoc()){$flag=1;}
          
          
              $color="white";
        ?>
        <div class="col m4 s12">
           <div class="card <?php echo $color; ?>">
           <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" height="300" width="300" src="img/<?php echo $row["image"]; ?>">
          </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4"><?php echo $row["name"] ?><i class="material-icons right">more_vert</i></span>
      <p>Incharge: <?php echo $row["incharge"];?> </p>
      <p class="truncate"><?php echo $row["shortdisc"];?></p>
      <p><a onclick="loadmodal(<?php echo $row["id"].",".$_SESSION["student_id"];?>)">read more</a></p>
    
   
       <?
        if($flag==1){
          $colort="orange darken-3";
       ?>
        <?php if($row1["verified"]==1){ ?>
          <p class="red-text"> VERIFIED </p>
        <?php } else{ ?>
          <p class="green-text">NOT VERIFIED</p>
        <?php } ?>
        </div>
           <div class="card-action <?php echo $colort;?> white-text darken-4" id="<?php echo $row["id"];?>">
        <a class="waves-effect waves-light btn-flat orange darken-4 white-text" style="margin-left:-20px;">
        JOINED
        </a>
        <?php
        }else{
        ?>
        <br>
        </div>
         <div class="card-action" id="<?php echo $row["id"];?>">
        <a class="white-text green darken-3 waves-effect waves-light btn" onclick="register1(<?php echo $_SESSION["student_id"]."," .$row["id"];?>)">JOIN</a>
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
    <div id="test3" class="col s12">
      <div class="row" style="margin-top:20px;">
        <?php
          $sql="select * from club_master";
          $result = $conn->query($sql);
          $flag=0;
          while($row = $result->fetch_assoc())
          {
            $sql1="select * from clubregister where student_id=".$_SESSION["student_id"]." and club_id=".$row["id"];
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
      <p>Incharge: <?php echo $row["incharge"];?> </p>
      <p class="truncate"><?php echo $row["shortdisc"];?></p>
      <p><a href="#activitymodal" onclick="loadmodal2(<?php echo $row["id"]; ?>)">read more</a></p>
      <?php if($row1["verified"]==1){ ?>
          <p class="red-text"> VERIFIED </p>
        <?php } else{ ?>
          <p class="green-text">NOT VERIFIED</p>
        <?php } ?>
    </div>
    <div class="card-action orange darken-3 white-text darken-4" ">
        <a class="waves-effect waves-light btn-flat orange darken-4 white-text" style="margin-left:-20px;">
        JOINED
        </a>
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
  