<?php

if (isset($_POST['id'])){
    require '../CommonDao.php';

    $id = $_POST['id'];

//    echo $title;

    if (empty($id)){
        echo 'error';
    }else{
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);

        $todos = $todos->fetch();
        $uid = $todos['id'];
        $checked = $todos['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uid ");

        if ($res){
            echo $checked;
        }else{
            echo "error";
        }

        $conn = null;
        exit();
    }
}else{
    header("Location: ../index.php?mess=error");
}

?>