<?php
class chamadosController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CHAMADOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tb_clientes_id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();
    $chamados = new Chamados();
    $categoriachamados = new Categoriachamados();
    $contratos = new Contratos();

    if ($usuarios->temPermissao('adicionar_chamado')) {
      $permissoes = new Permissoes();

      if (isset($_POST['tb_clientes_id']) && !empty($_POST['tb_clientes_id'])) {
        $tb_clientes_id = addslashes(strtoupper($_POST['tb_clientes_id']));
        $id_usuario_abertura = addslashes(strtoupper($_POST['id_usuario_abertura']));
        $tipo = addslashes(strtoupper($_POST['tipo']));
        $tb_categorias_chamados_id = addslashes(strtoupper($_POST['tb_categorias_chamados_id']));
        $prioridade = addslashes(strtoupper($_POST['prioridade']));
        $data_abertura = implode('-', array_reverse(explode('/', $_POST['data_abertura'])));
        $data_checkin = ($_POST['data_checkin'] != '') ? implode('-', array_reverse(explode('/', $_POST['data_checkin']))) : NULL;
        $data_checkout = ($_POST['data_checkout'] != '') ? implode('-', array_reverse(explode('/', $_POST['data_checkout']))) : NULL;
        $data_agendamento = ($_POST['data_agendamento'] != '') ? implode('-', array_reverse(explode('/', $_POST['data_agendamento']))) : NULL;
        $valor_total = ($_POST['valor_total'] != '') ? addslashes(str_replace(',', '.', $_POST['valor_total'])) : NULL;
        $hora_abertura = addslashes(strtoupper($_POST['hora_abertura']));
        $hora_checkin = addslashes(strtoupper($_POST['hora_checkin']));
        $hora_checkout = addslashes(strtoupper($_POST['hora_checkout']));
        $hora_agendamento = addslashes(strtoupper($_POST['hora_agendamento']));
        $descricao = addslashes(strtoupper($_POST['descricao']));
        $tb_contratos_id = addslashes(strtoupper($_POST['tb_contratos_id']));
        $id_usuario_executor = addslashes(strtoupper($_POST['id_usuario_executor']));

        $resultado = $chamados->adicionar($tb_clientes_id, $id_usuario_abertura, $tipo,
        $tb_categorias_chamados_id, $prioridade, $data_abertura, $data_checkin, $data_checkout, $hora_abertura, $hora_checkin,
        $hora_checkout, $descricao, $tb_contratos_id, $id_usuario_executor, $valor_total, $data_agendamento, $hora_agendamento, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado.'?tabs=chamados');
      }

      $dados['dadosClientes'] = $clientes->obter($tb_clientes_id, $usuarios->pegarEmpresa());
      $dados['dadosCategoria'] = $categoriachamados->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosContratos'] = $contratos->obterAtivos($tb_clientes_id, $usuarios->pegarEmpresa());
      $dados['nomeUsuario'] = $usuarios->obterNomeUsuario();
      $dados['dadosUsuarios'] = $usuarios->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('addchamados', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CHAMADOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $clientes = new Clientes();
    $chamados = new Chamados();
    $categoriachamados = new Categoriachamados();
    $contratos = new Contratos();

    if ($usuarios->temPermissao('editar_chamado')) {
      $permissoes = new Permissoes();

      if (isset($_POST['id']) && !empty($_POST['id'])) {
        $tb_clientes_id = addslashes(strtoupper($_POST['tb_clientes_id']));
        $tipo = addslashes(strtoupper($_POST['tipo']));
        $prioridade = addslashes(strtoupper($_POST['prioridade']));
        $tb_categorias_chamados_id = addslashes(strtoupper($_POST['tb_categorias_chamados_id']));
        $id_usuario_executor = addslashes(strtoupper($_POST['id_usuario_executor']));
        $descricao = addslashes(strtoupper($_POST['descricao']));
        $hora_agendamento = addslashes(strtoupper($_POST['hora_agendamento']));
        $valor_total = ($_POST['valor_total'] != '') ? addslashes(str_replace(',', '.', $_POST['valor_total'])) : NULL;
        $data_agendamento = ($_POST['data_agendamento'] != '') ? implode('-', array_reverse(explode('/', $_POST['data_agendamento']))) : NULL;

        $resultado = $chamados->editar($id, $tb_clientes_id, $tipo, $prioridade, $tb_categorias_chamados_id, $id_usuario_executor,
        $descricao, $hora_agendamento, $data_agendamento, $valor_total, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."clientes/editar/".$resultado.'?tabs=chamados');
      }

      $dados['dadosChamados'] = $chamados->obter($id, $usuarios->pegarEmpresa());
      $dados['dadosCategoria'] = $categoriachamados->obterTodos($usuarios->pegarEmpresa());
      $dados['nomeUsuario'] = $usuarios->obterNomeUsuario();
      $dados['dadosUsuarios'] = $usuarios->obterTodos($usuarios->pegarEmpresa());
      $this->loadTemplate('editchamados', $dados);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CHECKIN CHAMADOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkin($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $chamados = new Chamados();

    if ($usuarios->temPermissao('checkin_chamado')) {
      $permissoes = new Permissoes();

      if (isset($id) && !empty($id)) {
        $resultado = $chamados->checkin($id, $usuarios->pegarEmpresa());
        header("Location: ".BASE_URL."chamados/editar/".$resultado);
      }

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CHECKOUT CHAMADOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkout($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $chamados = new Chamados();

    if ($usuarios->temPermissao('checkout_chamado')) {
      $permissoes = new Permissoes();

      if (isset($id) && !empty($id)) {
        $resultado = $chamados->checkout($id, $usuarios->pegarEmpresa());
        header("Location: ".BASE_URL."chamados/editar/".$resultado);
      }

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}

?>
