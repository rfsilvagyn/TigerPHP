<?php
class receberController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONA CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tb_contratos_id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contratos = new Contratos();
    $receber = new Receber();
    $permissoes = new Permissoes();

    if ($usuarios->temPermissao('adicionar_receber')) {

      if (isset($_POST['tb_contratos_id']) && !empty($_POST['tb_contratos_id'])) {
        $tb_contratos_id = addslashes(strtoupper($_POST['tb_contratos_id']));
        $tb_contas_id = addslashes(strtoupper($_POST['tb_contas_id']));
        $tb_clientes_id = addslashes(strtoupper($_POST['tb_clientes_id']));
        $parcelas = $this->montaArray($_POST['parcelas']);
        $parcelas = $this->converteData($parcelas, array('vencimento', 'valor'));

        $resultado = $receber->adicionar($tb_contratos_id, $tb_contas_id, $parcelas, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=financeiro");
      }
      $dados['dadosContrato'] = $contratos->obter($tb_contratos_id, $usuarios->pegarEmpresa());
      $dados['dadosReceberUltimo'] = $receber->obterUltimo($tb_contratos_id, $usuarios->pegarEmpresa());

      $this->loadTemplate('addreceber', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CONTAS A RECEBER RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $receber = new Receber();

    if ($usuarios->temPermissao('editar_receber')) {
      $permissoes = new Permissoes();

      if (isset($_POST['data_vencimento']) && !empty($_POST['data_vencimento'])) {

        $tb_clientes_id = addslashes($_POST['tb_clientes_id']);
        $data_vencimento = implode('-', array_reverse(explode('/', $_POST['data_vencimento'])));
        $valor = addslashes(str_replace(',', '.', $_POST['valor']));
        $referencia = addslashes($_POST['referencia']);

        $receber->editar($data_vencimento, $valor, $referencia, $id, $usuarios->pegarEmpresa());
        header("Location: ".BASE_URL."clientes/editar/".$tb_clientes_id."?tabs=financeiro");

      }

      $dados['dadosReceber'] = $receber->obter($id, $usuarios->pegarEmpresa());

      $this->loadTemplate('editreceber', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //BAIXAR CONTAS A RECEBER RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function baixar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $permissoes = new Permissoes();
    $receber = new Receber();
    $lancamentosreceber = new LancamentosReceber();
    $contas = new Contas();
    $formaspagamento = new FormasPagamento();

    if ($usuarios->temPermissao('baixar_receber')) {
      if (isset($_POST['valor']) && !empty($_POST['valor'])) {

        $tb_contasreceber_id = addslashes(strtoupper($_POST['tb_contasreceber_id']));
        $data = addslashes(implode('-', array_reverse(explode('/', $_POST['data']))));
        $valor = str_replace(",",".",str_replace(".","",$_POST["valor"]));
        $saldo = str_replace(",",".",str_replace(".","",$_POST["saldo"]));
        $tb_contas_id = addslashes(strtoupper($_POST['tb_contas_id']));
        $tb_formaspagamento_id = addslashes(strtoupper($_POST['tb_formaspagamento_id']));

        $resultado = $receber->baixar($tb_contasreceber_id, $data, $valor, $saldo, $tb_contas_id, $tb_formaspagamento_id, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."receber/baixar/".$resultado);
      }

      $dados['dadosReceber'] = $receber->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosLancamentosReceber'] = $lancamentosreceber->obterTodos($id, $usuarios->pegarEmpresa());
      $dados['dadosContas'] = $contas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosFormasPagamento'] = $formaspagamento->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('baixarreceber', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CANCELAR CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function cancelar() {
    if(isset($_POST['ids']) && !empty($_POST['ids'])){
      $titulos = explode(',', $_POST['ids']);

      $dados = array();
      $usuarios = new Usuarios();
      $usuarios->setarUsuario();
      $empresas = new Empresas($usuarios->pegarEmpresa());
      $receber = new Receber();

      if ($usuarios->temPermissao('cancelar_receber')) {
        $permissoes = new Permissoes();

        $resultado = $receber->cancelar($titulos, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=financeiro");
      } else {
        header("Location: ".BASE_URL);
      }
    } else {
      header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DESCANCELAR CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function descancelar($id) {

    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $receber = new Receber();

    if ($usuarios->temPermissao('descancelar_receber')) {
      $permissoes = new Permissoes();

      $resultado = $receber->descancelar($id, $usuarios->pegarEmpresa());

      header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=financeiro");
    } else {
      header("Location: ".BASE_URL);
    }
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //IMPRIMIR CARNE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function carne() {

    if(isset($_POST['ids']) && !empty($_POST['ids'])){
      $titulos = explode(',', $_POST['ids']);

      $dados = array();
      $usuarios = new Usuarios();
      $usuarios->setarUsuario();
      $empresas = new Empresas($usuarios->pegarEmpresa());
      $receber = new Receber();

      if ($usuarios->temPermissao('imprimir_carne')) {
        $permissoes = new Permissoes();

        $dados['dReceber'] = $receber->obterVarios($titulos, $usuarios->pegarEmpresa());

        ////////////////////////////////////////////////////////////////////////
        // INICIO GERACAO PDF COM MPDF
        ////////////////////////////////////////////////////////////////////////

        ob_start();
        $this->loadView('carnebradesco', $dados);
        $htmlBoleto = ob_get_contents();
        ob_end_clean();

        $mpdf = new \Mpdf\Mpdf(['tempDir' => 'temp', 'margin_left' => '4', 'margin_right' => '4', 'margin_top' => '1']);

        $mpdf->SetTitle('PDF Carne');

        $stylesheet = file_get_contents('./assets/css/carne.css');
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

        $mpdf->WriteHTML($htmlBoleto, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output($dados['dReceber'][0]['nome_cliente'],'I');

        ////////////////////////////////////////////////////////////////////////
        // FIM GERACAO PDF COM MPDF
        ////////////////////////////////////////////////////////////////////////

      } else {
        header("Location: ".BASE_URL);
      }
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //FILTRO PARA A REMESSA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function filtroremessa() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contas = new Contas();

    if ($usuarios->temPermissao('filtro_remessa')) {
      $dados['dadosContas'] = $contas->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('filtroremessa', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //RESULTADO FILTROS DE TITULOS PARA FAZER A REMESSA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function resultadoremessa() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $receber = new Receber();
    $permissoes = new Permissoes();

    if (isset($_POST['conta']) && !empty($_POST['conta'])) {

      $conta = addslashes(strtoupper($_POST['conta']));
      $vinicial = implode('-', array_reverse(explode('/', $_POST['vencimento_inicial'])));
      $vfinal = implode('-', array_reverse(explode('/', $_POST['vencimento_final'])));
      $status = addslashes(strtoupper($_POST['status_contrato']));
      $cliente = addslashes(strtoupper($_POST['nome_cliente']));

      if ($usuarios->temPermissao('resultado_remessa')) {
        $dados['dadosReceber'] = $receber->obterTodosRemessa($conta, $vinicial, $vfinal, $status, $cliente, $usuarios->pegarEmpresa());
        $this->loadTemplate('resultadoremessa', $dados);
      } else {
        header("Location: ".BASE_URL);
      }
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //GERACAO ARQUIVO REMESSA
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function geraremessa() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $receber = new Receber();
    $remessas = new Remessas();
    $permissoes = new Permissoes();

    if (isset($_POST['ids']) && !empty($_POST['ids'])) {
      $titulos = explode(',', $_POST['ids']);
      $total_registros = count($titulos);
      $arquivo = '';

      if ($usuarios->temPermissao('gera_remessa')) {
        $dados['dReceber'] = $receber->obterVarios($titulos, $usuarios->pegarEmpresa());
        $dados['ultimaRemessa'] = $dados['dadosRemessa'] = $remessas->adicionar($arquivo, $total_registros, $titulos, $usuarios->pegarEmpresa());
        $this->loadTemplate('remessabradesco', $dados);
      } else {
        header("Location: ".BASE_URL);
      }
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
              $data[$key][$v] = str_replace(',', '.', $value[$v]);
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
