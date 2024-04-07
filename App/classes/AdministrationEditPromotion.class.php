<?php

require_once 'autoloader.php';

class AdministrationEditPromotion extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Edit Promotion";
  }

  /**
   * updatePromotion - Update the promotion in the database
   *
   * @return bool
   */
  public function updatePromotion( $id, $data )
  {
    // Update Promotion
     $result = $this->db->query_DB( "UPDATE service_promotions
                                     SET service    = '" . $data['serviceID']  . "',
                                         price      = '" . $data['price']      . "',
                                         expiration = '" . $data['expiration'] . "'
                                     WHERE id = '$id'"
                                  );

    if( !$result ){ return false; }
    
    return true;
  }

  /**
   * getPromotion - Retrieves the promotion from the database
   *
   * @return bool
   */
  public function getPromotion( $id )
  {
    return $this->db->query_DB( "SELECT p.id AS promoID, s.id AS serviceID, s.name, p.price, p.expiration 
                                 FROM services s 
                                 INNER JOIN service_promotions p 
                                 ON s.id = p.service
                                 WHERE p.id = '" . $id . "'" )[0];
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
    // Get promotion data
    $URL = explode( '/', $_GET['url'] );
    $services = $this->getServices();
    $promotion = $this->getPromotion( $URL[3] );
    
    // Set the page header
    $this->content .= '
    <!-- Promotion Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/Promotion">Promotions</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Edit Promotion</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Edit Promotion</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    // Handle updates to branding
    if( isset( $_POST['price'] ) ){
      // If successful at updating
      if( $this->updatePromotion( $URL[3], $_POST ) ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Promotion updated successfully!</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/Promotion/Edit/" . $URL[3]);
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the promotion!  Please try again later.</div>
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
                <label>Promotion Name</label>
                <input class="form-control" type="text" value="' . $promotion['name'] . '" disabled>
              </div>

              <div class="col-lg-12 mb-3">
                <label>Price<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="price" placeholder="20.00" value="' . $promotion['price'] . '" required>
                <small class="text-muted">Enter the amount including cents.</small>
              </div>
              
              <div class="col-lg-12 form-group">
                <label>Expiration Date <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="expiration" placeholder="2024-12-21" value="' . $promotion['expiration'] . '" required>
                <small class="text-muted">This is the expiration date of the promotion.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Service ID <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="serviceID" placeholder="8" value="' . $promotion['serviceID'] . '" required>
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
                <button class="btn btn-primary btn-block mt-0" type="submit">Edit Promotion</button>
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