<?php
class notFoundController extends Controller {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //CONSTRUTOR
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
    parent::__construct();
  }
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //PRINCIPAL
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function index() {
    $data = array();

    $this->loadView('404', $data);
  }

}
?>
