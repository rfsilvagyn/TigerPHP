<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class clientesController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM DE CLIENTES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();

    if ($usuarios->temPermissao('ver_clientes')) {
      if (isset($_GET['buscaCliente'])) {
        $filtro = $_GET['buscaCliente'];
        $dados['dadosClientes'] = $clientes->obterTodosFiltro($filtro, $usuarios->pegarEmpresa());
        $dados['filtro'] = $filtro;
      } else {
        $dados['dadosClientes'] = $clientes->obterTodos($usuarios->pegarEmpresa());
      }
      $this->loadTemplate('clientes', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();

    if ($usuarios->temPermissao('adicionar_clientes')) {
      $permissoes = new Permissoes();

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {

        $tipo = addslashes(strtoupper($_POST['tipo']));
        $cpf = addslashes(strtoupper($_POST['cpf']));
        $cnpj = addslashes(strtoupper($_POST['cnpj']));
        $fantasia = addslashes(strtoupper($_POST['fantasia']));
        $inscricao_estadual = addslashes(strtoupper($_POST['inscricao_estadual']));
        $inscricao_municipal = addslashes(strtoupper($_POST['inscricao_municipal']));
        $data_nascimento = addslashes($_POST['data_nascimento']);
        $nome = addslashes(strtoupper($_POST['nome']));
        $rg = addslashes(strtoupper($_POST['rg']));
        $rg_emissor = addslashes(strtoupper($_POST['rg_emissor']));
        $pai = addslashes(strtoupper($_POST['pai']));
        $mae = addslashes(strtoupper($_POST['mae']));
        $nacionalidade = addslashes(strtoupper($_POST['nacionalidade']));
        $naturalidade = addslashes(strtoupper($_POST['naturalidade']));
        $estado_civil = addslashes(strtoupper($_POST['estado_civil']));
        $sexo = addslashes(strtoupper($_POST['sexo']));
        $profissao = addslashes(strtoupper($_POST['profissao']));
        $cep = addslashes(strtoupper($_POST['cep']));
        $bairro = addslashes(strtoupper($_POST['bairro']));
        $cidade = addslashes(strtoupper($_POST['cidade']));
        $endereco = addslashes(strtoupper($_POST['endereco']));
        $uf = addslashes(strtoupper($_POST['uf']));
        $numero = addslashes(strtoupper($_POST['numero']));
        $complemento = addslashes(strtoupper($_POST['complemento']));
        $ponto_referencia = addslashes(strtoupper($_POST['ponto_referencia']));
        $latitude = addslashes(strtoupper($_POST['latitude']));
        $longitude = addslashes(strtoupper($_POST['longitude']));
        $soube_empresa = addslashes(strtoupper($_POST['soube_empresa']));

        if ($data_nascimento == '') {
          $data_nascimento = date('d/m/Y');
        }

        $data_nascimento = implode('-', array_reverse(explode('/', $data_nascimento)));

        $contatos = $this->montaArray($_POST['contatos']);

        $resultado = $clientes->adicionar($tipo, $cpf, $cnpj, $fantasia, $inscricao_estadual, $inscricao_municipal, $data_nascimento, $nome, $rg, $rg_emissor, $pai, $mae, $nacionalidade,
        $naturalidade, $estado_civil, $sexo, $profissao, $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento,
        $ponto_referencia, $latitude, $longitude, $soube_empresa, $contatos, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado);
      }

      $this->loadTemplate('addclientes', $dados);
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
    $clientes = new Clientes();

    if ($usuarios->temPermissao('deletar_cliente')) {
      $permissoes = new Permissoes();

      $clientes->deletar($id, $usuarios->pegarEmpresa());

      header("Location: ".BASE_URL."clientes");
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();
    $contratos = new Contratos();
    $receber = new Receber();
    $contatos = new Contatos();
    $chamados = new Chamados();

    if ($usuarios->temPermissao('editar_clientes')) {
      $permissoes = new Permissoes();

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $tipo = addslashes(strtoupper($_POST['tipo']));
        $cpf = addslashes(strtoupper($_POST['cpf']));
        $cnpj = addslashes(strtoupper($_POST['cnpj']));
        $fantasia = addslashes(strtoupper($_POST['fantasia']));
        $inscricao_estadual = addslashes(strtoupper($_POST['inscricao_estadual']));
        $inscricao_municipal = addslashes(strtoupper($_POST['inscricao_municipal']));
        $data_nascimento = addslashes(strtoupper($_POST['data_nascimento']));
        $nome = addslashes(strtoupper($_POST['nome']));
        $rg = addslashes(strtoupper($_POST['rg']));
        $rg_emissor = addslashes(strtoupper($_POST['rg_emissor']));
        $pai = addslashes(strtoupper($_POST['pai']));
        $mae = addslashes(strtoupper($_POST['mae']));
        $nacionalidade = addslashes(strtoupper($_POST['nacionalidade']));
        $naturalidade = addslashes(strtoupper($_POST['naturalidade']));
        $estado_civil = addslashes(strtoupper($_POST['estado_civil']));
        $sexo = addslashes(strtoupper($_POST['sexo']));
        $profissao = addslashes(strtoupper($_POST['profissao']));
        $cep = addslashes(strtoupper($_POST['cep']));
        $bairro = addslashes(strtoupper($_POST['bairro']));
        $cidade = addslashes(strtoupper($_POST['cidade']));
        $endereco = addslashes(strtoupper($_POST['endereco']));
        $uf = addslashes(strtoupper($_POST['uf']));
        $numero = addslashes(strtoupper($_POST['numero']));
        $complemento = addslashes(strtoupper($_POST['complemento']));
        $ponto_referencia = addslashes(strtoupper($_POST['ponto_referencia']));
        $latitude = addslashes(strtoupper($_POST['latitude']));
        $longitude = addslashes(strtoupper($_POST['longitude']));
        $soube_empresa = addslashes(strtoupper($_POST['soube_empresa']));
        $data_nascimento = implode('-', array_reverse(explode('/', $data_nascimento)));

        $resultado = $clientes->editar($id, $tipo, $cpf, $cnpj, $fantasia, $inscricao_estadual, $inscricao_municipal, $data_nascimento, $nome, $rg, $rg_emissor, $pai, $mae, $nacionalidade,
        $naturalidade, $estado_civil, $sexo, $profissao, $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento,
        $ponto_referencia, $latitude, $longitude, $soube_empresa, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes");
      }
      $dados['dadosClientes'] = $clientes->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosContatos'] = $contatos->obterTodos($id, $usuarios->pegarEmpresa());
      $dados['dadosContratos'] = $contratos->obterTodos($id, $usuarios->pegarEmpresa());
      $dados['dadosContratosAtivos'] = $contratos->obterAtivos($id, $usuarios->pegarEmpresa());
      $dados['dadosReceber'] = $receber->obterTodosPorClienteAbertos($id, $usuarios->pegarEmpresa());
      $dados['dadosReceberPagos'] = $receber->obterTodosPorClientePagos($id, $usuarios->pegarEmpresa());
      $dados['dadosReceberCancelados'] = $receber->obterTodosPorClienteCancelados($id, $usuarios->pegarEmpresa());
      $dados['dadosChamados'] = $chamados->obterTodos($id, $usuarios->pegarEmpresa());

      $this->loadTemplate('editclientes', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //FICHA DE CLIENTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function ficha() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();
    $permissoes = new Permissoes();
    $mail = new PHPMailer(true);

    if ($usuarios->temPermissao('ficha_venda')) {

      if ( isset($_POST['nome']) && !empty($_POST['nome']) ) {

        $dados['dados'] = $_POST;
        $dados['dadosUsuarios'] = $usuarios->obterNomeUsuario();
        $dados['contatos'] = $this->montaArray($_POST['contatos']);

        ob_start();
        $this->loadView('fichaemail', $dados);
        $html = ob_get_contents();
        ob_end_clean();

        try {
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'sistema@itechnology.com.br';
          $mail->Password = 'malibu77';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $mail->setFrom('sistema@itechnology.com.br', 'Sistema Tiger');
          $mail->addAddress('raphael@itechnology.com.br', 'Raphael Felix');
          $mail->AddCC('marcio@itechnology.com.br', 'Marcio Rodrigues');

          $mail->isHTML(true);
          $mail->Subject = 'Ficha de Venda';
          $mail->Body = $html;
          $mail->send();

          header("Location: ".BASE_URL."clientes/ficha?resultado=Enviado");
        } catch (Exception $e) {
          echo "{$mail->ErrorInfo}";
        }
      }
      $this->loadTemplate('ficha', $dados);
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
