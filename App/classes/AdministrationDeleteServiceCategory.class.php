<?php

require_once 'autoloader.php';

class AdministrationDeleteServiceCategory extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Delete Service Category";
  }

  /**
   * getAddons - Retrieves the Addons associated to this Category from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getAddons( $id )
  {
    return $this->db->query_DB( "SELECT * FROM service_addons WHERE category = '" . $id . "'" );
  }
  
  /**
   * getCategory - Retrieves the Category from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getCategory( $id )
  {
    return $this->db->query_DB( "SELECT * FROM service_categories WHERE id = '" . $id . "'" )[0];
  }
  
  /**
   * getPromotions - Retrieves all the Promotions associated to this Category from the database
   *
   * @param string serviceIDs
   * 
   * @return array
   */
  public function getPromotions( $serviceIDs )
  {
    return $this->db->query_DB( "SELECT * FROM service_promotions WHERE service IN (" . $serviceIDs . ")" );
  }

  /**
   * getServices - Retrieves the Services from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getServices( $id )
  {
    return $this->db->query_DB( "SELECT * FROM services WHERE category = '" . $id . "'" );
  }

  /**
   * getServiceIDs - Returns the ids of the services associated with this category
   *
   * @param array services
   * 
   * @return string ids
   */
  public function getServiceIDs( $services )
  {
    $out;

    for( $i=0; $i<sizeof( $services ); $i++ ){
      $out .= $services[$i]['id'];
      // If more than 1, separate with commas
      if( $i < sizeof( $services )-1 ){
        $out .= ',';
      }
    }

    return $out;
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
   * deleteAddons - Removes the addons from the database
   *
   * @return bool
   */
  public function deleteAddons( $id )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM service_addons 
                                 WHERE category = '" . $id . "'" );
  }
  
  /**
   * deletePromos - Removes the associated promotions from the database
   *
   * @param string ids
   * 
   * @return int rows
   */
  public function deletePromos( $ids )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM service_promotions 
                                 WHERE id IN (" . $ids . ")" );
  }
  
  /**
   * deleteServices - Removes the services from the database
   *
   * @return bool
   */
  public function deleteServices( $id )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM services 
                                 WHERE category = '" . $id . "'" );
  }

  /**
   * deleteServiceCategory - Removes the service category from the database
   *
   * @return bool
   */
  public function deleteServiceCategory( $id )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM service_categories 
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
    $category = $this->getCategory( $URL[3] );
    $addons   = $this->getAddons( $URL[3] );
    $services = $this->getServices( $URL[3] );
    $promos   = array();
    // If there are services, get any promos that may apply
    if( sizeof( $services ) > 0 ){
      $promos = $this->getPromotions( $this->getServiceIDs( $services ) );
    }
        
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/ServiceCategory">Service Categories</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Delete Service Category</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Delete Service Category</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    $addonsDeleted   = 0;
    $promosDeleted   = 0;
    $servicesDeleted = 0;
    $categoryDeleted = $this->deleteServiceCategory( $URL[3] );
    
    // If there are addons to delete
    if( sizeof( $addons ) > 0 ){
      $addonsDeleted = $this->deleteAddons( $URL[3] );
    }

    // If there are services to delete
    if( sizeof( $services ) > 0 ){
      $servicesDeleted = $this->deleteServices( $URL[3] );
    }

    // If there are promos to delete
    if( sizeof( $promos ) > 0 ){
      $promosDeleted = $this->deletePromos( $this->getTargetPromoIDs( $promos ) );
    }
    
    // If successful at deleting
    if( $categoryDeleted == 1 && $addonsDeleted == sizeof( $addons ) && $servicesDeleted == sizeof( $services ) && $promosDeleted == sizeof( $promos ) ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Service category deleted successfully!</div>
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
          <div>Something went wrong while deleting the service category!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
    }
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Column for Content -->

        <section class="col-lg-8">

          <!-- Table - Service Category Deleted -->

          <h5>Service Category Deleted:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">' . $category['id']   . '</th>
                  <td>'             . $category['name'] . '</td>
                </tr>
                </tr>
              </tbody>
            </table>
          </div>
          ';

  if( sizeof( $addons ) > 0 ){
    $this->content .= '
          <br><br>

          <!-- Table - Add-ons Deleted -->

          <h5>Associated Add-on(s) Deleted:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category</th>
                  <th>Add-on Name</th>
                  <th>Price</th>
                </tr>
              </thead>

              <tbody>';

    foreach( $addons as $addon ){
      $this->content .= '
                <tr>
                  <th scope="row">' . $addon['id']       . '</th>
                  <td>'             . $addon['category'] . '</td>
                  <td>'             . $addon['name']     . '</td>
                  <td>'             . $addon['price']    . '</td>
                </tr>';
    }
  
    $this->content .= '
              </tbody>
            </table>
          </div>';
  }

  if( sizeof( $services ) > 0 ){
    $this->content .= '
          <br><br>

          <!-- Table - Services Deleted -->

          <h5>Associated Service(s) Deleted:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Service Category</th>
                  <th>Service Name</th>
                  <th>Description</th>
                  <th>Price</th>
                </tr>
              </thead>

              <tbody>';

    foreach( $services as $service ){
      $this->content .= '
                <tr>
                  <th scope="row">' . $service['id']          . '</th>
                  <td>'             . $service['category']    . '</td>
                  <td>'             . $service['name']        . '</td>
                  <td>'             . $service['description'] . '</td>
                  <td>'             . $service['price']       . '</td>
                </tr>';
    }
  
    $this->content .= '
              </tbody>
            </table>
          </div>';
  }

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
                  <th>Service ID</th>
                  <th>Price</th>
                  <th>Expiration</th>
                </tr>
              </thead>

              <tbody>';

    foreach( $promos as $promo ){
      $this->content .= '
                <tr>
                  <th scope="row">' . $promo['id']         . '</th>                  
                  <td>'             . $promo['service']    . '</td>
                  <td>'             . $promo['price']      . '</td>
                  <td>'             . $promo['expiration'] . '</td>
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