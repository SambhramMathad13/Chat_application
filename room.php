<?php 
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
          $room=$_POST['room'];
          $servername="localhost";
          $username="root";
          $password="";
          
          $conn=mysqli_connect($servername,$username,$password,"chat");
          if(!$conn)
          {
            echo"<script language='javascript'>
            alert('Server error please try again...');</script>";
            exit;
          }
          
          session_start();
          // $_SESSION['roomed']=true;
          $_SESSION['room']=$room;

            $sql="SELECT * FROM `chats` WHERE `room`='$room'";
            $res=mysqli_query($conn,$sql);
            $row=mysqli_num_rows($res);
            // echo $row;
            if($row==1)
          {
           
            echo"<script type='text/javascript'>
            alert('Roomname already in use... Please enter other roomname...');</script>";
            header("location: start.php?id=".$room);
              exit;
          }
          else{
            $sql="INSERT INTO `chats` (`room`,`ctime`) VALUES ('$room',current_timestamp())";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
              echo "<script>alert('Room created successfuly ...');</script>";
              echo(" <script> 
              window.location.href='https://myfirstforms.000webhostapp.com/welcome.php?id='.$room; 
               </script>");
              header("location: start.php?id=".$room);
              exit;
            }
          }
        }  
    ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body
        {
        background-image: url(https://wallpaperaccess.com/full/2206441.png);
        }
    </style>
  </head>
  <body>


  <div class="container my-5 col-sm-3 col-lg-3  my-5 bg-transperant mt-5 text-white fw-bold border-1  roundedborder  shadow-lg">
    <div class="formm" class="mb-3 my-5 col-12 text-white" style="margin-top:21vh">

   

      <form name="myForm" action="http://localhost/chat/room.php" 
         method="post" >

        <div class=" mb-3 my-5 col-12 text-white display-4 fw-bold">
          Welcome to chat application 
        </div>


        <div class="mb-3 my-5 col-12 text-white">
          <label for="exampleInputEmail1" class="form-label pt-3">Room name</label>
          <input id="n" type="text" class="form-control fw-bold opacity-75 " id="exampleInputEmail1" name="room" aria-describedby="emailHelp" required>
        </div>
        
        <button type="submit" class="btn btn-primary my-1 col-12 bg-success" onclick="return validateForm()">Create room</button>
      </form>

    </div>
    </div>


    <script>
    function validateForm()
    {
        let x = document.forms["myForm"]["room"].value;
        // let y = document.forms["myForm"]["pass"].value;
        if(x.length<=3 || x.length>=10)
        {
          alert("Room name must be between 3 and 10 characters");
          document.getElementById("n").value ="";
          return false;
        }
        else
        {
          return true;
        }
    }
   </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  </body>
</html>