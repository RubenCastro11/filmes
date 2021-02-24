<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $utilizador = $_POST['user_name'];
        $password = $_POST['password'];
        $con = new mysqli("localhost","root","","filmes");

        if($con->connect_errno!=0){
            echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
            exit;
        }
        else{
            $sql = "Select * from utilizadores where user_name=? and password=?";
            $stm = $con->prepare($sql);
            if($stm!=false){
                $stm->bind_param("ss",$utilizador,$password);
                $stm->execute();
                $res=$stm->get_result();

                $util=$res->fetch_assoc();
                    $stm->close();
                    $password_encriptada=$util['password'];
                    $verify = password_verify($password, $password_encriptada);

                    $_SESSION['id_user']=$util['id'];

                    
                    if($verify==True){
                        $_SESSION['login']="correto";
                        
                    }
                    else{
                        $_SESSION['login']="incorreto";

                    }
                    header("refresh:5;url=index.php");
                }
            else{
                echo "Ocorreu um erro no acesso à base de dados.<br>STM:".$con->connect_error;
                exit();
            }
        }
    }