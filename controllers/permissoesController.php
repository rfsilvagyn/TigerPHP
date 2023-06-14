<?php
class permissoesController extends Controller {
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
  //LISTAGEM DE PERMISSOES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $permissoes = new Permissoes();
    $grupospermissoes = new Grupospermissoes();

    if ($usuarios->temPermissao('ver_permissoes')) {
      $permissoes = new Permissoes();

      $dados['dadosPermissoes'] = $permissoes->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosGrupos'] = $grupospermissoes->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('permissoes', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR PERMISSOES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());

    if ($usuarios->temPermissao('adicionar_permissoes')) {
      $permissoes = new Permissoes();

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);

        $permissoes->adicionar($nome, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."permissoes?tabs=permissoes");
      }
      $this->loadTemplate('addpermissoes', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR PERMISSOES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());

    if ($usuarios->temPermissao('deletar_permissoes')) {

      $permissoes = new Permissoes();
      $permissoes->deletar($id);

      header("Location: ".BASE_URL."permissoes?tabs=permissoes");
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
?>
