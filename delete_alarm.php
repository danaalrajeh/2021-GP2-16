<?php
    include 'connection.php';
    session_start();
    $a_id = $_GET['a'];
    $p_id = $_GET['p_id'];
$flag = 0;
$g=0;
     $query = "SELECT * FROM alarm WHERE p_id = ? ";
        $stmt1 = $conn->prepare($query);
        $stmt1->execute([$p_id]);
        $sy = $stmt1->fetchAll();
foreach ($sy as $kk) {
    if ($flag == 0) {
      $g =  $kk['id'];
    }
    $flag = $flag + 1;
}

if ($a_id == $g) {
    $sql1 = "update alarm set symptom = ? where id = ?";
            $stmt = $conn->prepare($sql1);
            $stmt->execute(["--",$a_id]);
            $msg = "delete";
    header("Location: alarming.php?id=".$p_id."&msg=".$msg);
}
else{
$sql = "delete from alarm where id = ?";
    $stmt = $conn ->prepare($sql);
    $stmt->execute([$a_id]);
    $msg = "delete";
    header("Location: alarming.php?id=".$p_id."&msg=".$msg);
}
    
    ?>