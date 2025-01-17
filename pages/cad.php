<?php 
include('../php/config.php');
if($_POST){
    if(isset($_POST['cad-emp'])){   
        CadastrarEmpresa($_POST['nome-emp'], $_POST['desc-emp']);
    }else if(isset($_POST['ent-emp'])){
        EntrarEmpresa($_POST['id-share']);
    }else if(isset($_POST['cad-ativ'])){
        CadastrarAtividade($_POST['nm-ativ'], $_POST['desc-ativ'], $_POST['dt-entrega'], $_POST['tags']);
    }else if(isset($_POST['cad-tag'])){
        CadastrarTag($_POST['nm-tag'], $_SESSION['cdEmp']);
    }else if(isset($_POST['cad-archive'])){
        UploadArchive($_FILES['archive'], $_POST['desc-archive'], $_POST['tag-arch']);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saturn</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <style>
        #tags{
            width: 100%;
        }
        #form-cad input{
            margin-top: 10px;
        }
        .org{
            margin-top: 20px;
            width: 100%;
            text-align: left;
        }
        #form-cad button{
            margin-top: 20px;
        }
        #nav-cad{
            height:20px;
            margin: 0px;
        }
        #nav-sec{
            background-color: #0D0D0D;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
        }
        #nav-sec a{
            padding: 22px;
            margin-left: 20px;
            text-decoration: none;
            color: white;
            transition: 0.2s;
        }
        #nav-sec a:hover{
            background-color: #706a6a;
        }
        .user{
            display: flex;
            flex-direction: column;
            width: 100%;
            text-align: start;
            border: 1px solid black;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .ativ{
            display: flex;
            flex-direction: column;
            width: 100%;
            text-align: start;
            border: 1px solid black;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .ativ p{
            margin-bottom: 10px;
        }
        #form-cad{
            display: flex;
            flex-direction: column;
            border: 1px solid black;
            border-radius: 15px;
            width: 370px;
            padding: 10px;
            text-align: center;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            box-shadow: 4px 3px rgb(117, 114, 114);
        }
        #form-cad p{
            color: rgb(0, 0, 0);
            text-transform: none;
            font-size: 20px;
            font-weight: normal;
        }
        .a{
            text-decoration: none;
            color: black;
        }
        .btn{
            width: 80px;
            text-align: center;
            border: 1px solid black;
            border-radius: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 10px;
        }
        .noStyleA{
                text-decoration: none;
                color: white;
        }
    </style>
</head>
<body id="body-cad">
    <nav id="nav-cad">
        <p>Saturn</p>
        
        <?php
            if($_GET['criar']){
                echo '
                <a href="home.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }else if($_GET['entrar']){
                echo '
                <a href="home.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }else if($_GET['nova-ativ']){
                echo '
                <a href="home.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }
            else if($_GET['users']){
                echo '
                <a href="home.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }else if($_GET['nova-tag']){
                echo '
                <a href="home.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }else if($_GET['user']){
                echo '
                <a href="cad.php?users=1"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }else if($_GET['ativ']){
                echo '
                <a href="atividades.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }else if($_GET['archive']){
                echo '
                <a href="home.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }else if($_GET['arch']){
                echo '
                <a href="home.php"><img src="../imgs/icones/voltar.png" alt="Icone de conta" width="30px"></a>
                ';
            }
        ?>
    </nav>
    

    <?php
        $res = VerificarAdm($_SESSION['cdUser']);
        if($res){
            echo '
                <div id="nav-sec">
                    <a href="?nova-ativ=1">Atividades</a>
                    <a href="?nova-tag=1">Tags</a>
                    <a href="?users=1">Usuários</a>
                    <a href="?archive=1">Arquivos</a>
                </div>
            ';
        }
    ?>
    <main id="main-cad">
        <section id="section-cad">
            <form method="post" autocomplete="off" id="form-cad" enctype="multipart/form-data">
                <?php
                    // $id_emp = 1234;
                    // $nome = "Mandioca assada";
                    // $id_share = strtolower(substr($nome, 0, 2));
                    // $id_share .= $id_emp;
                    // echo $id_share;
                    if($_GET){
                        if($_GET['criar']){
                            echo '
                            <p>Cadastrar empresa</p>
                            <input type="text" id="nome" name="nome-emp" placeholder="Nome" class="inputLogCad">
                            <textarea name="desc-emp" class="inputLogCad" style="resize:none;height:30px;margin-top:20px;" cols="40" placeholder="Descrição"></textarea>
                            <button name="cad-emp">Cadastrar</button>
                            ';
                        }else if($_GET['entrar']){
                            echo '
                            <p>Entrar em uma empresa</p>
                            <input type="text" id="id" name="id-share" placeholder="Id de compartilhamento" class="inputLogCad">
                            <button name="ent-emp">Entrar</button>
                            ';
                        }else if($_GET['nova-ativ']){
                            echo '
                            <p>Nova atividade</p>
                            <input type="text" name="nm-ativ" class="inputLogCad" placeholder="Nome da atividade:">
                            <textarea name="desc-ativ" class="inputLogCad" style="resize:none;height:30px;margin-top:20px;" cols="50" placeholder="Descrição da atividade:"></textarea>
                            <div class="org"><label for="dt-entrega">Data de entrega:</label></div>
                            <input type="date" name="dt-entrega" id="dt-entrega">
                            <div class="org"><label for="tags">Tag da atividade:</label></div>
                            <select name="tags" id="tags">
                                <option value=""></option>';
                                $res = ListarTag($_SESSION['cdEmp'], 0);
                                foreach($res as $row){
                                     echo '<option value="'.$row['cd'].'">'.$row['nm_tag'].'</option>';
                                }
                            echo '
                            </select>
                            <button name="cad-ativ">Criar</button>
                            ';
                        }else if($_GET['nova-tag']){
                            echo '
                                <p>Nova tag</p>
                                <input type="text" id="nm-tag" name="nm-tag" placeholder="Nome da tag" class="inputLogCad">
                                <button name="cad-tag">Cadastrar</button>
                            ';
                        }else if($_GET['users']){
                            $res = ListarUsuario(0, $_SESSION['cdEmp']);
                            echo '<p>Usuários</p>';
                            foreach($res as $row){
                                echo '
                                    <div class="user">
                                        <p>Nome: '.$row['nm_usuario'].'</p>
                                        <p>Email: '.$row['email_usuario'].'</p>
                                        <p class="btn"><a href="?user='.$row['cd'].'" class="a ">Abrir</a></p>
                                    </div>
                                '; 
                            }
                            
                        }else if($_GET['user'] > 0){
                            $cd = $_GET['user'];
                            $res = $res = ListarUsuario($cd, $_SESSION['cdEmp']);
                            foreach($res as $row){
                                echo'
                                    <div class="user">
                                        <p>Código: '.$row['cd'].'</p>
                                        <p>Nome: '.$row['nm_usuario'].'</p>
                                        <p>Email: '.$row['email_usuario'].'</p>
                                        <p>Status: '.$row['status_usuario'].'</p>
                                        <p class="btn"><a href="?user='.$row['cd'].'" class="a ">Abrir</a></p>
                                    </div>
                                ';
                            }
                        }else if($_GET['ativ'] > 0){
                            $cd = $_GET['ativ'];
                            $query = 'SELECT * FROM vwAtividades WHERE id_empresa = '.$_SESSION['cdEmp'].' AND cd = '.$cd;
                            $res = $GLOBALS['conn']->query($query);
                            foreach($res as $row){
                                $dt_entrega = date('d/m/Y', strtotime($row['dt_entrega']));
                                $dt_postagem = date('d/m/Y', strtotime($row['dt_postagem']));
                                echo '
                                    <p>Atividade</p>
                                    <div class="ativ"> 
                                        <p>Título: '.$row['nm_atividade'].'</p>
                                        <p>Descrição: '.$row['ds_atividade'].'</p>
                                        <p>Status: '.$row['status_atividade'].'</p>
                                        <p>Tag: '.$row['nm_tag'].'</p>
                                        <p>Vencimento: '.$dt_entrega.'</p>
                                        <p>Postado por: '.$row['nm_usuario'].', em '.$dt_postagem.'</p>
                                    </div>
                                ';
                            }
                        }else if($_GET['archive']){
                            echo '
                                <label for="archive">Selecione o arquivo</label>
                                <input type="file" id="archive" name="archive">
                                <textarea name="desc-archive" class="inputLogCad" style="resize:none;height:30px;margin-top:20px;" cols="50" placeholder="Descrição do arquivo:"></textarea>
                                <select name="tag-arch" id="tags" style="margin-top: 20px;">
                                <option value=""></option>';
                                $res = ListarTag($_SESSION['cdEmp'], 0);
                                foreach($res as $row){
                                     echo '<option value="'.$row['cd'].'">'.$row['nm_tag'].'</option>';
                                }
                                echo '
                                </select>
                                <button name="cad-archive">Enviar</button>
                            ';
                        }else if($_GET['arch']){
                            $cd = $_GET['arch'];
                            $query = 'SELECT * FROM vwArquivos WHERE id_empresa = '.$_SESSION['cdEmp'].' AND cd = '.$cd;
                            $res = $GLOBALS['conn']->query($query);
                            foreach($res as $row){
                                $dt_postagem = date('d/m/Y', strtotime($row['dt_postagem']));
                                echo '
                                <p>Arquivo</p>
                                <div class="ativ"> 
                                    <p>Nome: '.$row['nm_arquivo'].'</p>
                                    <p>Descrição: '.$row['ds_arquivo'].'</p>
                                    <p>Tag: '.$row['nm_tag'].'</p>
                                    <p>Postado por: '.$row['nm_usuario'].', em '.$dt_postagem.'.</p>
                                </div>
                                ';
                            }
                        }
                    }
                ?>
                
                
            </form>
        </section>
    </main>
</body>
</html>