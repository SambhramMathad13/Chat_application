<?php 
$room=$_POST['room'];
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, "chat");
if (!$conn) {
    echo "<script language='javascript'>
  alert('Server error please try again...');</script>";
    exit;
} else {
    $res="";
   $sql="SELECT msg,ctime,ip FROM history WHERE room = '$room'";
    $ress = mysqli_query($conn, $sql);
    if(mysqli_num_rows($ress)>0)
    {
        while($row = mysqli_fetch_assoc($ress))
        {
            $c=0;
            $ipp=$_SERVER['REMOTE_ADDR'];
            if($row['ip']==$ipp)
            {
                // right
                $res=$res.'<div class="container" style="background-color:transparent;
                border: none;
                border-radius:10px;
                padding:7px;
                margin:5px 0px;">
                <div id="msgg" class="container h6 float-end " style="background-color:transparent;">';
                // $res=$res.$row['ip'];
                $res=$res."<div class='text-light'>".$row['msg'];
                $res=$res.'</div><span class="time-right ">'.$row['ctime']."</span></div></div>";         
           }
            else{
                //left
                $res=$res.'<div id="msgg" class="container darker h6 text-dark" class="sound">';
                // $res=$res.$row['ip'];
                $res=$res."<div  class='sound'>".$row['msg'];
                $res=$res.'</div><span class="time-left">'.$row['ctime']."</span></div>";

            }
        }
    }
    echo $res;   
}
