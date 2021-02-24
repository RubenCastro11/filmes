<?php
    $con = new mysqli("localhost","root","","filmes");
    if($con->connect_errno!=0){
        echo "Ocorreu um erro no acesso à base de dados ".$con->connect_error;
        exit;
    }
    else{
?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="ISO-8859-1">
    <title>Filmes</title>
    </head>
    <body style="background-color:yellow;color:green">
    <h1>Utilizadores</h1>
    <?php
        $stm = $con->prepare('select * from utilizadores');
        $stm->execute();
        $res=$stm->get_result();
        while($resultado = $res->fetch_assoc()){
            echo $resultado['nome'], "   " ,$resultado['user_name'], "    " ,$resultado['email'];
            echo '<br>';
        }
        $stm->close();
    ?>
<br>
</body>
</html>

<?php
    }
?>
            <a href="login.php"style="color:green">Login</a>
            <br>
            <a href="register.php"style="color:green">Register</a>
            <br>
            <a href="index.php"style="color:green">Pagina Inicial</a>
            <br>
            <a href="listautilizadores.php"style="color:green">Lista Utilizadores</a>