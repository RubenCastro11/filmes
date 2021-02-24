<?php
if(!isset($_SESSION['login'])){
    $_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto" && isset($_SESSION['login'])){
if($_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_GET['realizador']) || is_numeric($_GET['realizador'])){
        $idRealizador = $_GET['realizador'];
        $con = new mysqli("localhost","root","","filmes");
        if($con->connect_errno!=0){
            echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error."</h1>";
            exit();
        }
        else{
        $sql = "delete from realizadores where id_realizador=?";
        $stm = $con->prepare($sql);
        if($stm!=false){
            $stm->bind_param("i",$idRealizador);
            $stm->execute();
            $stm->close();
            echo ("<script>alert('Realizador eliminado com sucesso');</script>");
            echo 'Aguarde um momento. A reencaminar página';
            header("refresh:5; url=realizadores_index.php");
        }
        else{
            echo '<br>';
            echo $con->error;
            echo '<br>';
            echo "Aguarde um momento. A reencaminhar página";
            header("refresh:5; url=realizadores_index.php");
        }
    }
 }
 else{
    echo ("<h1>Houve um erro ao processar o seu pedido.<br>Dentro de segundos será reencaminhado!</h1>");
    header("refresh:5; url=realizadores_index.php");
    }
}
else{
    echo ("<h1>Houve um erro ao processar o seu pedido.<br>Dentro de segundos será reencaminhado!</h1>");
    header("refresh:5; url=realizadores_index.php");
    }

}
else{
    echo 'Para entrar nesta página necessita de efetuar <a href="login.php">Login</a>';
    header('refresh:2;url=realizadores_index.php');
}