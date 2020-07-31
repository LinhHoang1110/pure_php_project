<?php


    session_start();
    $con = mysqli_connect('localhost','root','root');
    mysqli_select_db($con,'todolist');
    if(isset($_COOKIE['usernamecookie']) && $_COOKIE['passwordcookie'] ){
            $_SESSION['username'] = $_COOKIE['usernamecookie'];
            $usernameCo = $_COOKIE['usernamecookie'];
            $pwCo=$_COOKIE['passwordcookie'];
            $s = "select * from USERS where username = $usernameCo && password = $pwCo";
            $result = mysqli_query($con, $s);

            $num = mysqli_num_rows($result);

            if ($num == 1) {
                header("location: home.php");
                exit;
            }
    }
    else {
        if(!isset($_SESSION['username'])){
            header('location:login.php');
        }

    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ad25b37544.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Home Page</title>
    <style>
        ol,ul {
            margin: 0;
            padding: 0;
        }
        .close {
            font-size: 26px;
        }
    </style>
</head>
<body onload="loadData()">
        <div style="display: flex;justify-content: space-between">
            <span style="width: 10%;" class="addBtn"><a style="text-decoration: none" href="signout.php">Sign out</a></span>
            <span style="width: 10%" class="addBtn"><a style="text-decoration: none"  href="changeTodo.php">Change todo</a></span>
        </div>

        <div id="table">
            <div id="myDIV" class="header">
                <h2 style="margin:5px;color: white;margin-bottom: 30px"><?php   echo strtoupper($_SESSION['username']); ?>'S  TO DO LIST</h2>
                <input type="text" id="myInput" placeholder="Title...">
                <span  onclick="newElement()" class="addBtn">Add</span>
            </div>

            <ul id="myUL">
<!--                <li>Hit the gym</li>-->
            </ul>
        </div>


    <script>


        //GET data
        function loadData(){
            $.ajax({
                url: "controler.php",
                type: "GET",
                data: {
                    action: 'GETDATA'
                },
                success: function (data) {
                    console.log(JSON.parse(data));
                    var todoList = JSON.parse(data).map(item => {
                        return `<li>${item.todo}<span value="${item.id}" class="close">x</span></li>`
                    });
                    var myUL = document.getElementById('myUL');
                    myUL.innerHTML = todoList.join("");

                    var close = document.getElementsByClassName("close");
                    for (let i = 0; i < close.length; i++) {
                        close[i].onclick = function() {
                            var div = this.parentElement;
                            div.style.display = "none";
                            ajaxDelete(close[i].getAttribute("value"));
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }


        // Create a "close" button and append it to each list item
        var myNodelist = document.getElementsByTagName("LI");
        var i;
        for (i = 0; i < myNodelist.length; i++) {
            var span = document.createElement("SPAN");
            var txt = document.createTextNode("\u00D7");
            span.className = "close";
            span.appendChild(txt);
            myNodelist[i].appendChild(span);
        }

        // Click on a close button to hide the current list item

        function ajaxDelete (id) {
                $.ajax({
                    url: "controler.php",
                    type: "POST",
                    data: {
                        action: "DELETEDATA",
                        todo: id
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(err) {
                        console.log(err);
                    }
            })
        }


        var close = document.getElementsByClassName("close");
        for (let i = 0; i < close.length; i++) {
            close[i].onclick = function() {
                var div = this.parentElement;
                div.style.display = "none";
                ajaxDelete();
            }
        }


        // Add a "checked" symbol when clicking on a list item
        var list = document.querySelector('ul');
        list.addEventListener('click', function(ev) {
            if (ev.target.tagName === 'LI') {
                ev.target.classList.toggle('checked');
            }
        }, false);

        // Create a new list item when clicking on the "Add" button
        function newElement() {
            // $.ajax({
            //            //     url: 'controler.php',
            //            //     type: 'GET',
            //            //     actionL 'GETDATA',
            //            //     success: function() {}
            //            // })
            var inputValue = document.getElementById("myInput").value.trim();
            $.ajax({
                url: "controler.php",
                type: "POST",
                data: {
                    itemInsert: inputValue,
                    action: 'ADD'
                },
                success: function(data) {
                    console.log(data)

                    if(data !== "Exist data"){
                        if(data){
                            var data = JSON.parse(data);
                            console.log("having data");
                            console.log(data);

                            var li = document.createElement("li");
                            var t = document.createTextNode(inputValue);
                            li.appendChild(t);
                            if (inputValue === '') {
                                alert("You must write something!");
                            } else {
                                document.getElementById("myUL").appendChild(li);
                            }
                            document.getElementById("myInput").value = "";

                            var span = document.createElement("SPAN");
                            var txt = document.createTextNode("\u00D7");
                            span.className = "close";
                            span.value = data.id;
                            span.appendChild(txt);
                            li.appendChild(span);

                            var close = document.getElementsByClassName("close");
                            for (let i = 0; i < close.length; i++) {
                                close[i].onclick = function() {
                                    var div = this.parentElement;
                                    div.style.display = "none";
                                    ajaxDelete(close[i].value);
                                }
                            }
                        }

                    }
                   else {
                       alert("Exist data!");
                       document.getElementById("myInput").value = '';

                    }

                 },
                error: function(error){
                    console.log(error);
                }
            });
        }


    </script>


</body>
</html>
