<?php
class fornecedoresController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LISTAGEM DE FORNECEDORES
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $fornecedores = new Fornecedores();

    if ($usuarios->temPermissao('ver_fornecedores')) {
      $dados['dadosFornecedores'] = $fornecedores->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('fornecedores', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR FORNECEDOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $fornecedores = new Fornecedores();

    if ($usuarios->temPermissao('adicionar_fornecedor')) {
      $permissoes = new Permissoes();

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {

        $tipo = addslashes(strtoupper($_POST['tipo']));
        $cpf = addslashes(strtoupper($_POST['cpf']));
        $cnpj = addslashes(strtoupper($_POST['cnpj']));

        $data_nascimento = addslashes($_POST['data_nascimento']);
        if ($data_nascimento == '') { $data_nascimento = date('d/m/Y'); }
        $data_nascimento = implode('-', array_reverse(explode('/', $data_nascimento)));

        $fantasia = addslashes(strtoupper($_POST['fantasia']));
        $nome = addslashes(strtoupper($_POST['nome']));
        $rg = addslashes(strtoupper($_POST['rg']));
        $rg_emissor = addslashes(strtoupper($_POST['rg_emissor']));
        $pai = addslashes(strtoupper($_POST['pai']));
        $inscricao_estadual = addslashes(strtoupper($_POST['inscricao_estadual']));
        $mae = addslashes(strtoupper($_POST['mae']));
        $inscricao_municipal = addslashes(strtoupper($_POST['inscricao_municipal']));
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
        $tel_fixo = addslashes(strtoupper($_POST['tel_fixo']));
        $tel_celular = addslashes(strtoupper($_POST['tel_celular']));

        $resultado = $fornecedores->adicionar($tipo, $cpf, $cnpj, $data_nascimento, $fantasia, $nome, $rg, $rg_emissor, $pai,
        $inscricao_estadual, $mae, $inscricao_municipal, $nacionalidade, $naturalidade, $estado_civil, $sexo, $profissao,
        $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento, $ponto_referencia, $tel_fixo, $tel_celular, $usuarios->pegarEmpresa());

        if ($resultado) {
          header("Location: ".BASE_URL."fornecedores");
        } else {
          header("Location: ".BASE_URL."fornecedores/?erro=Já existe um Fornecedor com esse CNPJ/CPF.");
        }

      }

      $this->loadTemplate('addfornecedores', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR FORNECEDOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $fornecedores = new Fornecedores();

    if ($usuarios->temPermissao('editar_fornecedor')) {
      $permissoes = new Permissoes();

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {

        $tipo = addslashes(strtoupper($_POST['tipo']));
        $cpf = addslashes(strtoupper($_POST['cpf']));
        $cnpj = addslashes(strtoupper($_POST['cnpj']));

        $data_nascimento = addslashes($_POST['data_nascimento']);
        if ($data_nascimento == '') { $data_nascimento = date('d/m/Y'); }
        $data_nascimento = implode('-', array_reverse(explode('/', $data_nascimento)));

        $fantasia = addslashes(strtoupper($_POST['fantasia']));
        $nome = addslashes(strtoupper($_POST['nome']));
        $rg = addslashes(strtoupper($_POST['rg']));
        $rg_emissor = addslashes(strtoupper($_POST['rg_emissor']));
        $pai = addslashes(strtoupper($_POST['pai']));
        $inscricao_estadual = addslashes(strtoupper($_POST['inscricao_estadual']));
        $mae = addslashes(strtoupper($_POST['mae']));
        $inscricao_municipal = addslashes(strtoupper($_POST['inscricao_municipal']));
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
        $tel_fixo = addslashes(strtoupper($_POST['tel_fixo']));
        $tel_celular = addslashes(strtoupper($_POST['tel_celular']));

        $resultado = $fornecedores->editar($id, $tipo, $cpf, $cnpj, $data_nascimento, $fantasia, $nome, $rg, $rg_emissor, $pai,
        $inscricao_estadual, $mae, $inscricao_municipal, $nacionalidade, $naturalidade, $estado_civil, $sexo, $profissao,
        $cep, $bairro, $cidade, $endereco, $uf, $numero, $complemento, $ponto_referencia, $tel_fixo, $tel_celular, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."fornecedores");
      }
      $dados['dadosFornecedores'] = $fornecedores->obter($id, $usuarios->pegarEmpresa());
      $this->loadTemplate('editfornecedores', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR FORNECEDOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $fornecedores = new Fornecedores();

    if ($usuarios->temPermissao('deletar_fornecedor')) {
      $permissoes = new Permissoes();
      $resultado = $fornecedores->deletar($id, $usuarios->pegarEmpresa());

      if ($resultado) {
        header("Location: ".BASE_URL."fornecedores");
      } else {
        header("Location: ".BASE_URL."fornecedores/?erro=Existe Contas a Pagar para esse Fornecedor.");
      }
    } else {
      header("Location: ".BASE_URL);
    }
  }




}

?>
