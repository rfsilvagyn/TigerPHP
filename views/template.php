<!DOCTYPE html>
<html>
<head>
  <title> Tiger </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/jquery/js/jquery-3.5.0.min.js"></script>

  <script src="<?php echo BASE_URL;?>assets-bk/vendors/js/vendor.bundle.base.js"></script>

  <script src="<?php echo BASE_URL;?>assets-bk/js/file-upload.js"></script>

  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/jquery/js/jquery.inputmask.bundle.min.js"></script>


  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/select2/js/select2.min.js"></script>
  <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/components/select2/css/select2-bootstrap4.css"/>
  <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/components/select2/css/select2.min.css"/>


  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/moment/moment-with-locales.js"></script>

  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/numeral/numeral.min.js"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/datatables/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/datatables/js/datetime-moment.js"></script>

  <script type="text/javascript" src="<?php echo BASE_URL;?>assets/components/axios/axios.min.js"></script>



  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/all.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets/css/geral.css">

  <link rel="stylesheet" href="<?php echo BASE_URL;?>assets-bk/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/html" href="<?php echo BASE_URL;?>assets-bk/css/vendor.bundle.base.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>assets-bk/css/style.css">

  <link rel="shortcut icon" href="assets-bk/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include "partials/_navbar.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include "partials/_sidebar.php" ?>
      <!-- partial -->
      <!-- content-wrapper ends -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include "partials/_footer.php" ?>
        <!-- partial -->
      </div>
    </div>
  </div>

</body>
</html>
<script src="<?php echo BASE_URL;?>assets-bk/js/hoverable-collapse.js"></script>
<script src="<?php echo BASE_URL;?>assets-bk/js/misc.js"></script>


<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/geral.js"></script>
<script>var BASE_URL = '<?php echo BASE_URL; ?>';</script>
