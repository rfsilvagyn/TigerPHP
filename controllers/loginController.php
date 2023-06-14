<?php
class loginController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LOGIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $dados = array();

    if (isset($_POST['login']) && !empty($_POST['login'])) {
      $login = addslashes($_POST['login']);
      $senha = addslashes($_POST['senha']);

      $usuarios = new Usuarios();

      if ($usuarios->fazerLogin($login, $senha)) {
        header("Location: ".BASE_URL);
        exit;
      } else {
        $dados['erro'] = 'Acesso Negado!';
      }
    }
    $this->loadView('login', $dados);
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LOGOUT
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function logout() {
    $usuarios = new Usuarios();
    $usuarios->logout();
    header("Location: ".BASE_URL);
  }



}
?>
