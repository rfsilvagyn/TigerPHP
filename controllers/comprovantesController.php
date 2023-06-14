<?php
class comprovantesController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM DE COMPROVANTES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $comprovantes = new Comprovantes();

    if ($usuarios->temPermissao('ver_comprovantes')) {
      $dados['dadosComprovantes'] = $comprovantes->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('comprovantes', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR COMPROVANTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $comprovantes = new Comprovantes();
    $contas = new Contas();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('adicionar_comprovantes')) {

      if (isset($_POST['tipo']) && !empty($_POST['tipo'])) {
        $tipo = addslashes(strtoupper($_POST['tipo']));
        $data = addslashes(implode('-', array_reverse(explode('/', $_POST['data']))));
        $hora = addslashes(strtoupper($_POST['hora']));
        $numero = addslashes(strtoupper($_POST['numero']));
        $tb_contas_id = addslashes(strtoupper($_POST['tb_contas_id']));
        $valor = addslashes(str_replace(",",".", str_replace(".",",", $_POST['valor'])));
        $vencimento = addslashes(implode('-', array_reverse(explode('/', $_POST['vencimento']))));
        $contrato = addslashes(strtoupper($_POST['contrato']));
        $cliente = addslashes(strtoupper($_POST['cliente']));
        $nome = addslashes(strtoupper($_POST['nome']));

        $resultado = $comprovantes->adicionar($tipo, $data, $hora, $numero, $tb_contas_id, $valor, $vencimento, $contrato, $cliente, $nome, $usuarios->obterIdUsuario(), $usuarios->pegarEmpresa());
        header("Location: ".BASE_URL."comprovantes");
      }
      $dados['dadosContas'] = $contas->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('addcomprovantes', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIRMAR COMPROVANTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function confirmar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $comprovantes = new Comprovantes();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('confimar_comprovantes')) {

      $comprovantes->confirmar($id, $usuarios->pegarEmpresa());
      header("Location: ".BASE_URL."comprovantes");

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONFIRMAR COMPROVANTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function alerta($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $comprovantes = new Comprovantes();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('confimar_comprovantes')) {

      $comprovantes->alerta($id, $usuarios->pegarEmpresa());
      header("Location: ".BASE_URL."comprovantes");

    } else {
      header("Location: ".BASE_URL);
    }
  }


}

?>
