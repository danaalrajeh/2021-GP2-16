<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  $id = $_SESSION['id'];
   $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $users = $stmts->fetch();
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>ADD Patients</title>
        <link rel="stylesheet" href="btn.css">
        <!-- comment <link rel="stylesheet" href="nav_bar.css"> -->
<style >

 #add_patient {
  width: 80%;
  height: 10%;
  padding: 6px 0px;
  margin-top: 1%;
     margin-bottom: 2%;
  margin-left: 10%;
  margin-right: 5%;
  font-size: 1vw;
  border-bottom-style: solid;
  border-bottom-color:  #cccccc;
  border-top-style: hidden;
  border-right-style: hidden;
  border-left-style: hidden;
  background-color: #e6f2ff;;
}
.h_font:hover{
  font-size: 2.5;
}
#p_img{
  margin-left: 2%;
  display: inline-block;
  width: 12%;
  height: 17%;
  margin-top: 1px;
  border-radius: 20px;
}
#im_div{
  display: inline;
}
#doc_name{
  display: inline-block;
  font-size: 2vw;
  font-weight: bold; 
}

.logout_b{
    text-decoration: none;
    /*font-family: cursive;*/
  padding: 12px 50px;
  position: relative;
margin-left: 2%;
  margin-top: 2%;
  font-size: 2vw;
  background-color: #191970;
  border-radius: 10px;
  border-color: #ffffff;
  color: white;
}

.logout_b:hover{
    font-size: 2.5vw;
    color:  #ffffff;

}

.home_b{
  text-decoration: none;
  /*font-family: cursive;*/
  font-size: 2vw;
  margin-left: 42%;
  color: #778899;
}

.home_b:hover{
  font-size: 2.5vw;
  color: white;
  background-color: #778899;
   padding: 8px 40px;
   border-radius: 10px;
}


a{
	text-decoration: none;
}
.myBox_add_patient {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 200px;
height: 200px;
border-radius: 20px;
}

/* Scrollbar styles */
::-webkit-scrollbar {
width: 12px;
height: 12px;

}

::-webkit-scrollbar-track {
border: 1px solid yellowgreen;
border-radius: 10px;
border :0;
}

::-webkit-scrollbar-thumb {
background: #cccccc;  
border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
background: #cccccc;  
}

#p_span{
   display: inline-block;
   width: 100%;
   height: 100%;
}


#pat{
  display: none;
  color: red;
  font-size: 1vw;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
  
input[type=number] {
  -moz-appearance: textfield;
}
#a_p{
  margin-left: 70%;
  margin-right: 10% ;
  margin-top: 4%;
  margin-bottom: 5%;
  padding: 1% 5%;
  border-radius: 10px;
  background-color: #e6e6ff;
  font-size: 1vw;
  border-color:  #e6e6ff;
}
#a_p:hover{
  background-color: white;
}
 .required:after {
     content:" *";
     color: red;
 }
 .required{
     margin-left: 10%;
 }
</style>


</head>
<body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">


<div id="c_a">
 <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $users['fname'];  ?></p>
  <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h1 style="margin-left: 15%;">Add Patient Info:</h1>   
   <div class="myBox_add_patient" style="width: 70%; height: 135vh;margin-left: 15%;background-color: #e6f2ff;;font-size: 20px;">
      <div>
        <span id="p_span">
          <form action="add_patient_in.php" method="post">
              <label for="fname" class="required">Full Name</label>
              <input id="add_patient"  type="text" name="fname" placeholder="Full Name" required>
              <label for="birth" class="required">Date of Birth</label>
              <input id="add_patient"   type="Date" name="birth" placeholder="barithday" required>
              <label for="con" class="required">Condition</label>
              <input id="add_patient"  type="text" name="con" placeholder="Condition" required>
              <label for="username" class="required">Username</label>
               <input id="add_patient"   type="text" name="username" placeholder="Username" required>
               <label for="email" class="required">Email</label>
               <input id="add_patient"   type="email" name="email" placeholder="Email" required>
              <label for="password" class="required">Password</label>
              <input id="add_patient"  type="password" name="password" placeholder="Password" required>
              <label for="phone" class="required">Phone Number</label>
              <input id="add_patient"  type="number" name="phone" placeholder="Phone Number" required>
              <label for="phone" class="required">Relative Name</label>
              <input id="add_patient"  type="text" name="rname" placeholder="Relative name" required>
              <label for="phone" class="required">Relative Phone Number</label>
              <input id="add_patient"  type="number" name="rphone" placeholder="Relative phone Number" required>
              <br><p id="pat" align="center">This patient is already in your list</p>
             <button id="a_p" type="submit" >Add Patient</button>
          </form>
          
        </span>
      </div>
     </div>
   </div>
</div>
<div style="color:red">
            <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
                  if ($_GET['msg'] == 'successful') echo '<script>aleart("Patient added successfully")</script>';
              else if ($_GET['msg'] == 'error') echo '<script>
                  var x = document.getElementById("pat");
              x.style.display = "block";
              </script>';
              else if ($_GET['msg'] == 'error_email') echo '<script>aleart("Sorry this email has been used")
              </script>'; 
                }
            ?>
        </div>
<script src="check_required.js"></script>
</body>
</html>
<?php
}
else
{
    echo "error";
    header('Location:index.php');
}
?>