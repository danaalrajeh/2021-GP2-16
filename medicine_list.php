<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{
    $id = $_SESSION['id'];
    $sql = "select * from users where id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    $sql1 = "select * from medication";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $med = $stmt1->fetchAll();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Medications List </title>
        <link rel="stylesheet" href="nav_bar.css">
        <style>
            #c_a{

                height: 660px;
                min-width: 70%;
                background-color: #FBFCFC;
                border-radius: 50px;
                margin-left:2%;
                margin-right: 2%;
            }
            #nav_bar{
                padding-right:  5%;
            }
            #btn{

                padding: 12px 50px;
                margin-top: 2%;
                margin-left: 2%;
                font-size: 1vw;
                background-color: #ff6666;
                border-radius: 10px;
                border-color: #ffffff;
                float: right;
            }
            #btn_h{

                padding: 12px 50px;
                margin-top: 2%;
                margin-left: 2%;
                font-size: 1vw;
                background-color: #ffffff;
                border-radius: 10px;
                border-color: #ffffff;
                float: right;
            }
            #btn_nav{

                padding: 12px 50px;
                position: relative;
                top: 10%;
                left: 33%;
                font-size: 2.5vw;
                background-color: #e6e6e6;
                border-radius: 10px;
                border-color: #ffffff;
                text-align: center;
                width: 35%;
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
                width: 39%;
                height: 100%;
                margin-left: 4%;
            }
            #p_span1{
                display: inline-block;
                width: 19%;
                margin-left: 28%;
                height: 100%;
            }
            #p_span_img{
                display: inline-block;
                width: 49%;
                height: 100%;
                padding-top: 6%;
                text-align: right;
                vertical-align:top;
            }
            #d_p{
                text-decoration: none;
                color: red;
                font-size: 1.5vw;
                margin-left: 55%;
            }
            #d_p:hover{
                font-size: 2vw;
            }
            #p_a{
                font-size: 1.5vw;
            }

            #a_p{
                margin-left: 40%;
                margin-top: 20%;
                margin-bottom: 5%;
                padding: 1% 3%;
                border-radius: 10px;
                background-color: #e6e6ff;
                font-size: 1vw;
                border-color:  #e6e6ff;
            }
            #a_p:hover{
                background-color: white;
            }


        </style>


    </head>
    <body style="background-color: #ADD8E6;margin-top: 0;margin-bottom: 0;">


    <div id="c_a">
        <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
        <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>



        <h1 style="margin-left: 15%;">Medications List: </h1>
        <div class="myBox" style="width: 70%; height: 60vh; overflow-y: scroll;margin-left: 15%;background-color: #f2f2f2;font-size: 20px;">
            <?php
            foreach ($med as $m) {
                echo '<div>
        <span id="p_span">
          <a id="p_a" href="medicine_info.php?id='.$m['id'].'" style="margin-left: 15%;color: #0044cc;"><strong> '.$m['med_name'].'</strong></a>
        </span>
        <span id="p_span1">
          <a id="p_a" href="delete_medicine.php?id='.$m['id'].'" class="confirmation" style="margin-left: 15%;color: red;"><strong>Delete</strong></a>
        </span>
      </div>
      <hr width="80%"><br>';
            }

            ?>

            <div>
                <button onclick="window.location.href='add_medicine.php'" id="a_p">Add new medicine</button>
            </div>
        </div>
    </div>
    <div style="color:red">
        <?php
        if(isset($_GET['msg']) && !empty($_GET['msg'])){
            if ($_GET['msg'] == 'error') echo '<script>alert("This medicine already exists")</script>';
            elseif ($_GET['msg'] == 'successful') echo '<script>alert("medicine added successfully")</script>';
        }
        ?>
    </div>
    <script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure you want to delete this medicine?')) e.preventDefault();
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