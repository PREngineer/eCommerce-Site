<?php

require_once 'autoloader.php';

class MyAccount extends Page
{
  
  //------------------------- Attributes -------------------------
  public $content = '';
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->title = $this->SiteSettings[0]['value'] . " - My Account";
  }

  /**
   * Display - Displays the full page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Display()
  {
    
    // If just signed in\
    $URL = explode( '/', $_GET['url'] );
    if( $URL[1] == 'SignIn' ){
      $this->content .= '
      <!-- Successful Login Message -->

      <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
        <div class="alert-icon">
          <i class="ci-check-circle"></i>
        </div>
        <div>You have logged in successfully!</div>
        <button type = "button" class="close" data-dismiss="alert">x</button>
      </div>
      ';
    }

    

    parent::Display();
  }

}

?>