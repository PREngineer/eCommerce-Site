<?php

require_once 'autoloader.php';

class AdministrationSiteSettings extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Site Settings";
  }

  /**
   * updateBranding - Updates the database with the submitted changes
   *
   * @return bool
   */
  public function updateBranding()
  {
    // Update company name
    if( isset( $_POST['company_name'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = '" . $_POST['company_name'] . "' WHERE property = 'company_name'" );
      if( !$result ){ return false; }
    }
    // Update site_headline
    if( isset( $_POST['site_headline'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = '" . $_POST['site_headline'] . "' WHERE property = 'site_headline'" );
      if( !$result ){ return false; }
    }

    return true;
  }

  /**
   * updateLogo - Updates the image file for the logo
   *
   * @return bool
   */
  public function updateLogo()
  {
    // If file was uploaded, do validations
    if( $_FILES['site_logo']['tmp_name'] != '' ){
      
      // Grab the file extension
      $ext = pathinfo($_FILES['site_logo']['name'], PATHINFO_EXTENSION);
    
      // Only png are allowed
      if( $ext != 'png' ){
        return false;
      }

      // Replace the new logo
      $upload_dir = 'images/';
      $name = 'Logo.png';
      if( !move_uploaded_file( $_FILES['site_logo']['tmp_name'], $upload_dir . $name ) ){
        return false;
      }
    }

    // If all validations pass or no file uploaded
    return true;
  }

  /**
   * updateNavBarItems - Updates the database with the submitted changes to the Nav Bar
   *
   * @return bool
   */
  public function updateNavBarItems()
  {
    // Update the Login button
    if( isset( $_POST['login_button'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'login_button'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'login_button'" );
      if( !$result ){ return false; }
    }

    // Update Shopping Cart button
    if( isset( $_POST['cart_button'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'cart_button'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'cart_button'" );
      if( !$result ){ return false; }
    }

    // Update the Navigation Bar Search
    if( isset( $_POST['navbar_search'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'navbar_search'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'navbar_search'" );
      if( !$result ){ return false; }
    }

    // Update the Services menu
    if( isset( $_POST['navbar_menu'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'navbar_menu'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'navbar_menu'" );
      if( !$result ){ return false; }
    }

    return true;
  }

  /**
   * updatePlatformSections - Updates the database with the submitted changes to the platform sections
   *
   * @return bool
   */
  public function updatePlatformSections()
  {
    // Update Services Page
    if( isset( $_POST['services_page'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'services_page'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'services_page'" );
      if( !$result ){ return false; }
    }

    // Update Gift Cards Page
    if( isset( $_POST['gift_cards_page'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'gift_cards_page'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'gift_cards_page'" );
      if( !$result ){ return false; }
    }

    // Update Products Page
    if( isset( $_POST['products_page'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'products_page'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'products_page'" );
      if( !$result ){ return false; }
    }

    // Update Special Offers Page
    if( isset( $_POST['special_offers_page'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'special_offers_page'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'special_offers_page'" );
      if( !$result ){ return false; }
    }

    // Update Our Team Page
    if( isset( $_POST['our_team_page'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'our_team_page'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'our_team_page'" );
      if( !$result ){ return false; }
    }

    // Update Blog Page
    if( isset( $_POST['blog_page'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'blog_page'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'blog_page'" );
      if( !$result ){ return false; }
    }

    return true;
  }

  /**
   * updateServiceDetailsPageSections - Updates the database with the submitted changes to the service details page
   *
   * @return bool
   */
  public function updateServiceDetailsPageSections()
  {
    // Update Service Details Wishlist and Sharing
    if( isset( $_POST['service_details_wishlist_and_sharing'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'service_details_wishlist_and_sharing'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'service_details_wishlist_and_sharing'" );
      if( !$result ){ return false; }
    }

    // Update Service Details Creator
    if( isset( $_POST['service_details_creator'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'service_details_creator'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'service_details_creator'" );
      if( !$result ){ return false; }
    }

    // Update Service Details Sales Number
    if( isset( $_POST['service_details_sales_number'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'service_details_sales_number'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'service_details_sales_number'" );
      if( !$result ){ return false; }
    }

    // Update Service Details Rating
    if( isset( $_POST['service_details_rating'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'service_details_rating'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'service_details_rating'" );
      if( !$result ){ return false; }
    }

    // Update Service Details Review Graph
    if( isset( $_POST['service_details_review_graph'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'service_details_review_graph'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'service_details_review_graph'" );
      if( !$result ){ return false; }
    }

    // Update Service Details Reviews
    if( isset( $_POST['service_details_reviews'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'service_details_reviews'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'service_details_reviews'" );
      if( !$result ){ return false; }
    }

    // Update Service Details Comments
    if( isset( $_POST['service_details_comments'] ) ){
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'on' WHERE property = 'service_details_comments'" );
      if( !$result ){ return false; }
    }
    else{
      $result = $this->db->query_DB( "UPDATE settings SET value  = 'off' WHERE property = 'service_details_comments'" );
      if( !$result ){ return false; }
    }

    return true;
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
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Site Settings</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Site Settings</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    // Handle updates to branding
    if( $_POST['form'] == 'branding' ){
      // If successful at udpating logo
      if( $this->updateLogo() ){
        // If successful at updating data
        if( $this->updateBranding() ){
          $this->content .= '
          <!-- Success Message -->

          <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
            <div class="alert-icon">
              <i class="ci-check-circle"></i>
            </div>
            <div>Company branding information successfully updated! Refreshing in 5 seconds to show the changes.</div>          
            <button type = "button" class="close" data-dismiss="alert">x</button>
          </div>
          ';
          
          header( "Refresh: 5; url=/Administration/SiteSettings" );
        }
        else{
          $this->content .= '
          <!-- Error Message -->

          <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
            <div class="alert-icon">
              <i class="ci-close-circle"></i>
            </div>
            <div>Something went wrong while updating the company branding information!  Please try again later.</div>
            <button type = "button" class="close" data-dismiss="alert">x</button>
          </div>
          ';
        }
      }
      else{
        $this->content .= '
          <!-- Error Message -->

          <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
            <div class="alert-icon">
              <i class="ci-close-circle"></i>
            </div>
            <div>Logo must be a .png file!</div>
            <button type = "button" class="close" data-dismiss="alert">x</button>
          </div>
        ';
      }
    }

    // Handle updates to platform sections
    if( $_POST['form'] == 'platform_sections' ){
      // If successful at udpating
      if( $this->updatePlatformSections() ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Platform sections successfully updated! Refreshing in 5 seconds to show the changes.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/SiteSettings");
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the platform sections!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
      }
    }

    // Handle updates to service details page
    if( $_POST['form'] == 'service_details_page_sections' ){
      // If successful at udpating
      if( $this->updateServiceDetailsPageSections() ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Service Details Page sections successfully updated! Refreshing in 5 seconds to show the changes.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/SiteSettings");
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the Service Details Page sections!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
      }
    }

    // Handle updates to navigation bar
    if( $_POST['form'] == 'navigation_bar' ){
      // If successful at udpating
      if( $this->updateNavBarItems() ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Navigation Bar successfully updated! Refreshing in 5 seconds to show the changes.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/SiteSettings");
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the Navigation Bar!  Please try again later.</div>
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

          <!-- Branding Settings Card -->

          <div class="accordion" id="policies">
            <div class="card">
              <div class="card-header">
                <h3 class="accordion-heading">
                  <a href="#card1" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="card1">
                  Branding Settings<span class="accordion-indicator"><i data-feather="chevron-up"></i></span>
                  </a>
                </h3>
              </div>
              <div class="collapse" id="card1" data-parent="#policies">
                <form class="needs-validation" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate id="settings-form">
                  <input type="hidden" name="form" value="branding">
                  <div class="card-body font-size-md">
                    <div class="col-lg-12 form-group">
                      <label>Company Name <span class="text-danger">*</span></label>
                      <input class="form-control" type="text" name="company_name" placeholder="My Awesome Store" value="' . $this->SiteSettings[0]['value'] . '" required>
                      <small class="text-muted">This is the name of the company that appears in the browser\'s tab.</small>
                    </div>
      
                    <div class="col-lg-12 form-group">
                      <label>Site Headline <span class="text-danger">*</span></label>
                      <input class="form-control" type="text" name="site_headline" placeholder="Only the best!" value="' . $this->SiteSettings[1]['value'] . '" required>
                      <small class="text-muted">This is the tag line that appears in the browser\'s tab while viewing the Home page.</small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <label>Company Logo <span class="text-danger">*</span></label><br>
                      <img src="' . $this->SiteSettings[18]['value'] . '" height="115" width="115" class="img-thumbnail rounded-3" alt="Site Logo"><br>
                      <input class="form-control" name="site_logo" type="file">
                      <small class="text-muted">This is the logo that is displayed in the Navigation Bar.</small>
                    </div>

                    <div class="col-lg-12 form-group">
                      <button class="btn btn-primary btn-block mt-0" type="submit">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Platform Sections Card -->
          
          <div class="accordion" id="policies">
            <div class="card">
              <div class="card-header">
                <h3 class="accordion-heading">
                  <a href="#card2" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="card2">
                  Platform Sections<span class="accordion-indicator"><i data-feather="chevron-up"></i></span>
                  </a>
                </h3>
              </div>
              <div class="collapse" id="card2" data-parent="#policies">
                <form class="needs-validation" method="POST" autocomplete="off" novalidate id="settings-form">
                  <input type="hidden" name="form" value="platform_sections">
                  <div class="card-body font-size-md">
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="services_page"';
                        if( $this->SiteSettings[13]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= '>
                        <label class="form-check-label">Services Page</label>
                      </div>
                      <small class="text-muted">Turn the Services page on or off.</small>
                    </div>

                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="gift_cards_page"';
                        if( $this->SiteSettings[19]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Gift Cards Page</label>
                      </div>
                      <small class="text-muted">Turn the Gift Cards page on or off.</small>
                    </div>
                
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="products_page"';
                        if( $this->SiteSettings[14]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Products Page</label>
                      </div>
                      <small class="text-muted">Turn the Products page on or off.</small>
                    </div>
                
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="special_offers_page"';
                        if( $this->SiteSettings[15]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= '>
                        <label class="form-check-label">Promotions Page</label>
                      </div>
                      <small class="text-muted">Turn the Promotions page on or off.</small>
                    </div>
                
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="our_team_page"';
                        if( $this->SiteSettings[16]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Our Team Page</label>
                      </div>
                      <small class="text-muted">Turn the Our Team page on or off.</small>
                    </div>

                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="blog_page"';
                        if( $this->SiteSettings[17]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Blog Page</label>
                      </div>
                      <small class="text-muted">Turn the Blog page on or off.</small>
                    </div>

                    <div class="col-lg-12 form-group">
                      <button class="btn btn-primary btn-block mt-0" type="submit">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Service Details Page Sections Card -->
          
          <div class="accordion" id="policies">
            <div class="card">
              <div class="card-header">
                <h3 class="accordion-heading">
                  <a href="#card3" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="card3">
                  Service Details Page - Sections<span class="accordion-indicator"><i data-feather="chevron-up"></i></span>
                  </a>
                </h3>
              </div>
              <div class="collapse" id="card3" data-parent="#policies">
                <form class="needs-validation" method="POST" autocomplete="off" novalidate id="settings-form">
                  <input type="hidden" name="form" value="service_details_page_sections">
                  <div class="card-body font-size-md">
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="service_details_wishlist_and_sharing"';
                        if( $this->SiteSettings[2]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Wish List and Sharing</label>
                      </div>
                      <small class="text-muted">Turn the Wishlist/Share section on or off in the Service Details page.</small>
                    </div>
                  
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="service_details_creator"';
                        if( $this->SiteSettings[3]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Creator</label>
                      </div>
                      <small class="text-muted">Turn the Creator section on or off in the Service Details page.</small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="service_details_sales_number"';
                        if( $this->SiteSettings[4]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Sales Number</label>
                      </div>
                      <small class="text-muted">Turn the Number of Sales section on or off in the Service Details page.</small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="service_details_rating"';
                        if( $this->SiteSettings[5]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Rating</label>
                      </div>
                      <small class="text-muted">Turn the Rating section on or off in the Service Details page.</small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="service_details_review_graph"';
                        if( $this->SiteSettings[6]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Review Graph</label>
                      </div>
                      <small class="text-muted">Turn the Review Graph section on or off in the Service Details page.</small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="service_details_reviews"';
                        if( $this->SiteSettings[7]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Reviews</label>
                      </div>
                      <small class="text-muted">Turn the Reviews section on or off in the Service Details page.</small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="service_details_comments"';
                        if( $this->SiteSettings[8]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Comments</label>
                      </div>
                      <small class="text-muted">Turn the Comments section on or off in the Service Details page.</small>
                    </div>

                    <div class="col-lg-12 form-group">
                      <button class="btn btn-primary btn-block mt-0" type="submit">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Navigation Bar Settings Card -->
          
          <div class="accordion" id="policies">
            <div class="card">
              <div class="card-header">
                <h3 class="accordion-heading">
                  <a href="#card4" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="card4">
                  Navigation Bar Settings<span class="accordion-indicator"><i data-feather="chevron-up"></i></span>
                  </a>
                </h3>
              </div>
              <div class="collapse" id="card4" data-parent="#policies">
                <form class="needs-validation" method="POST" autocomplete="off" novalidate id="settings-form">
                  <input type="hidden" name="form" value="navigation_bar">
                  <div class="card-body font-size-md">                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="login_button"';
                        if( $this->SiteSettings[9]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= '>
                        <label class="form-check-label">Login</label>
                      </div>
                      <small class="text-muted">Turn account sign in on or off.<br><span class="text-danger">Suggestion: Bookmark the >> <a href="/SignIn">Sign In</a> << page to come back here after the button has been removed.</span></small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="cart_button"';
                        if( $this->SiteSettings[10]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Shopping Cart</label>
                      </div>
                      <small class="text-muted">Allow people to make purchases or just see the menu.</small>
                    </div>
                    
                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="navbar_search"';
                        if( $this->SiteSettings[11]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Navigation Bar Search</label>
                      </div>
                      <small class="text-muted">Allow people to search for items using the navigation bar.</small>
                    </div>

                    <div class="col-lg-12 form-group">
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="navbar_menu"';
                        if( $this->SiteSettings[12]['value'] == 'on' ){ $this->content .= ' checked'; }
                        $this->content .= ' disabled>
                        <label class="form-check-label">Navigation Bar Services Menu</label>
                      </div>
                      <small class="text-muted">Turn the left menu in the nagivation bar on or off.</small>
                    </div>

                    <div class="col-lg-12 form-group">
                      <button class="btn btn-primary btn-block mt-0" type="submit">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
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