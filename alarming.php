<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  $id = $_SESSION['id'];
  $p_id = $_GET['id'];
  $sql = "select * from alarm where p_id = ?";
  $stmt = $conn ->prepare($sql);
  $stmt->execute([$p_id]);

  $ss = $stmt->fetchAll();
  $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $users = $stmts->fetch();

  $sql1 = "select * from patients where id = ?";
  $stmt1 = $conn ->prepare($sql1);
  $stmt1->execute([$p_id]);
  $patient = $stmt1->fetch();

  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Alarming Symptoms</title>
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
overflow-y: scroll;
border-radius: 20px;
}
.myBox_medic {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 90%;
height: 100vh ;
overflow-y: scroll;
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
   width: 49%;
   height: 10%;
   font-size: 1.2vw;

}
.alarm_btn{

margin-bottom: 5%;
margin-top: 10%;
padding: 3% 6%;
border-radius: 10px;
background-color: #e6e6ff;
font-size: 1.5vw;
border-color:  #e6e6ff;
color: black;
}
.alarm_btn:hover{
  background-color: white;
}
.alarm_btn1{

margin-bottom: 5%;
margin-top: 10%;
padding: 3% 4.2%;
border-radius: 10px;
background-color: #e6e6ff;
font-size: 1.5vw;
border-color:  #e6e6ff;
border-bottom-color: #e6e6ff;
color: black;
}
.alarm_btn1:hover{
  background-color: white;
}


p{
  font-size: 1vw;
}
#d_p{
  margin-left: 43%;
  background-color: Transparent;
   outline: none;
     color: red;
     font-size: 1.5vw;
     border-color:#f2f2f2 ;
}
#d_p:hover{
  font-size: 2vw;
}

#med_textarea{
  resize: none;
  margin-left: 2%;
  margin-right: 5%;
  background-color:#ffffff;
  font-size: 1.3vw;
  padding: 1%;
  border-style: double;
  text-align: justify;
  border-radius: 20px;
}
#med_form{
  width: 50%;
  
  font-size: 1vw;
  padding: 1%;
  margin-left: 2%;
  border-bottom-style: solid;
  border-bottom-color:  black;
  border-top-style: hidden;
   border-right-style: hidden;
  border-left-style: hidden;
  background-color: #e6f2ff;
  border-radius: 10px;
}

#btn_p_info{
  margin-left: 30%;
  margin-top: 20%;
  font-size: 1vw;
  border-radius: 10px;
  background-color:  #e6e6ff;
  padding: 2% 10%;
  border-color:#e6e6ff;
  width: 15.5vw;
  color: black;
}
#btn_p_info:hover{
  background-color: white;
}
</style>


</head>
<body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">
<img style="" id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $users['fname'];  ?></p>
    <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h3 style="margin-left: 15%;font-size: 1.5vw;"><?php echo $patient['fname']; ?></h3>   
   <div class="myBox" style="border-radius: 20px;width: 70%; height: 65vh; margin-left: 15%;background-color: #e6f2ff;font-size: 20px;">
    <?php
$query1 = "SELECT * FROM alarm WHERE p_id = ? AND symptom = ? ";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute([$p_id,"--"]);
        $user1 = $stmt1->fetch();
    
    $count1 = $stmt1->rowCount();
        $count = $stmt->rowCount();
        if ($count > 0 && $count1!=1) {?>
      <div style="background-color: #e6f2ff;margin:1% 3%;height: 60vh;border-radius: 20px;">
        
        <div class="myBox_medic" style="width: 100%; height: 35vh; ">
        <?php 
        foreach ($ss as $s) {
          echo '<div class="med_manage">
          <a href="symptom.php?id='.$p_id.'&s_id='.$s['id'].'" style="color : #0066ff;">'.$s['symptom'].'</a>
        </div>
        <div class ="med_manage" align="right">
           &nbsp;&nbsp;
                <a href="delete_alarm.php?p_id='.$p_id.'&a='.$s['id'].'" style="border-color: #e6f2ff;background-color: #e6f2ff;" class="confirmation">
                <img   src="img\delete.png" width="30" height="20"></a>
          
        </div>
        <hr>';

         } 
      ?>


        </div>
        
        <div style="margin-top: 10%">
        <span id="p_span_info">
         
        </span>
        <span id="p_span_info">
          
        </span> 
        <span id="p_span_info">
            <?php
            echo '<a id="btn_p_info" href="add_alarm.php?id='.$p_id.'">Add new Symptom</a>';
          ?>
        </span> 
      </div>

      </div>
    <?php
        }
        else{
        ?>
              <div style="background-color: #e6f2ff;margin:1% 3%;height: 60vh;border-radius: 20px;">
        
    
        
        <div style="margin-top: 10%">
          <br><br><br>
        <span id="p_span_info">
         
        </span>
        <span id="p_span_info">
          
        </span> 
        <span id="p_span_info">
            <?php
            echo '<a id="btn_p_info" href="add_alarm.php?id='.$p_id.'">Add new Symptom</a>';
          ?>
        </span> 
      </div>

      </div>
      <?php
        }
        
        ?>

   </div>
        <div style="color:red">
            <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
                  if ($_GET['msg'] == 'delete') echo '<script>alert("symptom deleted successfully")</script>';
                  elseif ($_GET['msg'] == 'add') echo '<script>alert("symptom added successfully")</script>';
                  
                }
            ?>
        </div>
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
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