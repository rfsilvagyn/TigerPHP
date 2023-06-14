<?php
class usuariosController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONSTRUTOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
    parent::__construct();

    $usuarios = new Usuarios();

    if ($usuarios->estaLogado() == false) {
      header("Location: ".BASE_URL."login");
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM DE USUARIOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());

    if ($usuarios->temPermissao('ver_usuarios')) {

      $dados['dadosUsuarios'] = $usuarios->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('usuarios', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR USUARIO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $grupospermissoes = new Grupospermissoes();

    if ($usuarios->temPermissao('adicionar_usuarios')) {
      $permissoes = new Permissoes();

      if (isset($_POST['login']) && !empty($_POST['login'])) {
        $login = addslashes(strtolower($_POST['login']));
        $senha = addslashes($_POST['senha']);
        $nome = addslashes(strtoupper($_POST['nome']));
        $email = addslashes(strtolower($_POST['email']));
        $tb_gruposusuarios_id = addslashes($_POST['grupo']);

        if ( $_FILES['foto']['name'] != '' ) {
          $ext = strtolower(substr($_FILES['foto']['name'],-4)); //Pegando extensão do arquivo
          $new_name = rand().$ext; //Definindo um novo nome para o arquivo
          $dir = 'fotos/'; //Diretório para uploads
          move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

          $foto = $dir.$new_name;
        }

        $resultado = $usuarios->adicionar($login, $senha, $nome, $email, $tb_gruposusuarios_id, $foto, $usuarios->pegarEmpresa());

        if ($resultado == true) {
          header("Location: ".BASE_URL."usuarios");
        } else {
          $dados['erro'] = "Login/E-mail já existe!";
        }
      }
      $dados['dadosGrupos'] = $grupospermissoes->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('addusuarios', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR USUARIO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $grupospermissoes = new Grupospermissoes();

    if ($usuarios->temPermissao('editar_usuarios')) {
      $permissoes = new Permissoes();

      if ( isset($_POST['grupo']) && !empty($_POST['grupo'])) {
        $senha = addslashes($_POST['senha']);
        $nome = addslashes(strtoupper($_POST['nome']));
        $email = addslashes($_POST['email']);
        $tb_gruposusuarios_id = addslashes($_POST['grupo']);

        if ( $_FILES['foto']['name'] != '' ) {
          $ext = strtolower(substr($_FILES['foto']['name'],-4)); //Pegando extensão do arquivo
          $new_name = rand().$ext; //Definindo um novo nome para o arquivo
          $dir = 'fotos/'; //Diretório para uploads
          move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

          $foto = $dir.$new_name;
        }

        $usuarios->editar($senha, $nome, $email, $tb_gruposusuarios_id, $id, $foto, $usuarios->pegarEmpresa());
        header("Location: ".BASE_URL."usuarios");

      }

      $dados['dadosUsuarios'] = $usuarios->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosGrupos'] = $grupospermissoes->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('editusuarios', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR USUARIO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());

    if ($usuarios->temPermissao('deletar_usuarios')) {
      $permissoes = new Permissoes();

      $usuarios->deletar($id, $usuarios->pegarEmpresa());
      header("Location: ".BASE_URL."usuarios");

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



}
?>
