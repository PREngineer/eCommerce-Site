<?php

require_once 'autoloader.php';

class AdministrationDeleteService extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Delete Service";
  }

  /**
   * getPromotions - Retrieves all the Promotions associated to this Service from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getPromotions( $id )
  {
    return $this->db->query_DB( "SELECT * FROM service_promotions WHERE service = '" . $id . "'" );
  }

  /**
   * getService - Retrieves the Service data from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getService( $id )
  {
    return $this->db->query_DB( "SELECT * FROM services WHERE id = '" . $id . "'" )[0];
  }

  /**
   * getTargetPromoIDs - Returns the ids of the promos to delete
   *
   * @param array promos
   * 
   * @return string ids
   */
  public function getTargetPromoIDs( $promos )
  {
    $out;
    for( $i=0; $i<sizeof( $promos ); $i++ ){
      $out .= $promos[$i]['id'];
      // If more than 1, separate with commas
      if( $i < sizeof( $promos )-1 ){  
        $out .= ',';
      }
    }

    return $out;
  }

  /**
   * deletePromos - Removes the associated promotions from the database
   *
   * @param string ids
   * 
   * @return int rows
   */
  public function deletePromos( $id )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM service_promotions 
                                 WHERE id IN (" . $id . ")" );
  }
  
  /**
   * deleteService - Removes the service from the database
   *
   * @return bool
   */
  public function deleteService( $id )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM services 
                                 WHERE id     = '" . $id . "'" );
  }

  /**
   * Display - Displays the full page
   *
   * @return void
   */
  public function Display()
  {
    // Get the data to process
    $URL = explode( '/', $_GET['url'] );
    $service = $this->getService( $URL[3] );
    $promos = $this->getPromotions( $URL[3] );
    $promoids = $this->getTargetPromoIDs( $promos );
        
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/Service">Services</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Delete Service</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Delete Service</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    $servicesDeleted = $this->deleteService( $URL[3] );
    $promosDeleted = 0;

    // If there are promos to delete
    if( sizeof( $promos ) > 0 ){
      $promosDeleted = $this->deletePromos( $promoids );
    }
    
    // If successful at deleting
    if( $servicesDeleted == 1 && $promosDeleted == sizeof( $promos ) ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Service deleted successfully!</div>
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
          <div>Something went wrong while deleting the Service!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
    }
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Column for Content -->

        <section class="col-lg-8">

          <!-- Table - Service Deleted -->

          <h5>Service Deleted:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Service Name</th>
                  <th>Description</th>
                  <th>Price</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">' . $service['id']          . '</th>
                  <td>'             . $service['name']        . '</td>
                  <td>'             . $service['description'] . '</td>
                  <td>'             . $service['price'] . '</td>
                </tr>
                </tr>
              </tbody>
            </table>
          </div>
          ';

  if( sizeof( $promos ) > 0 ){
    $this->content .= '
          <br><br>

          <!-- Table - Promotions Deleted -->

          <h5>Associated Promotion(s) Deleted:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Service Name</th>
                  <th>Description</th>
                  <th>Promotional Price</th>
                  <th>Original Price</th>
                </tr>
              </thead>

              <tbody>';

    foreach( $promos as $promo ){
      $this->content .= '
                <tr>
                  <th scope="row">' . $promo['id']          . '</th>
                  <td>'             . $service['name']        . '</td>
                  <td>'             . $service['description'] . '</td>
                  <td>'             . $promo['price']         . '</td>
                  <td>'             . $service['price']       . '</td>
                </tr>';
    }

    $this->content .= '
              </tbody>
            </table>
          </div>';
  }

  $this->content .= '
        </section>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>