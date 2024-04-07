<?php

require_once 'autoloader.php';

class AdministrationDeleteServiceAddon extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Delete Service Add-on";
  }

  /**
   * getServiceAddon - Retrieves the Service Add-on data from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getServiceAddon( $id )
  {
    return $this->db->query_DB( "SELECT * FROM service_addons WHERE id = '" . $id . "'" )[0];
  }

  /**
   * getServices - Retrieves all the Services that contain this addon from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getServices( $id )
  {
    return $this->db->query_DB( "SELECT *
                                 FROM services
                                 WHERE addons LIKE '%" . $id . "%'" );
  }

  /**
   * removeTargetID - Returns the ids of the addons to update
   *
   * @param string target
   * @param string ids
   * 
   * @return string ids
   */
  public function removeTargetID( $target, $ids )
  {
    $parts = explode(',', $ids);

    // Remove target from the array
    $filtered = array_filter($parts, function ($part) use ($target) {
        return $part !== $target;
    });

    $newString = implode(',', $filtered);

    return $newString;
  }

  /**
   * updateServices - Updates the addons for the associated services in the database
   *
   * @param string services
   * 
   * @return int rows
   */
  public function updateServices( $services, $target )
  {
    $count = 0;

    // Process each service
    foreach( $services as $service ){
      // Define new addons list
      $addons = $this->removeTargetID( $target, $service['addons'] );
      // Update in database
      $res = $this->db->query_DB( "UPDATE services
                                    SET addons = '$addons'
                                    WHERE id = '" . $service['id'] . "'" );
      // Add to count
      if( $res == 1 ){
        $count++;
      }
    }

    return $count;
  }
  
  /**
   * deleteService - Removes the service from the database
   *
   * @return bool
   */
  public function deleteServiceAddon( $id )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM service_addons 
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
    $addon = $this->getServiceAddon( $URL[3] );    
    $services = $this->getServices( $URL[3] );
        
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/ServiceAddon">Service Addons</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Delete Service Add-on</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Delete Service Add-on</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    $addonsDeleted = $this->deleteServiceAddon( $URL[3] );
    $servicesEdited = 0;

    // If there are services to edit
    if( sizeof( $services ) > 0 ){
      $servicesEdited = $this->updateServices( $services, $URL[3] );
    }
    
    // If successful at deleting
    if( $addonsDeleted == 1 && $servicesEdited == sizeof( $services ) ){
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

          <!-- Table - Service Add-on Deleted -->

          <h5>Service Add-on Deleted:</h5>

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

              <tbody>
                <tr>
                  <th scope="row">' . $addon['id']       . '</th>
                  <td>'             . $addon['category'] . '</td>
                  <td>'             . $addon['name']     . '</td>
                  <td>'             . $addon['price']    . '</td>
                </tr>
                </tr>
              </tbody>
            </table>
          </div>
          ';

  if( sizeof( $services ) > 0 ){
    $this->content .= '
          <br><br>

          <!-- Table - Services Edited -->

          <h5>Services Edited:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Service Name</th>
                  <th>Description</th>
                  <th>Addons</th>
                  <th>Price</th>
                </tr>
              </thead>

              <tbody>';

    foreach( $services as $service ){
      $this->content .= '
                <tr>
                  <th scope="row">' . $service['id']          . '</th>
                  <td>'             . $service['name']        . '</td>
                  <td>'             . $service['description'] . '</td>
                  <td>'             . $service['addons']      . '</td>
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