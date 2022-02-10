


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
  <link rel="stylesheet" href="style.css">

<style >

	#title1{

		
    padding-top: 10%;

	}



#log_a_login{
  color:  #cccccc;
  padding-bottom: 13%;
  display: block;
}

#sig_a{
  display: none;
}

a{
	text-decoration: none;
}
#btn_create2{

padding: 12px 50px;
margin-left: 45%;
font-size: 1vw;
background-color: #4682B4;
border-radius: 10px;
border-color: #ffffff;
color: #FDFEFE;
}
#btn_create2:hover{
font-size: 1vw;

background-color: #B0C4DE;
}
     .required:after {
         content:" *";
         color: red;
     }
     .required{
         margin-left: 20%;
     }
</style>


</head>
<body style="background-color: #ADD8E6;margin: 0px;padding: 0px;">


<div id="c_a_log" style="height: 700px;">
	<h1 align="center" id="title1">Login</h1>
	<form action="login_process.php" method="post">
        <label for="email" class="required">Email:</label><br><br>
		<input class="acc_email"  type="email" name="email" placeholder="Email Address" required><br><br>
        <label for="pwd" class="required">Password:</label><br><br>
		<input  class="acc_password" type="password" name="pwd" placeholder="Password" required><br><br>

    <br><br><br>

                <button  id="btn_create2" onclick="sbmt()">Login</button><h4 align="center"><a href="reset_password.php">Forget Password?</a></h4><br>
        </form><br>
        
	<p align="center" id="log_a_login">Don't have an Account? <a href="create_accuont.php"> &nbsp;Sign up</a></p>
  <p id="sig_a" align="center" style="margin-top: -145px;">Oops! one of the credentials is incorrect, please try again or <a href="create_accuont.php" style="color: #D8200D;">Sign up</a> if you haven't registered</p>
</div>

<div style="color:red">
            <?php
                if(isset($_GET['message']) && !empty($_GET['message'])){
                  if ($_GET['message'] == 'error') echo '<script>
                        var x = document.getElementById("sig_a");
                        var y = document.getElementById("log_a");
                        x.style.display = "block";
                        y.style.display = "none";
                  </script>';
              else if ($_GET['message'] == 'empty') echo '<script>alert("please enter email and password")</script>';

                  
                }
            ?>
        </div>
<script src="check_required.js"></script>
</body>
</html>
