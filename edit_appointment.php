<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  $id = $_SESSION['id'];
  $a_id = $_GET['a_id'];
  $p_id = $_GET['p_id'];
    $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $users = $stmts->fetch();
  $sql = "select * from appointment where p_id= ?";
  $sql = "select * from appointment where id= ?";
  $stmt = $conn ->prepare($sql);
  $stmt->execute([$a_id]);
  $ap = $stmt->fetch();

  $sql1 = "select * from patients where id = ?";
  $stmt1 = $conn ->prepare($sql1);
  $stmt1->execute([$p_id]);
  $patient = $stmt1->fetch();




  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit appointment</title>
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

#p_span_date{
   display: inline-block;
   width: 100%;
   height: 100%;
   padding-top: 6%;
   padding-left: 5%;
   
}
#p_span_time{
   display: inline-block;
   width: 49%;
   height: 100%;
   padding-top: 6%;
   text-align: right; 
   vertical-align:top;
}

#ap_b{
  margin-left: 36%;
  font-size: 1vw;
  border-radius: 10px;
  background-color:  #e6e6ff;
  padding: 2%;
  border-color: #e6e6ff;
}
#ap_b:hover{
  font-size: 1.3vw;
  margin-left: 33%;
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
 <body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">
<img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $users['fname'];  ?></p>
  <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h3 style="margin-left: 15%;font-size: 1.5vw;"><?php echo $patient['fname']; ?></h3>   
   <div class="myBox" style="width: 70%; height: 65vh; margin-left: 15%;background-color:  #e6f2ff;font-size: 20px;">
      <div style="background-color: #ffffff;margin: 3%;height: 55vh;border-radius: 20px;">
        <form action="edit_appointment_in.php" method="post">
        <span id="p_span_date">
          <input type="hidden" name="p_id" value="<?= !empty($p_id) ? $p_id : '' ?>">
          <input type="hidden" name="a_id" value="<?= !empty($a_id) ? $a_id : '' ?>">
          <label><strong style="font-size: 1.5vw;">Date :</strong></label>
          <input type="date" name="date" style="font-size: 1.5vw;" value="<?= !empty($ap['a_date']) ? $ap['a_date'] : '' ?>">
          <label style="margin-left: 35%;font-size: 1.5vw;"><strong>Time :</strong></label>
          <input type="Time" name="time" style="font-size: 1.5vw;" value="<?= !empty($ap['a_time']) ? $ap['a_time'] : '' ?>"><br><br><br><br>
          <button id="ap_b" type="submit" >Save Changes</button>
        </span>

        </form>
      </div>


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