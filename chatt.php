<?php 
        $msg = $_POST['text'];
        $room = $_POST['room'];
        $ip = $_POST['ip'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        if($msg=="")
        {
          echo "<script language='javascript'>
          alert('Please write a message...');</script>";
        }
        else{

        $conn = mysqli_connect($servername, $username, $password, "chat");
        if (!$conn) {
            echo "<script language='javascript'>
          alert('Server error please try again...');</script>";
            exit;
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
            $sql = "INSERT INTO `history` (`room`,`msg`,`ctime`,`ip`) VALUES ('$room','$msg',current_timestamp(),'$ip')";
            $res = mysqli_query($conn, $sql);
            $ipp=$_SERVER['REMOTE_ADDR'];
    }
  }

?>
