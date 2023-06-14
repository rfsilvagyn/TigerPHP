<?php
class planosController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM DE PLANOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $planos = new Planos();

    if ($usuarios->temPermissao('ver_planos')) {
      $dados['dadosPlanos'] = $planos->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('planos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR PLANO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $planos = new Planos();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('adicionar_planos')) {

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {

        $nome = addslashes(strtoupper($_POST['nome']));
        $download = addslashes($_POST['download']);
        $upload = addslashes($_POST['upload']);
        $burst = addslashes($_POST['burst']);
        $burst_download = $_POST['burst_download'] !=  '' ? addslashes($_POST['burst_download']) : null;
        $burst_upload = $_POST['burst_upload'] !=  '' ? addslashes($_POST['burst_upload']) : null;
        $prioridade = addslashes($_POST['prioridade']);
        $valor = str_replace(",",".",str_replace(".","",$_POST['valor']));
        $valor_instalacao = $_POST['valor_instalacao'] !=  '' ? str_replace(",",".",str_replace(".","",$_POST['valor_instalacao'])) : null;
        $senha_padrao_autenticacao = addslashes($_POST['senha_padrao_autenticacao']);
        $senha_padrao_central = addslashes($_POST['senha_padrao_central']);

        $resultado = $planos->adicionar($nome, $download, $upload, $burst, $burst_download, $burst_upload, $prioridade, $valor,
        $valor_instalacao, $senha_padrao_autenticacao, $senha_padrao_central, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."planos");
      }
      $this->loadTemplate('addplanos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR PLANO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $planos = new Planos();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('editar_planos')) {

      if (isset($_POST['id']) && !empty($_POST['id'])) {

        $id = addslashes($_POST['id']);
        $nome = addslashes(strtoupper($_POST['nome']));
        $download = addslashes($_POST['download']);
        $upload = addslashes($_POST['upload']);
        $burst = addslashes($_POST['burst']);
        $burst_download = isset($_POST['burst_download']) ? addslashes($_POST['burst_download']) : null;
        $burst_upload = isset($_POST['burst_upload']) ? addslashes($_POST['burst_upload']) : null;
        $prioridade = addslashes($_POST['prioridade']);
        $valor = str_replace(",",".",str_replace(".","",$_POST['valor']));
        $valor_instalacao = $_POST['valor_instalacao'] !=  '' ? str_replace(",",".",str_replace(".","",$_POST['valor_instalacao'])) : null;
        $senha_padrao_autenticacao = addslashes($_POST['senha_padrao_autenticacao']);
        $senha_padrao_central = addslashes($_POST['senha_padrao_central']);

        $resultado = $planos->editar($id, $nome, $download, $upload, $burst, $burst_download, $burst_upload, $prioridade, $valor,
        $valor_instalacao, $senha_padrao_autenticacao, $senha_padrao_central, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."planos");
      }
      $dados['dadosPlanos'] = $planos->obter($id, $usuarios->pegarEmpresa());
      $this->loadTemplate('editplanos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $planos = new Planos();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('deletar_planos')) {
      $planos->deletar($id, $usuarios->pegarEmpresa());
      header("Location: ".BASE_URL."planos");
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER SENHAS PADROES DOS PLANOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterSenhas($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $planos = new Planos();

    if ($usuarios->temPermissao('adicionar_contrato')) {
      $resultado = $planos->obter($id, $usuarios->pegarEmpresa());
      echo json_encode($resultado);

    }
  }



}

?>
