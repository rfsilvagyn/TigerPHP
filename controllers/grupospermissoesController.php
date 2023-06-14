<?php
class grupospermissoesController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADCICIONAR GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $permissoes = new Permissoes();
    $grupospermissoes = new Grupospermissoes();

    if ($usuarios->temPermissao('adicionar_grupo_permissoes')) {
      $permissoes = new Permissoes();

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes(strtoupper($_POST['nome']));
        $parametros = $_POST['parametros'];

        $grupospermissoes->adicionar($nome, $parametros, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."permissoes?tabs=grupos");
      }

      $dados['dadosPermissoes'] = $permissoes->obterTodos($usuarios->pegarEmpresa());

      $this->loadTemplate('addgrupo', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $grupospermissoes = new Grupospermissoes();

    if ($usuarios->temPermissao('deletar_grupo_permissoes')) {
      $permissoes = new Permissoes();

      $grupospermissoes->deletar($id);

      header("Location: ".BASE_URL."permissoes?tabs=grupos");
    } else {
      header("Location: ".BASE_URL);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($id) {
    $dados = array();
    $usuarios = new Usuarios();
    $usuarios->setarUsuario();
    $empresas = new Empresas($usuarios->pegarEmpresa());
    $grupospermissoes = new Grupospermissoes();

    if ($usuarios->temPermissao('editar_grupo_permissoes')) {
      $permissoes = new Permissoes();

      if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nome = addslashes(strtoupper($_POST['nome']));
        $parametros = $_POST['parametros'];

        $grupospermissoes->editar($nome, $parametros, $id, $usuarios->pegarEmpresa());

        header("Location: ".BASE_URL."permissoes?tabs=grupos");
      }

      $dados['dadosPermissoes'] = $permissoes->obterTodos($usuarios->pegarEmpresa());
      $dados['dadosGrupos'] = $grupospermissoes->obter($id, $usuarios->pegarEmpresa());

      $this->loadTemplate('editgrupo', $dados);
    } else {
      header("Location: ".BASE_URL);
    }
  }


}
?>
