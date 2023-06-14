<?php
class Usuarios extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VARIAVEIS PRIVADAS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  private $infoUsuario = array();
  private $permissoes;
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE ESTA LOGADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function estaLogado() {
    if (isset($_SESSION['ccUsuario']) && !empty($_SESSION['ccUsuario'])) {
      return true;
    } else {
      return false;
    }

  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EFETUAR LOGIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function fazerLogin($login, $senha) {
    $sql = "SELECT * FROM tb_usuarios WHERE login = :login AND senha = :senha";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':login', $login);
    $sql->bindValue(':senha', MD5($senha));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $registro = $sql->fetch();

      //SALVA NA SESSAO ID DO USUARIO LOGADO
      $_SESSION['ccUsuario'] = $registro['id'];
      $_SESSION['ffUsuario'] = $registro['foto'];

      //SALVA NA SESSAO SOMENTE 2 PRIMEIROS NOMES DO USUARIO COM PRIMEIRA LETRA MAIUSCULA
      $nome = explode(" ", $registro['nome']);
      $nome = implode(" ", array_splice($nome, 0, 2));
      $nome = ucwords(strtolower($nome));
      $_SESSION['nnUsuario'] = $nome;

      return true;
    } else {
      return false;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EFETUAR LOGOUT
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function logout() {
    unset($_SESSION['ccUsuario']);
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VEREFICA SE USUARIO TEM PERMISSAO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function temPermissao($nome) {
    if ($this->permissoes) {
      return $this->permissoes->temPermissao($nome);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SETA USUARIO LOGADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function setarUsuario() {
    if (isset($_SESSION['ccUsuario']) && !empty($_SESSION['ccUsuario'])) {
      $id = $_SESSION['ccUsuario'];

      $sql = "SELECT * FROM tb_usuarios WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', $id);
      $sql->execute();

      if ($sql->rowCount() > 0) {
        $this->infoUsuario = $sql->fetch();

        $this->permissoes = new Permissoes();
        $this->permissoes->setarGrupo($this->infoUsuario['tb_gruposusuarios_id'], $this->infoUsuario['tb_empresas_id']);
      }
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SETA EMPRESA COM BASE NO USUARIO LOGADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function pegarEmpresa() {
    if (isset($this->infoUsuario['tb_empresas_id'])) {
      return $this->infoUsuario['tb_empresas_id'];
    } else {
      return 0;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER NOME DO USUARIO LOGADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterNomeUsuario() {
    if (isset($this->infoUsuario['nome'])) {
      return  array('id' => $this->infoUsuario['id'], 'nome' => $this->infoUsuario['nome']);
    } else {
      return 0;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER ID DO USUARIO LOGADO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterIdUsuario() {
    if (isset($this->infoUsuario['nome'])) {
      return  $this->infoUsuario['id'];
    } else {
      return 0;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS USUARIOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterTodos($tb_empresas_id) {
    $array = array();

    $sql = "SELECT tb_usuarios.id, tb_usuarios.login, tb_usuarios.nome, tb_usuarios.email, tb_gruposusuarios.nome as grupo FROM tb_usuarios LEFT JOIN tb_gruposusuarios ON tb_gruposusuarios.id = tb_usuarios.tb_gruposusuarios_id WHERE tb_usuarios.tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER USUARIO POR ID
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obter($id, $tb_empresas_id) {
    $array = array();

    $sql = "SELECT * FROM tb_usuarios WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
    }
    return $array;
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR USUARIO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($login, $senha, $nome, $email, $tb_gruposusuarios_id, $foto, $tb_empresas_id) {
    if ( $this->existeLogin($login) == false && $this->existeEmail($email) == false ) {

      $sql = "INSERT INTO tb_usuarios SET login = :login, senha = :senha, nome = :nome, email = :email, tb_gruposusuarios_id = :tb_gruposusuarios_id, foto = :foto, tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':login', $login);
      $sql->bindValue(':senha', md5($senha));
      $sql->bindValue(':nome', $nome);
      $sql->bindValue(':email', $email);
      $sql->bindValue(':tb_gruposusuarios_id', $tb_gruposusuarios_id);
      $sql->bindValue(':foto', $foto);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();

      return true;

    } else {
      return false;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EDITAR USUARIO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function editar($senha, $nome, $email, $tb_gruposusuarios_id, $id, $foto, $tb_empresas_id) {
    $sql = "UPDATE tb_usuarios set nome = :nome, email = :email, tb_gruposusuarios_id = :tb_gruposusuarios_id WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':tb_gruposusuarios_id', $tb_gruposusuarios_id);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    if (!empty($senha)) {
      $sql = "UPDATE tb_usuarios set senha = :senha WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':senha', md5($senha));
      $sql->bindValue(':id', $id);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();
    }

    if (!empty($foto)) {
      $sql = "UPDATE tb_usuarios set foto = :foto WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':foto', $foto);
      $sql->bindValue(':id', $id);
      $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
      $sql->execute();
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //DELETAR USUARIO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function deletar($id, $tb_empresas_id) {
    $sql = "DELETE FROM tb_usuarios WHERE id = :id AND tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE LOGIN JA EXISTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  private function existeLogin($login) {
    $sql = "SELECT * FROM tb_usuarios WHERE login = :login";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':login', $login);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE E-MAIL JA EXISTE
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  private function existeEmail($email) {
    $sql = "SELECT * FROM tb_usuarios WHERE email = :email";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':email', $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //VERIFICA SE TEM USUARIO CADASTRADO NO GRUPO
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function temUsuarioNoGrupo($id) {
    $sql = "SELECT COUNT(*) AS c FROM tb_usuarios WHERE tb_gruposusuarios_id = :tb_gruposusuarios_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':tb_gruposusuarios_id', $id);
    $sql->execute();
    $registro = $sql->fetch();

    if ($registro['c'] == '0') {
      return false;
    } else {
      return true;
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}
?>
