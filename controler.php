<?php
    session_start();
    //
    $con = mysqli_connect('localhost','root','root');
    mysqli_select_db($con,'todolist');

    $username= $_SESSION['username'];
    //insert data
    if($_POST['action'] == 'ADD'){
        if (isset($_POST['itemInsert'])) {

            // query if of user
            $insertItem = $_POST['itemInsert'];

            $s = "select id from users where username = '$username'";
            $result = mysqli_query($con, $s);

            //id user
            $id = mysqli_fetch_object($result)->id;

            //check itemInsert exist or not
            $checkExistTodolist = mysqli_query($con,"select * from todolist where idUser = '$id' and todo = $insertItem ");

            $num = mysqli_num_rows($checkExistTodolist);

            if($num > 0) {
                echo 'Exist data';
            }
            else {
                $queryInsert = "insert into todolist (idUser,todo) values ('$id','$insertItem')";
                $resultInsert = mysqli_query($con, $queryInsert);

                $newestDataQuery = "select * from todolist where todo = '$insertItem' ";
                $resultNewestItem = mysqli_query($con, $newestDataQuery);

                if($resultInsert == true){
                    echo json_encode(mysqli_fetch_object($resultNewestItem));
                }
                else {
                    echo 'Add fail';
                }
            }
        }
    }

    //get data
    if($_GET['action'] == 'GETDATA'){
        $s = "select id from users where username = '$username'";
        $result = mysqli_query($con, $s);

        //insert todolist user
        $id = mysqli_fetch_object($result)->id;

        //get data with idUser
        $queryTodo = "select * from todolist where idUser = '$id'";
        $query = mysqli_query($con, $queryTodo);

        $data = [];
        while ($result2 = mysqli_fetch_object($query)) {
            array_push($data, $result2);
        }

        echo json_encode($data);
    }

    //delete data
    if($_POST['action'] == 'DELETEDATA') {
        $idTodo = $_POST['todo'];
        $query = "delete from todolist where id = '$idTodo' ";
        $resultDelete = mysqli_query($con,$query);

        if($resultDelete == true) {
            echo 'Delete success!';
        }
        else {
            echo 'Delete Fail!';
        }
    }

    if($_GET['action'] == 'TAKECURRENTTODO'){
        $s = "select id from users where username = '$username'";
        $result = mysqli_query($con, $s);

        //id user
        $id = mysqli_fetch_object($result)->id;

        $queryTodo = "select * from todolist where idUser = '$id' ";

        $resultCurrentTodo = mysqli_query($con, $queryTodo);
        $data = [];
        while ($result2 = mysqli_fetch_object($resultCurrentTodo)) {
            array_push($data, $result2);
        }

        echo json_encode($data);
    }

    if($_POST['action'] == 'CHANGETODO') {
        $newTodo = $_POST['newData'];
        $oldTodo = $_POST['oldData'];
        $s = "select id from users where username = '$username'";
        $result = mysqli_query($con, $s);

        //id user
        $id = mysqli_fetch_object($result)->id;

        $s1 = "update todolist set todo = '$newTodo' where idUser = '$id' and todo = '$oldTodo' ";
        $resultQuery = mysqli_query($con, $s1);
        if($resultQuery == true) {
            echo "Update success!!";
        }
        else {
            echo "update Fail!!";
        }
    }