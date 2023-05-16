<?php
session_start();
$room = $_SESSION['room'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="script" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js">

    <link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
            padding: 0 20px;
            background-image: url(https://wallpaperaccess.com/full/2206441.png);
        }

        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }

        #con {
            background-color: black;
            overflow-y: scroll;
            height: 69vh;

        }

        #msgg {
            /* background-color: black; */
            word-wrap: break-word;
            width: fit-content;
            max-width: 40vw;
        }
    </style>
</head>

<body>
    <div id="chat">

        <h2 class="mt-5 lead-3">Chat Messages for <?php echo "$room" ?></h2>
        <div class="container mt-5" id="con">

        </div>

        <div class="msg-bottom">

            <div class="input-group">
                <input type="text" id="msg" class="form-control" placeholder="Write message..." name="msg" required>
                <button onclick="myFunction()" class="btn btn-info" id="scroll"><i class="fa-solid fa-angles-down fa-bounce "></i></button>
                <button class="btn btn-lg btn-primary" id="btn"><i class="fa-regular fa-paper-plane fa-bounce"></i></button>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>

    <script>
        // $( document ).ready(function() {
        setInterval(fetchh, 1000);

        function fetchh() {

            $.post("get_all.php", {

                    room: '<?php echo $room; ?>'
                },
                function(data, status) {
                    // console.log(data);
                    document.getElementById('con').innerHTML = data;

                });
           

        }

        var input = document.getElementById("msg");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("btn").click();
            }
        });

        $("#btn").click(function() {
            // document.querySelector("#con").scrollTo(0,document.querySelector("#con").scrollHeight);
            let msg = $("#msg").val();
            $.post("chatt.php", {
                    text: msg,
                    room: '<?php echo $room; ?>',
                    ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>'
                },
                function(data, status) {
                    // console.log(data);
                    document.getElementById('con').innerHTML = data;
                    $("#msg").val("");
                    return false;
                });
        });
        // });
        function myFunction() {
            // console.log("scroll");
            document.querySelector("#con").scrollTo(0, document.querySelector("#con").scrollHeight);
        }

    </script>
</body>

</html>