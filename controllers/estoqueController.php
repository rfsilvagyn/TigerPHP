<?php
class estoqueController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM MOVIMENTACAO DO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $estoque = new Estoque();

    if ($usuarios->temPermissao('ver_estoque')) {
      $dados['dadosEstoque'] = $estoque->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('estoque', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DETALHES MOVIMENTACAO DO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function detalhes($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $estoque = new Estoque();

    if ($usuarios->temPermissao('ver_estoque')) {
      $dados['dadosEstoque'] = $estoque->obter($id, $usuarios->pegarEmpresa());
      $this->loadTemplate('detalhesestoque', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ENTRADA NO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function entrada() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $estoque = new Estoque();
    $produtos = new Produtos();
    $armazem = new Armazem();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('entrada_estoque')) {

      if (isset($_POST['tipo']) && !empty($_POST['tipo'])) {

        $tipo = addslashes(strtoupper($_POST['tipo']));
        $tb_armazem_id = addslashes($_POST['tb_armazem_id']);
        $produtos = $this->montaArray($_POST['produtos']);
        $tb_usuarios_id = $_SESSION['ccUsuario'];

        $resultado = $estoque->entrada($tipo, $tb_armazem_id, $produtos, $tb_usuarios_id, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."estoque");
      }
      $dados['dadosProdutos'] = $produtos->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosArmazem'] = $armazem->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('entradaestoque', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SAIDA NO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function saida() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $estoque = new Estoque();
    $produtos = new Produtos();
    $armazem = new Armazem();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('saida_estoque')) {

      if (isset($_POST['tipo']) && !empty($_POST['tipo'])) {

        $tipo = addslashes(strtoupper($_POST['tipo']));
        $tb_armazem_id = addslashes($_POST['tb_armazem_id']);
        $produtos = $this->montaArray($_POST['produtos']);
        $tb_usuarios_id = $_SESSION['ccUsuario'];
        $id_solicitante = addslashes($_POST['id_solicitante']);

        $resultado = $estoque->saida($tipo, $tb_armazem_id, $produtos, $tb_usuarios_id, $id_solicitante, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."estoque");
      }
      $dados['dadosProdutos'] = $produtos->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosArmazem'] = $armazem->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosUsuarios'] = $usuarios->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('saidaestoque', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //COMPROVANTE RETIRADA NO ESTOQUE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comprovante($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $estoque = new Estoque();
    $produtos = new Produtos();
    $armazem = new Armazem();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('comprovante_estoque')) {

      $dados['dadosEstoque'] = $estoque->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosEmpresa'] = $empresas->obterIpPortaEscPos($usuarios->pegarEmpresa());
      $this->loadView('relretirada', $dados);

      echo json_encode(["success" => true]);

    } else {
      echo json_encode(["success" => false, "message" => "Não tem permissão"]);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //MONTA ARRAY
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  private function montaArray($array){
    $arrayMontado = array();
    if(!empty($array)){
      foreach (array_keys($array) as $key) {
        foreach ($array[$key] as $k => $v) {
          $arrayMontado[$k][$key] = $v;
        }
      }
    }
    return $arrayMontado;
  }

}

?>
