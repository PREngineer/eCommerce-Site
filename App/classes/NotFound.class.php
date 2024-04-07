<?php

require_once 'autoloader.php';

class NotFound extends Page
{
  
  //------------------------- Attributes -------------------------
  public $content = '';
  public $title = $this->SiteSettings[0]['value'] . " - 404 Not Found";
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
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
    // Set the page header
    $this->content .= '
    <div class="container py-5 mb-lg-3">
      <div class="row justify-content-center pt-lg-4 text-center">
        <div class="col-lg-5 col-md-7 col-sm-9"><img class="d-block mx-auto mb-5" src="/images/404.png" width="340" alt="404 Error">
          <h1 class="h3">404 error</h1>
          <h3 class="h5 font-weight-normal mb-4">Sorry!<br>We can\'t seem to find the page you are looking for.</h3>
        </div>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>