<?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $nome="";
            $nacionalidade="";
            $data_nascimento="";
            if(isset($_POST['nome'])){
                $nome=$_POST['nome'];
            }
            else{
                echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
            }
            if(isset($_POST['nacionalidade'])){
                $nacionalidade=$_POST['nacionalidade'];
            }
            if(isset($_POST['data_nascimento'])){
                $data_nascimento=$_POST['data_nascimento'];
            }

            $con=new mysqli("localhost","root","","filmes");
            if($con->connect_errno!=0){
                echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
                exit;
            }
            else{
                if($con->connect_errno!=0){
                    echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
                    exit;
                }
        
                else{
                    $sql = 'insert into realizadores(nome,data_nascimento,nacionalidade) values(?,?,?)';
                    $stm = $con->prepare($sql);
                    if($stm!=false){
                        $stm->bind_param('sss',$nome,$data_nascimento,$nacionalidade);
                        $stm->execute();
                        $stm->close();
                        echo '<script>alert("Realizadores adicionado com sucesso");</script>';
                        echo 'Aguarde um momento. A reencaminhar página';
                        header("refresh:5; url=realizadores_index.php");
                    }
                    else{
                        echo($con->error);
                        echo "Aguarde um momento. A reencaminhar página";
                        header("refresh:5;url=realizadores_index.php");
                    }
                }
            }
            }
        else{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="ISO-8859-1">
    <title>Adicionar Realizador</title>
    </head>
    <body>
    <h1>Adicionar Realizador</h1>
    <form action="realizadores_create.php" method="post">
    <label>Nome</label><input type="text" name="nome" required>
    <br>
    <label>Nacionalidade</label><input type="text" name="nacionalidade">
    <br>
    <label>Data Nascimento</label><input type="date" name="data_nascimento">
    <br>
    <input type="submit" name="enviar"><br>
    </form>
    </body>
    </html>
    <?php
        };
    