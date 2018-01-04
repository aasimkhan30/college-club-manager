<?php
   include 'include/db_connect.php';
   session_start();
    date_default_timezone_set('Asia/Kolkata');
   if(!isset($_SESSION["club_id"]))
    header("Location:club_login.php");
?>
<html>
<head>
	 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
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

	<script type="text/javascript">
		function register(id,club){
      console.log("Hello"+id + ""+club);
             $.ajax({
                       type:"GET",
                       url:"payment.php",
                       dataType:"json",
                       data:{
                         id:id,
                         club:club
                       },
                       success:function(data){
                        	console.log("done");
                          window.location=activity_manager.php;
                    }});
           }
	</script>
	 <title>Manage Participation | ECA </title>
</head>
<body>
<nav >
         <div class="nav-wrapper orange darken-3" >
            <a href="student_home.php" class="brand-logo" style="margin-left:10px;">ECA</a>
            <ul class="right hide-on-med-and-down">
               <li  ><a href="club_home.php">ACTIVITIES</a></li>
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
                           <li class="tab col s3"><a  class="active" href="#test1">UNPAID REQUEST</a></li>
                           <li class="tab col s3 $row = $result->fetch_assoc()"><a href="#test3">PAID REQUEST</a></li>
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
       $sql="SELECT c.student_id as studentid,d.name as studname,d.phone as studphone
			FROM register_master c
			INNER JOIN student_master d
			ON c.student_id=d.id AND c.activity_id=".$_GET["act"]." AND c.payment= 0";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
        ?>
        	<tr>
        	<td><?php echo $row["studentid"] ?></td>
        	<td><?php echo $row["studname"] ?></td>
        	<td><?php echo $row["studphone"] ?></td>
        	<td><?php echo "<a class='btn' onclick=\"register('".$row["studentid"]."','".$_GET["act"]."')\">Payment</a>"?></td>
        	</tr>
        <?php
        }
        
?>

</table>

                         </div>
                         </div>
                         </div>

                         <div id="test3" class="col s12">
                        <div class="row" style="margin-top:20px;">
                         <div class="col s12">
                         <table>
<tr>
<th>UID</th>
<th>Name</th>
<th>Contact</th>
</tr>
<?php 
	   include 'include/db_connect.php';
       $sql="SELECT c.student_id as studentid,d.name as studname,d.phone as studphone
			FROM register_master c
			INNER JOIN student_master d
			ON c.student_id=d.id AND c.activity_id=".$_GET["act"]." AND c.payment= 1";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
        ?>
        	<tr>
        	<td><?php echo $row["studentid"] ?></td>
        	<td><?php echo $row["studname"] ?></td>
        	<td><?php echo $row["studphone"] ?></td>
        <?php
        }
?>
</table>

                         </div>
                         </div>
                         </div>

</body>
</html>

