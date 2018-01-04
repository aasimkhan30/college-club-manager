<?php
session_start();
if(isset($_SESSION["club_id"]))//user already logged in 
	header("Location:club_home.php");
?>
<!--
<htmL>
	<HEAD>
		<TITLE>ECA |Student Login</TITLE>
	</HEAD>
	<body>
		<form action="student_login_connect.php" method="POST">
		   <input type="text" id="usename" name="username">
		   <input type="password" id="password" name="password">
		   <input type="submit">
		</form>
	</body>
</htmL>
-->


 <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
         <title>Student Login | ECA </title>
    </head>

    <body  style="background:url('img/login_background.jpg'); background-size:cover;  background-repeat: no-repeat;">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <div class="row ">
      <div class="col m4 offset-m8 s12  ">
      <div class="card" style="padding:10px; margin-top:30%;">
      <?php
      if(isset($_SESSION["faliure_message"])){
      	 echo '<div class="card center-align red white-text" style="padding:5px;"><p><span style="font-size:20px;">'.$_SESSION["faliure_message"].'</span></p></div>';
      	 unset($_SESSION["faliure_message"]);
      }
      ?>
      <div class="center-align"><p><span style="font-size:20px;">CLUB LOGIN</span></p></div>
      <div class="row">
        <form action="club_login_connect.php" method="POST">
        <div class="input-field col s12">
          <input placeholder="username" id="username" name="username" type="text" class="validate">
          <label for="first_name">USERNAME</label>
        </div>
        <div class="input-field col s12">
          <input id="password" placeholder="password" type="password" name="password" class="validate">
          <label for="last_name">PASSWORD</label>
        </div>
        
        <div class="col s12">
        	<button  type="submit"  class="waves-effect waves-light btn green" style="width:100%;">LOGIN</button>
        	</div>
        	
        </div>
        </form>
        </div>
      </div>

      </div>
      </div>
    </body>
  </html>