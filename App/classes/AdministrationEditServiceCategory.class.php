<?php

require_once 'autoloader.php';

class AdministrationEditServiceCategory extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Edit Service Category";
  }

  /**
   * GetCategory - Gets the name of the service category from the database
   *
   * @return bool
   */
  public function getCategory( $id )
  {
    // Update company name
    $result = $this->db->query_DB( "SELECT name from service_categories WHERE id = '" . $id . "'" )[0];
    if( !$result ){ return false; }
    
    return $result;
  }
  
  /**
   * updateServiceCategory - Updates the service category in the database
   *
   * @return bool
   */
  public function updateServiceCategory( $id )
  {
    // Update company name
    if( isset( $_POST['name'] ) ){
      $result = $this->db->query_DB( "UPDATE service_categories 
                                      SET name = '" . $_POST['name'] . "' 
                                      WHERE id = '" . $id . "'" );
      if( !$result ){ return false; }
    }

    return true;
  }

  /**
   * Display - Displays the full page
   *
   * @return void
   */
  public function Display()
  {
    // Get the category data
    $URL = explode( '/', $_GET['url'] );
    $data = $this->getCategory( $URL[3] );
    
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
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Edit Service Category</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Edit Service Category</h1>
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
      if( $this->updateServiceCategory( $URL[3] ) ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Service category updated successfully! Refreshing in 5 seconds to show the changes.</div>          
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/ServiceCategory/Edit/" . $URL[3]);
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the service category!  Please try again later.</div>
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
                <label>Service Category <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" placeholder="My Service Category" value="' . $data['name'] . '" required>
                <small class="text-muted">This is the name of the service category.</small>
              </div>
              
              <div class="col-lg-12 form-group">
                <button class="btn btn-primary btn-block mt-0" type="submit">Update Service Category</button>
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