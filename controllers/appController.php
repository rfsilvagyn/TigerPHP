<?php
class appController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ADICIONAR CHAMADOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar() {
    $app = new App();
    $dados = json_decode(file_get_contents('php://input'));

    if(is_null($dados)) {
      $dados = $_POST;
      $dados = json_decode(json_encode($dados), false);
    }
    if(!empty($dados->descricao)) {
      $descricao = strtoupper($dados->descricao);
      $status = strtoupper($dados->status);
      $dados = $app->adicionar($descricao, $status);
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //LOGIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function login() {
    $app = new App();
    $dados = json_decode(file_get_contents('php://input'));

    if(is_null($dados)) {
      $dados = $_POST;
      $dados = json_decode(json_encode($dados), false);
    }
    if(!empty($dados->login) && !empty($dados->senha)) {
      $login = $dados->login;
      $senha = $dados->senha;
      $dados = $app->login($login, $senha);
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODOS OS CHAMADOS POR ID DO EXECUTOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function obterChamados() {
    $app = new App();

    $dados = json_decode(file_get_contents('php://input'));

    if(is_null($dados)) {
      $dados = $_POST;
      $dados = json_decode(json_encode($dados), false);
    }
    if(!empty($dados->id_executor)) {
      $id_executor = $dados->id_executor;
      $dados = $app->obterChamados($id_executor);
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //FAZER CHECKIN
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkin() {
    $app = new App();

    $dados = json_decode(file_get_contents('php://input'));

    if(is_null($dados)) {
      $dados = $_POST;
      $dados = json_decode(json_encode($dados), false);
    }
    if(!empty($dados->id)) {

      $id = $dados->id;
      $latitude_checkin = $dados->latitude_checkin;
      $longitude_checkin = $dados->longitude_checkin;

      $dados = $app->checkin($id, $latitude_checkin, $longitude_checkin);
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //FAZER CHECKOUT
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function checkout() {
    $app = new App();

    $dados = json_decode(file_get_contents('php://input'));

    if(is_null($dados)) {
      $dados = $_POST;
      $dados = json_decode(json_encode($dados), false);
    }
    if(!empty($dados->id)) {

      $id = $dados->id;
      $latitude_checkout = $dados->latitude_checkout;
      $longitude_checkout = $dados->longitude_checkout;

      $dados = $app->checkout($id, $latitude_checkout, $longitude_checkout);

      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }












}

?>
