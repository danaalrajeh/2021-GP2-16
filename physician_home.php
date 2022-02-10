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
	<title>Physician</title>
  <link rel="stylesheet" href="style.css">
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
#btn_nav:hover, #btn_nav_2:hover{
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
    <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name" style="font-family: none;">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
    
    <a class="aaa" href="logout.php">Logout</a>

    <a href="patients_list.php"  id="btn_nav">Patients</a><br>
    <a href="medicine_list.php"  id="btn_nav_2">Medications</a>

</div>


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