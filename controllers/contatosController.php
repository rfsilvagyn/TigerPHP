<?php
class contatosController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CONTATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($tb_clientes_id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contatos = new Contatos();

    if ($usuarios->temPermissao('adicionar_contato')) {
      $permissoes = new Permissoes();

      if (isset($_POST['contato']) && !empty($_POST['contato'])) {
        $tb_clientes_id = addslashes(strtoupper($_POST['tb_clientes_id']));
        $contato = addslashes($_POST['contato']);
        $tipo = addslashes(strtoupper($_POST['tipo']));

        $resultado = $contatos->adicionar($tb_clientes_id, $contato, $tipo);

        header("Location: ".BASE_URL."clientes/editar/".$resultado);
      }
      $dados['tb_clientes_id'] = $tb_clientes_id;
      $this->loadTemplate('addcontatos', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR CONTATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contatos = new Contatos();

    if ($usuarios->temPermissao('editar_contato')) {
      $permissoes = new Permissoes();

      if (isset($_POST['contato']) && !empty($_POST['contato'])) {
        $contato = addslashes($_POST['contato']);
        $tipo = addslashes(strtoupper($_POST['tipo']));
        $tb_clientes_id = addslashes(strtoupper($_POST['tb_clientes_id']));

        $resultado = $contatos->editar($contato, $tipo, $id, $tb_clientes_id);
        header("Location: ".BASE_URL."clientes/editar/".$resultado);
      }
      $dados['dadosContatos'] = $contatos->obter($id);
      $this->loadTemplate('editcontato', $dados);


    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR CONTATO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $contatos = new Contatos();

    if ($usuarios->temPermissao('deletar_contato')) {
      $permissoes = new Permissoes();

      $resultado = $contatos->deletar($id);

      header("Location: ".BASE_URL."clientes/editar/".$resultado);

    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}
?>
