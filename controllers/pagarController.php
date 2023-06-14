<?php
class pagarController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM DE CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $pagar = new Pagar();

    if ($usuarios->temPermissao('ver_pagar')) {
      if ( isset($_POST['status']) && $_POST['status'] != null ) {
        $status = $_POST['status'];
        $dados['dadosPagar'] = $pagar->obterStatus($status, $usuarios->pegarEmpresa());
      } else {
        $dados['dadosPagar'] = $pagar->obterTodos($usuarios->pegarEmpresa());
      }
      $this->loadTemplate('pagar', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $pagar = new Pagar();
    $fornecedores = new Fornecedores();
    $planocontas = New PlanoContas();
    $formaspagamento = New FormasPagamento();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('adicionar_pagar')) {
      if (isset($_POST['tb_fornecedores_id']) && !empty($_POST['tb_fornecedores_id'])) {

        $tb_fornecedores_id = addslashes(strtoupper($_POST['tb_fornecedores_id']));
        $nota_fiscal = addslashes(strtoupper($_POST['nota_fiscal']));
        $data_lancamento = addslashes(implode('-', array_reverse(explode('/', $_POST['data_lancamento']))));
        $referencia = addslashes(strtoupper($_POST['referencia']));
        $tb_planocontas_id = addslashes(strtoupper($_POST['tb_planocontas_id']));
        $tb_formaspagamento_id = addslashes(strtoupper($_POST['tb_formaspagamento_id']));
        $parcelas = $this->montaArray($_POST['parcelas']);
        $parcelas = $this->converteData($parcelas, array('vencimento', 'valor'));

        $resultado = $pagar->adicionar($tb_fornecedores_id, $nota_fiscal, $data_lancamento, $referencia, $tb_planocontas_id, $tb_formaspagamento_id, $parcelas, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."pagar");
      }
      $dados['dadosFornecedores'] = $fornecedores->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosPlanosContas'] = $planocontas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosFormasPagamento'] = $formaspagamento->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('addpagar', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $pagar = new Pagar();
    $fornecedores = new Fornecedores();
    $planocontas = New PlanoContas();
    $formaspagamento = New FormasPagamento();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('editar_pagar')) {
      if (isset($_POST['valor']) && !empty($_POST['valor'])) {

        $tb_fornecedores_id = addslashes(strtoupper($_POST['tb_fornecedores_id']));
        $nota_fiscal = addslashes(strtoupper($_POST['nota_fiscal']));
        $documento = addslashes(strtoupper($_POST['documento']));
        $data_lancamento = addslashes(implode('-', array_reverse(explode('/', $_POST['data_lancamento']))));
        $data_vencimento = addslashes(implode('-', array_reverse(explode('/', $_POST['data_vencimento']))));
        $valor = str_replace(",",".",str_replace(".","",$_POST["valor"]));
        $acrescimo = str_replace(",",".",str_replace(".","",$_POST["acrescimo"]));
        $referencia = addslashes(strtoupper($_POST['referencia']));
        $tb_planocontas_id = addslashes(strtoupper($_POST['tb_planocontas_id']));
        $tb_formaspagamento_id = addslashes(strtoupper($_POST['tb_formaspagamento_id']));

        $resultado = $pagar->editar($id, $tb_fornecedores_id, $nota_fiscal, $documento, $data_lancamento, $data_vencimento, $valor, $acrescimo, $referencia, $tb_planocontas_id, $tb_formaspagamento_id, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."pagar");
      }
      $dados['dadosPagar'] = $pagar->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosFornecedores'] = $fornecedores->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosPlanosContas'] = $planocontas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosFormasPagamento'] = $formaspagamento->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('editpagar', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //BAIXAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function baixar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $permissoes = new Permissoes();
    $pagar = new Pagar();
    $lancamentospagar = new LancamentosPagar();
    $contas = New Contas();
    $formaspagamento = New FormasPagamento();

    if ($usuarios->temPermissao('baixar_pagar')) {
      if (isset($_POST['valor']) && !empty($_POST['valor'])) {

        $tb_contaspagar_id = addslashes(strtoupper($_POST['tb_contaspagar_id']));
        $data = addslashes(implode('-', array_reverse(explode('/', $_POST['data']))));
        $valor = str_replace(",",".",str_replace(".","",$_POST["valor"]));
        $saldo = str_replace(",",".",str_replace(".","",$_POST["saldo"]));
        $tb_contas_id = addslashes(strtoupper($_POST['tb_contas_id']));
        $tb_formaspagamento_id = addslashes(strtoupper($_POST['tb_formaspagamento_id']));

        $resultado = $pagar->baixar($tb_contaspagar_id, $data, $valor, $saldo, $tb_contas_id, $tb_formaspagamento_id, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."pagar/baixar/".$resultado);
      }
      $dados['dadosPagar'] = $pagar->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosLancamentosPagar'] = $lancamentospagar->obterTodos($id, $usuarios->pegarEmpresa());
      $dados['dadosContas'] = $contas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosFormasPagamento'] = $formaspagamento->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('baixarpagar', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $pagar = new Pagar();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('deletar_pagar')) {

      $pagar->deletar($id, $usuarios->pegarEmpresa());

      header("Location: ".BASE_URL."pagar");
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ESTORNAR CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function estornar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $pagar = new Pagar();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('estornar_pagar')) {

      $resultado = $pagar->estornar($id, $usuarios->pegarEmpresa());

      header("Location: ".BASE_URL."pagar/baixar/".$resultado);
    } else {
      header("Location: ".BASE_URL);
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
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONVERTE PARA FORMATO AMERICANO DATA E VALOR DENTRO DE UM ARRAY
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  private function converteData($data, $option = null){
    if(is_array($data) && $option != null){
      foreach($data as $key => $value){
        foreach($option as $v){
          if(array_key_exists($v, $value)){
            if(strstr($value[$v], ',')){
              $data[$key][$v] = str_replace(",",".",str_replace(".","",$value[$v]));
            }else{
              $d = date_create(str_replace('/', '-', $value[$v]));
              $data[$key][$v] = date_format($d,"Y-m-d");
            }
          }
        }
      }
      return $data;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



}
?>
