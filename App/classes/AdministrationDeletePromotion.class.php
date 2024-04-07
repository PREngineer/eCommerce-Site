<?php

require_once 'autoloader.php';

class AdministrationDeletePromotion extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Delete Promotion";
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
   * deletePromo - Delete the promotion from the database
   *
   * @return bool
   */
  public function deletePromo( $id )
  {
    return $this->db->query_DB( "DELETE FROM service_promotions
                                 WHERE id = '" . $id . "'" );
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
    $promotion = $this->getPromotion( $URL[3] );
        
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/Promotion">Promotions</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Delete Promotion</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Delete Promotion</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    $promosDeleted = $this->deletePromo( $URL[3] );
    
    // If successful at deleting
    if( $promosDeleted == 1 ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Promotion deleted successfully!</div>
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
          <div>Something went wrong while deleting the Promotion!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
    }
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Column for Content -->

        <section class="col-lg-8">

          <!-- Table - Promotion Deleted -->

          <h5>Promotion Deleted:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Promotion Name</th>
                  <th>Price</th>
                  <th>Expiration</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">' . $promotion['promoID']     . '</th>
                  <td>'             . $promotion['name']        . '</td>
                  <td>'             . $promotion['price']       . '</td>
                  <td>'             . $promotion['expiration']  . '</td>
                </tr>
                </tr>
              </tbody>

            </table>
          </div>

        </section>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>