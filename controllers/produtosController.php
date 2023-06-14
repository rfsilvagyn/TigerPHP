<?php
class produtosController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM DE PRODUTOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $produtos = new Produtos();

    if ($usuarios->temPermissao('ver_produtos')) {
      $dados['dadosProdutos'] = $produtos->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('produtos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $produtos = new Produtos();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('adicionar_produtos')) {

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {

        $nome = addslashes(strtoupper($_POST['nome']));
        $unidade = addslashes(strtoupper($_POST['unidade']));
        $quantidade_minima = addslashes($_POST['quantidade_minima']);

        $resultado = $produtos->adicionar($nome, $unidade, $quantidade_minima, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."produtos");
      }
      $this->loadTemplate('addprodutos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $produtos = new Produtos();
    $estoque = new Estoque();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('editar_produtos')) {

      if (isset($_POST['id']) && !empty($_POST['id'])) {

        $id = addslashes($_POST['id']);
        $nome = addslashes(strtoupper($_POST['nome']));
        $unidade = addslashes(strtoupper($_POST['unidade']));
        $quantidade_minima = addslashes($_POST['quantidade_minima']);
        $status = addslashes(strtoupper($_POST['status']));

        $resultado = $produtos->editar($id, $nome, $unidade, $quantidade_minima, $status, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."produtos");
      }
      $dados['dadosProdutos'] = $produtos->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosEstoque'] = $estoque->obterEstoque($id, $usuarios->pegarEmpresa());
      $this->loadTemplate('editprodutos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR PRODUTO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $produtos = new Produtos();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('deletar_produtos')) {
      $resultado = $produtos->deletar($id, $usuarios->pegarEmpresa());

      if ($resultado) {
        header("Location: ".BASE_URL."produtos");
      } else {
        header("Location: ".BASE_URL."produtos/?erro=Existe Movimentação para esse Produto.");
      }

    } else {
      header("Location: ".BASE_URL);
    }
  }

}

?>
