<?php

require_once 'autoloader.php';

class Administration extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration";
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
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <!--<li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>-->
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Administration</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Site Administration</h1>
        </div>
      </div>
    </div>

      <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
        ';
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
          <!-- Column for Content -->

          <section class="col-lg-8">
            
            <h3>Hi ' . $_SESSION['fname'] . ',</h3>
            
            <p>This is your website administration portal.</p>
            <p>Here, you can make changes to how you want the website to work and look. Features include:</p>
            <ul>
              <li>Turn features on/off</li>
              <li>Make changes to your store details</li>
              <li>Make changes to the Home Page image carousel</li>
              <li>Add/Edit/Remove Products, Services, and Promotions</li>
              <li>And more...</li>
            </ul>

            <!-- Important Node Card -->

            <div class="card text-danger bg-faded-danger border-danger">
              <div class="card-header border-danger"><h5 class="card-title text-danger">Important Note</h5></div>
              <div class="card-body">
                <p class="text-danger">This portal is optimized to be used in a computer or large tablet.<br>
                The options on the left will not be available in small screen devices.</p>
              </div>
            </div>

          </section>
        </div>
      </div>
    ';

    parent::Display();
  }

}

?>