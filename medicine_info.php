<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{
    $id = $_GET['id'];
    $ids = $_SESSION['id'];
    $sqls = "select * from users where id = ?";
    $stmts = $conn->prepare($sqls);
    $stmts->execute([$ids]);
    $user = $stmts->fetch();
    $sql = "select * from medication where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$id]);
    $med = $stmt->fetch();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>medicine information </title>

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

            #p_span{
                display: inline-block;
                width: 40%;
                height: 100%;
            }
            #p_span_info{
                display: inline-block;
                width: 30%;
                height: 100%;
            }
            #p_span_info1{
                display: inline-block;
                width: 60%;
                height: 100%;
            }


            #btn_p_info{
                margin-left: 15%;
                margin-top: 10%;
                font-size: 0.9vw;
                border-radius: 10px;
                background-color:  #e6e6ff;
                padding: 4% 25%;
                border-color:#e6e6ff;
                width: 15.5vw;
                color: black;
            }
            #btn_p_info:hover{
                background-color: white;
            }
            p{
                font-size: 1vw;
            }

        </style>


    </head>
    <body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">
    <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
    <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
    <h2 style="margin-left: 15%;"><?php echo $med['med_name']; ?></h2>
    <div class="myBox_add_patient" style="width: 70%; height: 65vh;margin-left: 15%;background-color: #e6f2ff;font-size: 20px;">
        <div>
        <span id="p_span_info">
          <p style="padding-left: 12%;"><strong>Name : </strong></br><?php echo $med['med_name']; ?></p>
        </span>
            <span id="p_span_info">
          <p style="padding-left: 50%;"><strong>Description : </strong> <br><?php echo $med['descrip']; ?></p>
        </span>

        </div>

    </div>
    <div style="color:red">
        <?php
        if(isset($_GET['msg']) && !empty($_GET['msg'])){
            if ($_GET['msg'] == 'edit') echo '<script>alert("Changes has been saved")</script>';


        }
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