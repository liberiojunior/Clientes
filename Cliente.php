<?php

class Cliente
{
    private $id;
    private $foto;
    private $nome;
    private $email;
    private $endereco;
    private $celular;


    public function __construct($id=null, $foto=null, $nome=null, $email=null, $endereco=null,$celular=null){

        $this->id = $id;
        $this->foto = $foto;
        $this->nome = $nome;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->celular = $celular;


    }


    public function view(){

        define('SERVIDOR', 'mysql:host=localhost;dbname=tpa_oo');
        define('USUARIO', 'root');
        define('SENHA', '');

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("SELECT * FROM cliente WHERE id=?");
        $sql->execute(array($this->id));

        $r=$sql->fetchObject();

        $this->foto = $r->foto;
        $this->nome = $r->nome;
        $this->email = $r->email;
        $this->endereco = $r->endereco;
        $this->celular = $r->celular;

        echo "<h2>Detalhes do Cliente</h2>";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>ID:</td><td>". $this->id . "</td></tr> ";
        echo "<tr><td>NOME:</td><td>". $this->foto . "</td></tr> ";
        echo "<tr><td>NOME:</td><td>". $this->nome . "</td></tr> ";
        echo "<tr><td>EMAIL:</td><td>". $this->email . "</td></tr> ";
        echo "<tr><td>ENDEREÇO:</td><td>". $this->endereco . "</td></tr> ";
        echo "<tr><td>CELULAR:</td><td>". $this->celular . "</td></tr> ";
        echo "</table>";
        echo "<a class='btn btn-primary' href='list.php'>Voltar</a>";

    }

    public function listar(){

        define('SERVIDOR', 'mysql:host=localhost;dbname=tpa_oo');
        define('USUARIO', 'root');
        define('SENHA', '');

        $con = new PDO(SERVIDOR, USUARIO, SENHA);
        $sql = $con->prepare("SELECT * FROM cliente");
        $sql->execute();
        $produtos=$sql->fetchAll(PDO::FETCH_CLASS);

        echo "<h2>Clientes
        <div class='pull-right'> <a class='btn btn-success' href='add.php'><i class='fa fa-plus' aria-hidden='true'></i> Novo</a></div>
        </h2>";

        echo "<table class='table table-bordered'>";
        echo "<tr><th>ID:</th>";
        echo "<th>FOTO:</th>";
        echo "<th>NOME:</th>";
        echo "<th>EMAIL:</th>";
        echo "<th>ENDEREÇO:</th>";
        echo "<th>CELULAR:</th>" ;
        echo "<th>OPÇÕES</th>";
        echo "</tr>";


        foreach($produtos AS $p){
            echo "<tr><td>".$p->id."</td>";
            echo "<td><img height='50px'  src='images/$p->foto'></td>";
            echo "<td>".$p->nome."</td>";
            echo "<td>".$p->email."</td>";
            echo "<td>".$p->endereco."</td>";
            echo "<td>".$p->celular."</td>";
            echo "<td>
            <a class='btn btn-info' href='view.php?id=$p->id'>Visualizar</a> ".
           "<a class='btn btn-success' href='update.php?id=$p->id'>Editar</a> ".
           "<a class='btn btn-danger' href='delete.php?id=$p->id'>Excluir</a> </td></tr>";
        }
        echo "</table>";

    }

    public function delete(){
        define('SERVIDOR', 'mysql:host=localhost;dbname=tpa_oo');
        define('USUARIO', 'root');
        define('SENHA', '');

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        $sql = $con->prepare("DELETE FROM cliente WHERE id=?");
        $sql->execute(array($this->id));
    }

    public function update()
    {

        define('SERVIDOR', 'mysql:host=localhost;dbname=tpa_oo');
        define('USUARIO', 'root');
        define('SENHA', '');

        $con = new PDO(SERVIDOR, USUARIO, SENHA);
        if ( isset($_POST['cliente']) ){

            // o usuario enviou uma fota
        if ( isset($_FILES['foto']) ){
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);

            // envia a foto
            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

            // para ser usado no banco de dados
            $this->foto=$_FILES["foto"]["name"];

            // alterando o campo no banco de dados
            $sql = $con->prepare("UPDATE cliente SET foto=? WHERE id=?");
            $sql->execute(array($this->foto,  $this->id)) ;

        }


            $this->nome=$_POST['cliente']['nome'];
            $this->email=$_POST['cliente']['email'];
            $this->endereco=$_POST['cliente']['endereco'];
            $this->celular=$_POST['cliente']['celular'];

            $sql = $con->prepare("UPDATE cliente SET nome=?, email=?, endereco=?, celular=? WHERE id=?");
            $sql->execute(array($this->nome, $this->email, $this->endereco, $this->celular,  $this->id)) ;

            header("Location: list.php");
        }
        $sql = $con->prepare("SELECT * FROM cliente WHERE id=?");
        $sql->execute(array($this->id));
        $r = $sql->fetchObject();

        $this->nome = $r->nome;
        $this->email = $r->email;
        $this->endereco = $r->endereco;
        $this->celular = $r->celular;

        echo "<h2>Alterar Cleinte</h2>";
        echo "<form method='post' action='' enctype='multipart/form-data'>";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>ID</td><td> <input type='text' name='cliente[id]' value='$this->id' disabled></td></tr>";
        echo "<tr><td>FOTO</td><td><input type='file' name='foto'></td></tr>";
        echo "<tr><td>NOME</td><td><input type='text' name='cliente[nome]' value='$this->nome'></td></tr>";
        echo "<tr><td>EMAIL</td><td><input type='text' name='cliente[email]' value='$this->email'></td></tr>";
        echo "<tr><td>ENDERECO</td><td><input type='text' name='cliente[endereco]' value='$this->endereco'></td></tr>";
        echo "<tr><td>CELULAR</td><td><input type='text' name='cliente[celular]' value='$this->celular'></td></tr>";
        echo "</table>";
        echo "</table>";
        echo "<input class='btn btn-primary' type='submit' value='Salvar'>";
        echo " <a class='btn btn-default' href='list.php'>Cancelar</a>";
        echo "</form>";


    }


    public function insert(){

        define('SERVIDOR', 'mysql:host=localhost;dbname=tpa_oo');
        define('USUARIO', 'root');
        define('SENHA', '');

        $con = new PDO(SERVIDOR, USUARIO, SENHA);

        if ( isset($_POST['cliente']) ){


            $this->nome=$_POST['cliente']['nome'];
            $this->email=$_POST['cliente']['email'];
            $this->endereco=$_POST['cliente']['endereco'];
            $this->celular=$_POST['cliente']['celular'];


            $sql = $con->prepare("INSERT INTO CLIENTE (nome, email, endereco, celular)VALUES(?,?,?,?)");
            $sql->execute(array($this->nome, $this->email, $this->endereco, $this->celular));
            header("Location: list.php");


        }
        echo "<h2>Novo Cliente</h2>";
        echo "<form method='post' action=''> ";
        echo "<table class='table table-bordered'>";
        echo "<tr><td>NOME</td><td><input  type='text' class='form-control' name='cliente[nome]' ></td></tr>";
        echo "<tr><td>EMAIL</td><td><input  type='text' class='form-control' name='cliente[email]' ></td></tr>";
        echo "<tr><td>ENDEREÇO</td><td><input  type='text' class='form-control' name='cliente[endereco]' ></td></tr>";
        echo "<tr><td>CELULAR</td><td><input  type='text' class='form-control' name='cliente[celular]' ></td></tr>";
        echo "</table>";
        echo "<button class='btn btn-success' type='submit'><i class='fa fa-save'></i> Cadastrar</button>";
        echo " <a class='btn btn-default' href='list.php'><i class='fa fa-reply'></i> Cancelar</a>";
        echo "</form>";

    }

}