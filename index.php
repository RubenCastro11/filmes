<?php
    session_start();
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
    <h1>Lista de Filmes</h1>
    <?php
        $stm = $con->prepare('select * from filmes');
        $stm->execute();
        $res=$stm->get_result();
        while($resultado = $res->fetch_assoc()){
            echo '<a href="filmes_show.php?filme='.$resultado['id_filme'].'">';
            echo $resultado['titulo'];
            echo '</a>';
            echo '<br>';
        }
        $stm->close();
        echo "<br>";
        $stm = $con->prepare('select * from utilizadores');
        $stm->execute();
        $res=$stm->get_result();
        while($resultado = $res->fetch_assoc()){
            if($resultado['id'] == $_SESSION['id_user']){
                echo '<a href="utilizadores_edit.php?user='.$resultado['id'].'">User</a><br>';
            }
        }
        $stm->close();
        ?>
        <a href="login.php"style="color:green">Login</a>
        <br>
        <a href="register.php"style="color:green">Register</a>
        <br>
        <a href="filmes_create.php"style="color:green">Adicionar Filme</a> 
        <br>
        <a href="atores_index.php"style="color:green">Atores</a>
        <br>
        <a href="realizadores_index.php"style="color:green">Realizadores</a>
        <br>
        <a href="listautilizadores.php"style="color:green">Lista Utilizadores</a>
      
    </body>
</html>

<?php
    }
?>
