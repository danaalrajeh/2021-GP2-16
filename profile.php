<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  $id = $_SESSION['id'];
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
  <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="nav_bar.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style >
	#c_a_h{

    height: 100vh;
    min-width: 70%;
		background-color: #ffffff;
		border-radius: 50px;

    margin-left:2%; 
    margin-right: 2%;
    padding-top: 0px;

	}
	
#logout_btn{

  padding: 12px 50px;
  position: relative;
  left: 50%;
  margin-top: 2%;
  font-size: 1vw;
  background-color: #ff6666;
  border-radius: 10px;
  border-color: #ffffff;
}
#logout_btn :hover{
  background-color: #b30000;
}
#btn_nav{

    padding: 15px 270px;
    position: relative;
    top: 20%;
    left: 25%;
    text-decoration: none;
    color: black;
  font-size: 1.5vw;
  background-color: #e6e6e6;
  border-radius: 10px;
  border-color: #ffffff;
  text-align: center;
  width: 40%;
}
    #btn_nav_2{

        padding: 15px 253px;
        position: relative;
        top: 29%;
        left: 25%;
        text-decoration: none;
        color: black;
        font-size: 1.5vw;
        background-color: #e6e6e6;
        border-radius: 10px;
        border-color: #ffffff;
        text-align: center;
        width: 40%;
    }
    #btn_nav_3{

        padding: 15px 253px;
        position: relative;
        top: 29%;
        left: 25%;
        text-decoration: none;
        color: black;
        font-size: 1.5vw;
        background-color: #e6e6e6;
        border-radius: 10px;
        border-color: #ffffff;
        text-align: center;
        width: 60%;
    }
#btn_nav:hover, #btn_nav_2:hover{
    font-size: 2vw;
}
#btn_nav_3:hover, #btn_nav_2:hover{
    font-size: 2vw;
}


.aaa{
  text-decoration: none;
  padding: 12px 50px;
  position: relative;
  margin-left: 55%;
  margin-top: 2%;
  font-size: 2vw;
  background-color: #191970;
  border-radius: 10px;
  border-color: #ffffff;
  color: white;
}

#p_img{
  margin-left: 2%;
  display: inline-block;
  width: 15%;
  height: 20%;
  margin-top: 1px;
  border-radius: 20px;
}
#im_div{
  display: inline;
}
#doc_name{
  display: inline-block;
  /*font-family: cursive;*/
  font-size: 2vw;
  font-weight: bold; 
}

.aaa:hover{
    /*
    background-color: #B0C4DE;
  font-size: 2vw;
  color:  #ffffff;
  margin-left: 52%;
  */
  font-size: 2.5vw;
    color:  #ffffff;
}
.home_b1{
  text-decoration: none;
  /*font-family: cursive;*/
  font-size: 2vw;
  margin-left: 42%;
  color: #778899;
  padding: 12px 50px;
}
.home_b1:hover{
  font-size: 2vw;
  color: white;
  background-color: #778899;

   border-radius: 10px;
}
.logout_b1{
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
.logout_b1:hover{
    font-size: 2vw;
    color:  #191970;
    background-color: white;

}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 600px;
  border-radius: 10px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #999999;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
  border-radius: 10px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
td{
    width: 49%;
    padding-left: 5%;
}
input{
    margin-top: 6%;
    width: 80%;
    border-style: none;
    border-bottom-style: solid;
    border-bottom-color: #0066ff;
    padding: 1% 4%;
    border-radius: 8px;
    font-size: 20px;
    color: #808080;
}
#update{
    display: none;
}
</style>


</head>
<body style="background-color: #ADD8E6;padding: 0px;margin:0px;">
<?php
        $sql = "select * from users where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();

?>

<div id="c_a_h">
    <img id="p_img" src="img\logo_f.png"  ALIGN="center"><p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
    <a class="home_b1" href="physician_home.php">Home</a><a class="logout_b1"  href="logout.php">Logout</a>
<br><br><br><br>
<div class="card" id="show">
<h1 style="text-align:left;color: #191970;padding: 1% 2%;">Your Information</h1>
<br>
<table style="width : 100%;" >
    <tr>
        <td style="color : #0066ff;font-size: 20px;" align="left">Name</td>
        <td align="left"><p class="title"><?php echo $user['fname']," ",$user['lname']; ?></p></td>
    </tr>
    <tr>
        <td style="color : #0066ff;font-size: 20px;" align="left">Email</td>
        <td align="left"><p class="title"><?php echo $user['email']; ?></p></td>
    </tr>
    
</table>
  
  
  <br>
  <br>
  <p><button onclick="show()">Edit</button></p>
</div>
<div class="card" id="update">
<h1 style="text-align:left;color: #191970;padding: 1% 2%;">Your Information</h1>
<br>
<form action="edit_profile.php" method="post">
    <input type="hidden" name="id" value="<?= !empty($user['id']) ? $user['id'] : '' ?>" >
<table style="width : 100%;" >
    <tr>
        <td style="color : #0066ff;font-size: 20px;" align="left">First Name</td>
        <td align="left"><input type="text" name="fname" value="<?= !empty($user['fname']) ? $user['fname'] : '' ?>" ></td>
    </tr>
    <tr>
        <td style="color : #0066ff;font-size: 20px;" align="left">Last Name</td>
        <td align="left"><input type="text" name="lname" value="<?= !empty($user['lname']) ? $user['lname'] : '' ?>" ></td>
    </tr>
    <tr>
        <td style="color : #0066ff;font-size: 20px;" align="left">Email</td>
        <td align="left"><input type="email" name="email" value="<?= !empty($user['email']) ? $user['email'] : '' ?>" ></td>
    </tr>
    <tr>
        <td style="color : #0066ff;font-size: 20px;" align="left">Password</td>
        <td align="left"><input type="password" name="password" placeholder="New password" ></td>
    </tr>
    
</table>
 
  
  <br>
  <br>
  <p><button type="submit">Update</button></p>
  </form> 
</div>
</div>
<script>
function show() {
  var x = document.getElementById("update");
  var y = document.getElementById("show");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";

  }
}
</script>
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