<?php
require 'CommonDao.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To do List</title>
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.remove-to-do').click(function (){
                const id= $(this).attr('id');
                

                $.post("app/remove.php",
                    {
                        id: id
                    },
                    (data) =>{
                        if (data){
                            $(this).parent().hide(600);
                        }
                    }
                );
            });

            $(".check-box").click(function() {
                const id= $(this).attr('data-todo-id');

                $.post('app/check.php',
                    {
                        id:id
                    },
                    (data) =>{
                        if (data != 'error'){
                            const h2 = $(this).next();
                            if (data === '1'){
                                h2.removeClass('checked');
                            }else {
                                h2.addClass('checked');
                            }
                        }
                    }
                );
            });
        });
    </script>

</head>
<body>
    <div class="main-section">
        <div class="add-section">
            <form action="app/add.php" method="post" autocomplete="off">
                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>

                    <input type="text" name="title" placeholder="This feild is required" style="border-color: #ff6666">
                    <button type="submit">Add &nbsp; <span>&#43</span></button>

                <?php } else{ ?>

                    <input type="text" name="title" placeholder="What do you want to do today?">
                    <button type="submit">Add &nbsp; <span>&#43</span></button>

                <?php } ?>
            </form>
        </div>
        <?php
            $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        ?>
        <div class="show-todo-section">
            <?php
            if ($todos->rowCount()===0){ ?>
                <div class="todo-item">
                    <div class="empty">

                    </div>
                </div>
            <?php }?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)){ ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id'] ?>"
                          class="remove-to-do">&#88
                    </span>
                    <?php if ($todo['checked']){ ?>
                        <input type="checkbox"
                            data-todo-id="<?php echo $todo['id'] ?>"
                            class="check-box"
                            checked/>
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                        <?php } else{ ?>
                        <input type="checkbox"
                               data-todo-id="<?php echo $todo['id'] ?>"
                               class="check-box"/>
                        <h2 ><?php echo $todo['title'] ?></h2>
                    <?php }?>
                    <br>
                    <small>Created :<?php echo $todo['date_time']?>  </small>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
