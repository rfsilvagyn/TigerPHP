<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Tiger </title>
  <link rel="stylesheet" href="<?php echo BASE_URL?>assets-bk/css/style.css">
  <link rel="shortcut icon" href="<?php echo BASE_URL?>assets-bk/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="<?php echo BASE_URL?>assets-bk/images/logo.svg">
              </div>
              <h4> Olá! vamos começar </h4>
              <h6 class="font-weight-light"> Faça login para continuar. </h6>
              <form method="POST" class="pt-3">
                <div class="form-group">
                  <input type="text" name="login" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Usuário">
                </div>
                <div class="form-group">
                  <input type="password" name="senha" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Senha">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" name="entrar">ENTRAR</button>
                </div>
                <!-- INICIO MENSAGEM LOGIN INVALIDO-->
                <?php
                if (isset($erro) && !empty($erro)): ?>
                <div class="text-center mt-4 font-weight-light"> <h6 class="font-weight-light text-danger"> <?php echo $erro ?> </h6> </div>
              <?php endif ?>
              <!-- FIM MENSAGEM LOGIN INVALIDO-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
