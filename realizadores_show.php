<?php
if($_SERVER['REQUEST_METHOD']=="GET"){

    if(isset($_GET['realizador']) && is_numeric($_GET['realizador'])){
        $idRealizador = $_GET['realizador'];
        $con = new mysqli("localhost","root","","filmes");

        if($con->connect_errno!=0){
            echo "<h1>Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error."</h1>";
            exit();
        }
        $sql = "Select * from realizadores where id_realizador=?";
        $stm = $con->prepare($sql);

        if($stm!=false){
            $stm->bind_param("i",$idRealizador);
            $stm->execute();
            $res=$stm->get_result();
            $realizador = $res->fetch_assoc();
            $stm->close();
        }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <title>Editar Realizador</title>
</head>
<body >
    <h1>Editar Realizador</h1>
    <form action="realizadores_update.php?ator=<?php echo $realizador['id_realizador']; ?>" method="post">
        <label>Nome</label><input type="text" name="nome" required value="<?php echo $realizador['nome'];?>"><br>
        <label>nacionalidade</label><input type="text" name="nacionalidade" required value="<?php echo $realizador['nacionalidade'];?>"><br>
        <label>Data_Nascimento</label><input type="date" name="data_nascimento" required value="<?php echo $realizador['data_nascimento'];?>"><br>
        <input type="submit" name="enviar"><br>
    </form>
</body>
<?php
 }
 else{
     echo ("<h1>Houve um erro ao processar o seu pedido.<br>Dentro de segundos será reencaminhado!</h1>");
     header("refresh:5; url=realizadores_index.php");
 }
}
?>
<br> <br>
<a href="login.php">Login</a>
<br>
<a href="register.php">Register</a>
<br>
<a href="listautilizadores.php">Lista Utilizadores</a>