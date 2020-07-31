<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>changePassword</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ad25b37544.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="flex col-2 row" id="form">
    <!--    <form action="" method = "">-->
            <div class="left col">
                <div class="col-spacer">
                    <div class="form-header"><i class="fas fa-lock icon txtglow"></i><span>Change todo</span></div>
                </div>
                <div class="input-wrap">
                    <div class="input-icon">
                        <div class="icon"><i class="fas fa-user"></i></div>
                        <input  id="currentTodo" type="text"/>
                    </div>
                </div>
                <div class="input-wrap">
                    <div class="input-icon">
                        <div class="icon"><i class="fas fa-key"></i></div>
                        <input id="newTodo" type="text"/>
                    </div>
                </div>

                <div class="flex space mt-5">
                    <button id="submit_btn" class="primary big">Submit</button>
                    <button id="home" class="primary big">Home</button>
                </div>
            </div>
    <!--    </form>-->
    </div>
    <script>
        var submit = document.getElementById("submit_btn");
        var currentTodoInput = document.getElementById("currentTodo");
        var newTodoInput = document.getElementById("newTodo");
        document.getElementById("home").addEventListener('click',() => {
            window.location.href = 'home.php';
        } );
        $.ajax({
            url : "controler.php",
            type: "GET",
            data: {
                action: "TAKECURRENTTODO"
            },
            success: function(data) {
                var data = JSON.parse(data);
                console.log(data);
                var listTodo = data.map(item =>
                    item.todo
                );
                submit.addEventListener('click', () => {
                    // console.log(listTodo);
                    // console.log(currentTodoInput);
                    if(currentTodoInput.value == '' || newTodoInput == '') {
                        alert('Please fill all blanks!');
                    }
                    else{
                        if(!listTodo.includes(currentTodoInput.value)){
                            alert("Not exist in todolist!");
                        }
                        else {
                            $.ajax({
                                url: "controler.php",
                                type: "POST",
                                data: {
                                    action: "CHANGETODO",
                                    newData: newTodoInput.value,
                                    oldData: currentTodoInput.value
                                },
                                success: function(data) {
                                    if(data == 'Update success!!'){
                                        alert("update success!!");
                                        window.location.href = "home.php";
                                    }
                                    else {
                                        alert("Update fail!!");
                                        window.location.href = "changeTodo.php";
                                    }
                                },
                                error: function(err) {
                                    console.log(err);
                                }
                            })
                        }
                    }

                })

                // var currentPassword = data.password;
                //
                // submit.addEventListener('click',() => {
                //     if(currentPasswordInput == '' || newPasswordInput == ''){
                //         alert("Please fill all blanks!")
                //     }
                //     else {
                //         if(currentPasswordInput.value != currentPassword) {
                //             alert("Current password is Wrong!");
                //         }
                //         else {
                //             $.ajax({
                //                 url: "controler.php",
                //                 type: "POST",
                //                 data: {
                //                     action: "CHANGEPASSWORD",
                //                     data: newPasswordInput.value
                //                 },
                //                 success: function(data) {
                //                     console.log(data);
                //                     if(data == "Update Success!"){
                //                         alert('update Success!');
                //                         window.location.href = "home.php"
                //                     }
                //                     else {
                //                         alert("Update Fail!");
                //                     }
                //                 },
                //                 error: function(err) {
                //                     console.log(err);
                //                 }
                //             })
                //         }
                //     }
                // })
            },
            error: function(err) {
                console.log(err)
            }
        });

    </script>
</body>
</html>