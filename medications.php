<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  if (isset($_GET['id'])) {
  $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $user = $stmts->fetch();
  $id = $_GET['id'];
  $sql = "select * from prescription  where p_id = ?";
  $stmt = $conn ->prepare($sql);
  $stmt->execute([$id]);
  $p_m = $stmt->fetchAll();
  $sql1 = "select * from patients where id = ?";
  $stmt1 = $conn ->prepare($sql1);
  $stmt1->execute([$id]);
  $patient = $stmt1->fetch();

  }
 

  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Medications</title>
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
.myBox_medic {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 200px;
height: 200px;
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

#p_span_info{
   display: inline-block;
   width: 30%;
   height: 100%;

}
#btn_p_info{
  margin-left: 30%;
  margin-top: 20%;
  font-size: 1vw;
  border-radius: 10px;
  background-color:  #e6e6ff;
  padding: 4% 10%;
  border-color:#e6e6ff;
  width: 15.5vw;
  color: black;
}
#btn_p_info:hover{
  background-color: white;
}
#medic_span_info{
   display: inline-block;
   width: 30%;
   font-size: 1vw;
   margin-left: 5%;
   align-content: end;

}
.med_manage{
   display: inline-block;
   width: 41%;
   font-size: 0.9vw;
   margin-left: 5%;
}

</style>


</head>
<body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">



    <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
    <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h3 style="margin-left: 15%;font-size: 1.5vw;"><?php echo $patient['fname']; ?></h3>   
   <div class="myBox" style="border-radius: 20px;width: 70%; height: 65vh; margin-left: 15%;background-color: #e6f2ff;font-size: 20px;">
      <div style="background-color: #e6f2ff;margin:1% 3%;height: 60vh;border-radius: 20px;">
        <div class="myBox_medic" style="width: 100%; height: 35vh; ">
        <?php 
        foreach ($p_m as $m) {
          echo '<div class="med_manage">
          <a href="medicine_page.php?m_id='.$m['id'].'"><img  src="img\medication.png" width="35" height="20">'.$m['medication'].'</a>
        </div>
        <div class ="med_manage" align="right">
           <a id="edit_h" href="edit_medicine.php?m_id='.$m['id'].'&id='.$patient['id'].'" style="border-color: #e6f2ff;background-color: #e6f2ff;"><img    src="img\edit.png" width="30" height="20"></a>&nbsp;&nbsp;
                <a href="delete_medication.php?m_id='.$m['id'].'&p_id='.$id.'" style="border-color: #e6f2ff;background-color: #e6f2ff;" class="confirmation"><img   src="img\delete.png" width="30" height="20"></a>
          
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
            echo '<a id="btn_p_info" href="add_medication.php?id='.$id.'">Add new Medicine</a>';
          ?>
        </span> 
      </div>

      </div>


   </div>
   <div style="color:red">
            <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
                  if ($_GET['msg'] == 'successful') echo '<script>alert("Medications has been added successfully")</script>';
                  elseif ($_GET['msg'] == 'edit medications') echo '<script>alert("Medication changed successfully")</script>';

                  
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