<?php

require_once 'autoloader.php';

class AdministrationEditServiceAddon extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Edit Service Add-on";
  }

  /**
   * getAddon - Gets the name of the service addon from the database
   *
   * @return bool
   */
  public function getAddon( $id )
  {
    // Update company name
    $result = $this->db->query_DB( "SELECT * from service_addons WHERE id = '" . $id . "'" )[0];
    if( !$result ){ return false; }
    
    return $result;
  }
  
  /**
   * Get - Retrieves all the Categories from the database
   *
   * @return array
   */
  public function getCategories()
  {
    return $this->db->query_DB( "SELECT * FROM service_categories ORDER BY name ASC" );
  }
  
  /**
   * updateServiceAddon - Updates the service addon in the database
   *
   * @return bool
   */
  public function updateServiceAddon( $id )
  {
    // Update company name
    $result = $this->db->query_DB( "UPDATE service_addons 
                                    SET category = '" . $_POST['category'] . "',
                                        name     = '" . $_POST['name'] . "', 
                                        price    = '" . $_POST['price'] . "' 
                                    WHERE id     = '" . $id . "'" );
    if( !$result ){ return false; }
    
    return true;
  }

  /**
   * Display - Displays the full page
   *
   * @return void
   */
  public function Display()
  {
    // Get the addon data
    $URL = explode( '/', $_GET['url'] );
    $addon = $this->getAddon( $URL[3] );
    
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/ServiceAddon">Service Add-ons</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Edit Service Add-on</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Edit Service Add-on</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    // Handle updates to branding
    if( isset( $_POST['name'] ) ){
      // If successful at updating
      if( $this->updateServiceAddon( $URL[3] ) ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Service addon updated successfully! Refreshing in 5 seconds to show the changes.</div>          
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/ServiceAddon/Edit/" . $URL[3]);
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the service addon!  Please try again later.</div>
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

              <div class="col-lg-12 form-group">
                <label>Service Add-on Name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" placeholder="My Service Add-on" value="' . $addon['name'] . '" required>
                <small class="text-muted">This is the name of the service addon.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Category <span class="text-danger">*</span></label>
                <select class="form-select" name="category" required>
                  <option value=""></option>';

    // Grab the necessary information from the database
    $categories = $this->getCategories();
    foreach( $categories as &$category ){
      $this->content .= '
                  <option value="' . $category['id'] . '"';
                  
                  if( $category['id'] == $addon['category'] ){
                  $this->content .= ' selected>' . $category['name'] . '</option>';
                  }
                  else{
                    $this->content .= '>' . $category['name'] . '</option>';
                  }
    }

    $this->content .= '
                </select>
                <small class="text-muted">Pick a category from the defined service categories.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Price <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="price" placeholder="50.00" value="' . $addon['price'] . '" required>
                <small class="text-muted">This is the price of the service add-on (including cents).</small>
              </div>
              
              <div class="col-lg-12 form-group">
                <button class="btn btn-primary btn-block mt-0" type="submit">Update Service Add-on</button>
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