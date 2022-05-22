<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  if (isset($_GET['m_id'])) {
  $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $user = $stmts->fetch();
  $id = $_GET['m_id'];
  $sql = "select * from prescription  where id = ?";
  $stmt = $conn ->prepare($sql);
  $stmt->execute([$id]);
  $m = $stmt->fetch();
  $sql1 = "select * from patients where id = ?";
  $stmt1 = $conn ->prepare($sql1);
  $stmt1->execute([$m['p_id']]);
  $patient = $stmt1->fetch();

  }
 

  ?>
<!DOCTYPE html>
<html>
<head>
	<title>medications</title>
  <link rel="stylesheet" href="btn.css">
<style >

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
.myBox {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 200px;
height: 200px;
border-radius: 20px;

}

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

#p_span_info{
   display: inline-block;
   width: 30%;
   height: 100%;

}
#btn_p_info{
  margin-left: 30%;
  margin-top: 5%;
  font-size: 1.5vw;
  border-radius: 10px;
  background-color:  #e6e6ff;
  padding: 4%;
  border-color:#e6e6ff;
  width: 15.5vw;
}
#medic_span_info{
   display: inline-block;
   width: 9%;
   height: 100%;

}
#p_span_info1{
   display: inline-block;
   width: 40%;
   height: 100%;
   margin-bottom: 3%;

}
#m_5{
  margin-left: 10%;
  color: #191970;
}
#med_textarea{
  resize: none;
  margin-left: 10%;
  margin-right: 5%;
  background-color:#e6f2ff;
  font-size: 1vw;
  padding: 1%;
  font-weight: bold;
  border-style: double;
  text-align: justify;
  border-radius: 20px;
  
}
</style>


</head>
<body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">



    <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
    <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a></nav>
    <h3 style="margin-left: 15%;font-size: 1.5vw;"><?php echo $patient['fname']; ?></h3>  
   <div class="myBox" style="width: 70%; height: 100vh; margin-left: 15%;background-color: #e6f2ff;font-size: 20px;">
    <?php
    echo '<h2 id="m_5">'.$m['medication'].'</h2>
    <p id="m_5"><strong>Description :</strong> </p>
   
   <textarea id="med_textarea" name="w3review" rows="2" cols="70" readonly>'.$m['descrption'].'</textarea>
  <p id="m_5"><strong>Dose :</strong> </p>
    <textarea id="med_textarea" name="w3review" rows="2" cols="70" readonly>'.$m['dose'].'</textarea>
    <p id="m_5"><strong>Time :</strong> </p>
    <textarea id="med_textarea" name="w3review" rows="2" cols="70" readonly>'.$m['time'].'</textarea>
    <p id="m_5"><strong>Precautions :</strong> </p>
    <textarea id="med_textarea" name="w3review" rows="2" cols="70" readonly>'.$m['precautions'].'</textarea>';

?>
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