<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="btn.css">
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
margin-left: 43%;
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
#btn_create3{

padding: 12px 50px;
margin-left: 45%;
font-size: 1vw;
background-color: #4682B4;
border-radius: 10px;
border-color: #ffffff;
color: #FDFEFE;
}
#btn_create3:hover{
font-size: 1vw;

background-color: #B0C4DE;
}
</style>


</head>
<body style="background-color: #ADD8E6;margin: 0px;padding: 0px;">

<?php
if(isset($_GET['message'])){

    if($_GET['message'] == 'good'){
echo '<br><div id="c_a_log">
<br><br><br>
<h1 align="center" id="title1">We send the new password to your email  <span style="color : blue;">'.$_GET['email'].'</span></h1><br><br><br><br><br><br>
    <br><br>
            <a href="login.php" id="btn_create2">Return to login page</a><br>
    <br>

</div>';}
elseif($_GET['message'] == 'error'){
    echo '<br><div id="c_a_log">
    <br><br><br>
    <h1 align="center" id="title1">your email address is wrong</h1><br><br><br><br><br><br>
        <br><br>
                <a href="re_enter.php" id="btn_create2">Re-Enter your email</a><br>
        <br>
    
    </div>';}



}
else{
    echo'<div id="c_a_log">

    <h1 align="center" id="title1">Enter your Email to reset your password</h1><br><br><br><br><br><br>
    <form action="reset_pass.php" method="post">
        <input class="acc_email" style="text-align: center;"  type="email" name="email" placeholder="Email Address" required><br><br><br><br>
                <button  id="btn_create3">Send</button><br>
        </form><br>
   
</div>';
}
?>




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
</body>
</html>