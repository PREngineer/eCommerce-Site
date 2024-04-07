<?php

require_once 'autoloader.php';

class AdministrationNewPromotion extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > New Promotion";
  }

  /**
   * createPromotion - Stores the new promotion in the database
   *
   * @return bool
   */
  public function createPromotion()
  {
    // Insert into DB
     $result = $this->db->query_DB( "INSERT INTO service_promotions 
                                     ( service, price, expiration ) 
                                     VALUES ( '" . $_POST['serviceID'] . "', '" . $_POST['price'] . "', '" . $_POST['expiration'] . "' )"
                                  );

    if( !$result ){ return false; }
    
    return true;
  }

  /**
   * getServices - Retrieves all the services in the database
   *
   * @return bool
   */
  public function getServices()
  {
    return $this->db->query_DB( "SELECT * FROM services" );
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
    // Get service data
    $services = $this->getServices();
    
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">New Promotion</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">New Promotion</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    // Handle updates to branding
    if( isset( $_POST['price'] ) ){
      // If successful at creating
      if( $this->createPromotion() ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>New promotion created successfully!</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while creating the new promotion!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
      }
    }
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Column for Content -->

        <section class="col-lg-8">

          <form class="needs-validation" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate id="new_service-form">

            <div class="card-body font-size-md">

              <div class="col-lg-12 mb-3">
                <label>Price<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="price" placeholder="20.00" value="" required>
                <small class="text-muted">Enter the amount including cents.</small>
              </div>
              
              <div class="col-lg-12 form-group">
                <label>Expiration Date <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="expiration" placeholder="2024-12-21" value="" required>
                <small class="text-muted">This is the expiration date of the promotion.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Service ID <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="serviceID" placeholder="8" value="" required>
                <small class="text-muted">Enter the Service ID that will be used for the promotion, from the list below.</small>
              </div>

              <!-- Services Table -->
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Service ID</th>
                      <th>Service Name</th>
                      <th>Price</th>
                    </tr>
                  </thead>

                  <tbody>';

    foreach( $services as $service ){
      $this->content .= '
                    <tr>
                      <th scope="row">' . $service['id'] . '</th>
                      <td>' . $service['name'] . '</td>
                      <td>' . $service['price'] . '</td>
                    </tr>';
    }

    $this->content .= '
                  </tbody>
                </table>
              </div>
              
              <div class="col-lg-12 form-group">
                <button class="btn btn-primary btn-block mt-0" type="submit">Create Promotion</button>
              </div>

            </div>
          </form>
          
        </section>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>