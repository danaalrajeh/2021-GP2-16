<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $user = $stmts->fetch();
  $id=$_GET['id'];
  $p_id = $_GET['id'];
  $sql1 = "select * from patients where id = ?";
  $stmt1 = $conn ->prepare($sql1);
  $stmt1->execute([$p_id]);
  $patient = $stmt1->fetch();
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Medications</title>
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

#p_span_info{
   display: inline-block;
   width: 30%;
   height: 100%;

}
#btn_p_info{
  margin-left: 30%;
  margin-top: 5%;
  font-size: 1vw;
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
#med_form{
  width: 50%;
  
  font-size: 1vw;
  padding: 1%;
  margin-left: 5%;
  border-bottom-style: solid;
  border-bottom-color:  #cccccc;
  border-top-style: hidden;
   border-right-style: hidden;
  border-left-style: hidden;
  background-color: #e6f2ff;
  border-radius: 10px;
}
#med_form1{
  width: 80%;
  height: 20%;
  padding: 12px 0px;
  font-size: 1.5vw;
  margin-left: 5%;
  background-color: #e6f2ff;
  border-style: solid;
  border-radius: 10px;
}
#med_form:hover{
  /*font-size: 2vw;*/
}
.med_textarea{
  resize: none;
  margin-left: 5%;
  margin-right: 5%;
  background-color:#e6f2ff;
  font-size: 1vw;
  padding: 1%;
  font-weight: bold;
  border-style: double;
  text-align: justify;
  width: 80%;
  border-radius: 10px;

}

#s_b{
  margin-top: 1%;
  margin-left: 40%;
  margin-right: 10%;margin-bottom: 5%;
  padding: 1% 3%;
  border-radius: 10px;
  background-color: #e6e6ff;
  font-size: 1vw;
  border-color:  #e6e6ff;
}
#s_b:hover{
  background-color: white;
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
<body style="background-color: #ffffff ;margin-top: 0;margin-bottom: 0;">
  <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
  <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h3 style="margin-left: 15%;font-size: 1vw;"><?php echo $patient['fname']; ?></h3>   
   <div class="myBox" style="width: 70%; height: 70vh; margin-left: 15%;background-color: #e6f2ff ;font-size: 20px;">
        <form action="add_medication_in.php" method="post">
          <input type="hidden" name="id" value="<?= !empty($id) ? $id: '' ?>">
          <label style="margin-left: 5%;color: #191970;" class="required">Medicine Name</label><br>
            <?php
            $stms = $conn->prepare('SELECT * FROM medication');
            $stms->execute();
            ?>
            <select class="med_textarea" name="m_name" onchange="getdescrip(this.value)" required>
                <option selected>select medication</option>
                <?php foreach ($stms as $stm){ ?>
                <option value="<?php echo $stm['med_name']; ?>"><?php echo $stm['med_name']; ?></option>
                <?php } ?>
            </select><br>
        <label style="margin-left: 5%;color: #191970;" class="required">Description</label><br>
            <textarea  id="med_textarea" class="med_textarea" name="des"  placeholder="Enter Descrption" required></textarea>

        <label style="margin-left: 5%;color: #191970;" class="required">Dose</label><br>
         <input class="med_textarea" type="text" name="dose"  placeholder="Enter Dose" required>
         <label style="margin-left: 5%;color: #191970;" class="required">Time</label><br>
         <input class="med_textarea" type="text" name="time"  placeholder="Enter time" required>
         <label style="margin-left: 5%;color: #191970;" class="required">Precautions</label><br>
         <input class="med_textarea" type="text" name="precautions"  placeholder="Enter precautions" required>
        <button id="s_b" type="submit" >add medicine</button>
        </form>  

       <script>
           function getdescrip(str) {
                   var xmlhttp = new XMLHttpRequest();
                   xmlhttp.onreadystatechange = function() {
                       if (this.readyState == 4 && this.status == 200) {
                           console.log(xmlhttp.responseText);
                           document.getElementById("med_textarea").value = this.responseText;
                       }
                   };
                   xmlhttp.open("GET","getmed.php?med_name="+str,true);
                   xmlhttp.send();
           }
       </script>


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