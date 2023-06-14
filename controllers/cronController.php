<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class cronController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SETA STATUS COMO VENCIDO AUTOMATICO PARA TITULOS CONTAS A PAGAR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function statusVencidoPagar() {
    $cron = new Cron();

    $dados = json_decode(file_get_contents('php://input'));

    if( is_null($dados) ) {
      $dados = $_GET;
      $dados = json_decode(json_encode($dados), false);
    }
    if( $dados->chave == 10 ) {
      $chave = $dados->chave;
      $dados = $cron->statusVencidoPagar();
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SETA STATUS COMO VENCIDO AUTOMATICO PARA TITULOS CONTAS A RECEBER
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function statusVencidoReceber() {
    $cron = new Cron();

    $dados = json_decode(file_get_contents('php://input'));

    if( is_null($dados) ) {
      $dados = $_GET;
      $dados = json_decode(json_encode($dados), false);
    }
    if( $dados->chave == 10 ) {
      $chave = $dados->chave;
      $dados = $cron->statusVencidoReceber();
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function diasAtrasoReceber() {
    $cron = new Cron();

    $dados = json_decode(file_get_contents('php://input'));

    if( is_null($dados) ) {
      $dados = $_GET;
      $dados = json_decode(json_encode($dados), false);
    }
    if( $dados->chave == 10 ) {
      $chave = $dados->chave;
      $dados = $cron->diasAtrasoReceber();
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function arquivaComprovantes() {
    $cron = new Cron();

    $dados = json_decode(file_get_contents('php://input'));

    if( is_null($dados) ) {
      $dados = $_GET;
      $dados = json_decode(json_encode($dados), false);
    }
    if( $dados->chave == 10 ) {
      $chave = $dados->chave;
      $dados = $cron->arquivaComprovantes();
      header("Content-Type: application/json");
      echo json_encode($dados);
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //ENVIA E-MAIL COM RESUMO DO CONTAS A PAGAR DO DIA E VENCIDOS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function vencendoHojePagar() {
    $cron = new Cron();
    $mail = new PHPMailer(true);

    if ( isset($_GET['tb_empresas_id']) && !empty($_GET['tb_empresas_id']) ) {

      $tb_empresas_id = $_GET['tb_empresas_id'];
      $dados['dadosPagarHoje'] = $cron->vencendoHojePagar($tb_empresas_id);
      $dados['dadosPagarVencidos'] = $cron->vencidosPagar($tb_empresas_id);
      $dados['dadosEmpresa'] = $cron->obterEmailPagar($tb_empresas_id);

      if ( $dados['dadosEmpresa']['enviar_email_contasapagar'] == 'SIM' ) {
        if ( !empty($dados['dadosPagarHoje'])  ) {

          ob_start();
          $this->loadView('vencendohojeemail', $dados);
          $html = ob_get_contents();
          ob_end_clean();

          try {
            $mail->isSMTP();
            $mail->charSet = "UTF-8";
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = SMTP_AUTH;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;
            $mail->setFrom(SMTP_USER, 'Sistema Tiger');
            $mail->addAddress($dados['dadosEmpresa']['email_contasapagar']);
            $mail->isHTML(true);
            $mail->Subject = 'TIGER - Contas a Pagar';
            $mail->Body = $html;
            $mail->send();

          } catch (Exception $e) {
            echo "{$mail->ErrorInfo}";

          }
        }
      }
    }
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
