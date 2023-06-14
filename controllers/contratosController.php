<?php
class contratosController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tb_clientes_id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();
    $pops = new Pops();
    $planos = new Planos();
    $nas = new Nas();
    $contas = new Contas();
    $vencimentos = new Vencimentos();
    $vendedores = new Vendedores();
    $contratos = new Contratos();


    if ($usuarios->temPermissao('adicionar_contrato')) {
      $permissoes = new Permissoes();

      if (isset($_POST['login']) && !empty($_POST['login'])) {
        $login = addslashes($_POST['login']);
        $senha_autenticacao = addslashes($_POST['senha_autenticacao']);
        $senha_central = addslashes($_POST['senha_central']);
        $tipo_autenticacao = addslashes(strtoupper($_POST['tipo_autenticacao']));
        $auto_mac = addslashes(strtoupper($_POST['auto_mac']));
        $ip = addslashes(strtoupper($_POST['ip']));
        $mac = addslashes(strtoupper($_POST['mac']));
        $login_simultaneo = addslashes(strtoupper($_POST['login_simultaneo']));
        $tb_clientes_id = addslashes(strtoupper($_POST['tb_clientes_id']));
        $tb_pops_id = addslashes(strtoupper($_POST['tb_pops_id']));
        $tb_planos_id = addslashes(strtoupper($_POST['tb_planos_id']));
        $tb_nas_id = addslashes(strtoupper($_POST['tb_nas_id']));
        $tb_contas_id = addslashes(strtoupper($_POST['tb_contas_id']));
        $tb_vencimentos_id = addslashes(strtoupper($_POST['tb_vencimentos_id']));
        $tb_vendedores_id = addslashes(strtoupper($_POST['tb_vendedores_id']));
        $tipo_contrato = addslashes(strtoupper($_POST['tipo_contrato']));
        $cep_cobranca = addslashes(strtoupper($_POST['cep_cobranca']));
        $bairro_cobranca = addslashes(strtoupper($_POST['bairro_cobranca']));
        $cidade_cobranca = addslashes(strtoupper($_POST['cidade_cobranca']));
        $endereco_cobranca = addslashes(strtoupper($_POST['endereco_cobranca']));
        $uf_cobranca = addslashes(strtoupper($_POST['uf_cobranca']));
        $numero_cobranca = addslashes(strtoupper($_POST['numero_cobranca']));
        $complemento_cobranca = addslashes(strtoupper($_POST['complemento_cobranca']));
        $ponto_referencia_cobranca = addslashes(strtoupper($_POST['ponto_referencia_cobranca']));
        $cep_instalacao = addslashes(strtoupper($_POST['cep_instalacao']));
        $bairro_instalacao = addslashes(strtoupper($_POST['bairro_instalacao']));
        $cidade_instalacao = addslashes(strtoupper($_POST['cidade_instalacao']));
        $endereco_instalacao = addslashes(strtoupper($_POST['endereco_instalacao']));
        $uf_instalacao = addslashes(strtoupper($_POST['uf_instalacao']));
        $numero_instalacao = addslashes(strtoupper($_POST['numero_instalacao']));
        $complemento_instalacao = addslashes(strtoupper($_POST['complemento_instalacao']));
        $ponto_referencia_instalacao = addslashes(strtoupper($_POST['ponto_referencia_instalacao']));

        $resultado = $contratos->adicionar($login, $senha_autenticacao, $senha_central, $tipo_autenticacao, $auto_mac, $ip, $mac, $login_simultaneo,
        $tb_clientes_id, $tb_pops_id, $tb_planos_id, $tb_nas_id, $tb_contas_id, $tb_vencimentos_id, $tb_vendedores_id, $tipo_contrato,
        $cep_cobranca, $bairro_cobranca, $cidade_cobranca, $endereco_cobranca, $uf_cobranca, $numero_cobranca, $complemento_cobranca, $ponto_referencia_cobranca,
        $cep_instalacao, $bairro_instalacao, $cidade_instalacao, $endereco_instalacao, $uf_instalacao, $numero_instalacao, $complemento_instalacao, $ponto_referencia_instalacao, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=contratos");

      }

      $dados['tb_clientes_id'] = $tb_clientes_id;
      $dados['dadosClientes'] = $clientes->obter($tb_clientes_id, $usuarios->pegarEmpresa());
      $dados['dadosPops'] = $pops->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosPlanos'] = $planos->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosNas'] = $nas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosContas'] = $contas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosVencimentos'] = $vencimentos->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosVendedores'] = $vendedores->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('addcontratos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();
    $pops = new Pops();
    $planos = new Planos();
    $nas = new Nas();
    $contas = new Contas();
    $vencimentos = new Vencimentos();
    $vendedores = new Vendedores();
    $contratos = new Contratos();


    if ($usuarios->temPermissao('editar_contrato')) {
      $permissoes = new Permissoes();

      if (isset($_POST['login']) && !empty($_POST['login'])) {
        $login = addslashes($_POST['login']);
        $senha_autenticacao = addslashes($_POST['senha_autenticacao']);
        $senha_central = addslashes($_POST['senha_central']);
        $tipo_autenticacao = addslashes(strtoupper($_POST['tipo_autenticacao']));
        $auto_mac = addslashes(strtoupper($_POST['auto_mac']));
        $ip = addslashes(strtoupper($_POST['ip']));
        $mac = addslashes(strtoupper($_POST['mac']));
        $login_simultaneo = addslashes(strtoupper($_POST['login_simultaneo']));
        $tb_pops_id = addslashes(strtoupper($_POST['tb_pops_id']));
        $tb_planos_id = addslashes(strtoupper($_POST['tb_planos_id']));
        $tb_nas_id = addslashes(strtoupper($_POST['tb_nas_id']));
        $tb_contas_id = addslashes(strtoupper($_POST['tb_contas_id']));
        $tb_vencimentos_id = addslashes(strtoupper($_POST['tb_vencimentos_id']));
        $tb_vendedores_id = addslashes(strtoupper($_POST['tb_vendedores_id']));
        $tipo_contrato = addslashes(strtoupper($_POST['tipo_contrato']));
        $cep_cobranca = addslashes(strtoupper($_POST['cep_cobranca']));
        $bairro_cobranca = addslashes(strtoupper($_POST['bairro_cobranca']));
        $cidade_cobranca = addslashes(strtoupper($_POST['cidade_cobranca']));
        $endereco_cobranca = addslashes(strtoupper($_POST['endereco_cobranca']));
        $uf_cobranca = addslashes(strtoupper($_POST['uf_cobranca']));
        $numero_cobranca = addslashes(strtoupper($_POST['numero_cobranca']));
        $complemento_cobranca = addslashes(strtoupper($_POST['complemento_cobranca']));
        $ponto_referencia_cobranca = addslashes(strtoupper($_POST['ponto_referencia_cobranca']));
        $cep_instalacao = addslashes(strtoupper($_POST['cep_instalacao']));
        $bairro_instalacao = addslashes(strtoupper($_POST['bairro_instalacao']));
        $cidade_instalacao = addslashes(strtoupper($_POST['cidade_instalacao']));
        $endereco_instalacao = addslashes(strtoupper($_POST['endereco_instalacao']));
        $uf_instalacao = addslashes(strtoupper($_POST['uf_instalacao']));
        $numero_instalacao = addslashes(strtoupper($_POST['numero_instalacao']));
        $complemento_instalacao = addslashes(strtoupper($_POST['complemento_instalacao']));
        $ponto_referencia_instalacao = addslashes(strtoupper($_POST['ponto_referencia_instalacao']));

        $resultado = $contratos->editar($id, $login, $senha_autenticacao, $senha_central, $tipo_autenticacao, $auto_mac, $ip, $mac, $login_simultaneo,
        $tb_pops_id, $tb_planos_id, $tb_nas_id, $tb_contas_id, $tb_vencimentos_id, $tb_vendedores_id, $tipo_contrato,
        $cep_cobranca, $bairro_cobranca, $cidade_cobranca, $endereco_cobranca, $uf_cobranca, $numero_cobranca, $complemento_cobranca, $ponto_referencia_cobranca,
        $cep_instalacao, $bairro_instalacao, $cidade_instalacao, $endereco_instalacao, $uf_instalacao, $numero_instalacao, $complemento_instalacao, $ponto_referencia_instalacao, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=contratos");
      }
      $dados['dadosContratos'] = $contratos->obter($id);
      $dados['dadosPops'] = $pops->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosPlanos'] = $planos->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosNas'] = $nas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosContas'] = $contas->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosVencimentos'] = $vencimentos->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosVendedores'] = $vendedores->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('editcontratos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ATIVAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function ativar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contratos = new Contratos();


    if ($usuarios->temPermissao('ativar_contrato')) {
      $permissoes = new Permissoes();

      if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = addslashes(strtoupper($_POST['status']));

        $resultado = $contratos->ativar($status, $id, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=contratos");
      }
      $dados['dadosContratos'] = $contratos->obter($id);

      $this->loadTemplate('ativarcontratos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DESATIVAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function desativar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contratos = new Contratos();


    if ($usuarios->temPermissao('desativar_contrato')) {
      $permissoes = new Permissoes();

      if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = addslashes(strtoupper($_POST['status']));

        $resultado = $contratos->desativar($status, $id, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=contratos");
      }
      $dados['dadosContratos'] = $contratos->obter($id);

      $this->loadTemplate('desativarcontratos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR CONTRATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contratos = new Contratos();

    if ($usuarios->temPermissao('deletar_contrato')) {
      $permissoes = new Permissoes();

      $resultado = $contratos->deletar($id);

      header("Location: ".BASE_URL."clientes/editar/".$resultado."?tabs=contratos");

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER CONTRATOS ATIVOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterAtivos($tb_clientes_id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contratos = new Contratos();

    if ($usuarios->temPermissao('deletar_contrato')) {
      $permissoes = new Permissoes();

      $resultado = $contratos->obterAtivos($tb_clientes_id, $usuarios->pegarEmpresa());

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE EXISTE LOGIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function existeLogin($login) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contratos = new Contratos();

    if ($usuarios->temPermissao('adicionar_contrato')) {

      $resultado = $contratos->existeLogin($login, $usuarios->pegarEmpresa());
      echo json_encode($resultado);

    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE EXISTE LOGIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function comparaLogin($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contratos = new Contratos();

    if ($usuarios->temPermissao('adicionar_contrato')) {
      $resultado = $contratos->comparaLogin($id, $usuarios->pegarEmpresa());
      echo json_encode($resultado);
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}
?>
