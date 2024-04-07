<?php

require_once 'autoloader.php';

class ServicesDetails extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . ' - Service Details';
  }

  /**
   * getAddons
   *
   * @return data
   */
  public function getAddons( $ids )
  {
    return $this->db->query_DB("SELECT * FROM service_addons WHERE id IN (" . $ids . ") ORDER BY price ASC");
  }
  
  /**
   * getData
   *
   * @return data
   */
  public function getData()
  {
    $URL = explode( '/', $_GET['url'] );
    return $this->db->query_DB("SELECT * FROM services WHERE id = '" . $URL[2] . "'")[0];
  }

  /**
   * getLocations
   *
   * @return data
   */
  public function getLocations( $locations )
  {
    return $this->db->query_DB("SELECT city FROM locations WHERE id IN ($locations)");
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
    // Retrieve the data
    $data = $this->getData();

    // Set the page header
    $this->content .= '
      <!-- Service Name & Breadcrumbs -->

      <div class="page-title-overlap bg-light pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark">
                <li class="breadcrumb-item"><a class="text-nowrap" href="/Home"><i class="czi-home"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="/Services">Services</a></li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">' . $data['name'] . '</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-dark mb-0">' . $data['name'] . '</h1>
          </div>
        </div>
      </div>
      
      <!-- Page Content (White box) -->
      
      <section class="container mb-3 pb-3">
        <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
          <div class="row">
      
            <!-- Content-->

            <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-lg-3">
              <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
        
                <!-- Service gallery-->

                <div class="cz-gallery">
                  <a class="gallery-item rounded-lg mb-grid-gutter" href="' . $data['image_one'] . '" data-sub-html="&lt;h6 class="font-size-sm text-light">
                    <img src="' . $data['image_one'] . '" alt="Gallery preview"/><span class="gallery-item-caption">' . $data['image_one_description'] . '</span>
                  </a>
                  <div class="row">
                    <div class="col-sm-6">
                      <a class="gallery-item rounded-lg mb-grid-gutter" href="' . $data['image_two'] . '" data-sub-html="&lt;h6 class="font-size-sm text-light">
                        <img src="' . $data['image_two'] . '" alt="Gallery preview"/><span class="gallery-item-caption">' . $data['image_two_description'] . '</span>
                      </a>
                    </div>
                    <div class="col-sm-6">
                      <a class="gallery-item rounded-lg mb-grid-gutter" href="' . $data['image_three'] . '" data-sub-html="&lt;h6 class="font-size-sm text-light">
                        <img src="' . $data['image_three'] . '" alt="Gallery preview"/><span class="gallery-item-caption">' . $data['image_three_description'] . '</span>
                      </a>
                    </div>
                  </div>
                </div>';
       
    // If enabled
    if( $this->SiteSettings[2]['value'] == 'on' ){
      $WishListShare = new ServicesWishListAndSharing();
      $this->content .= $WishListShare->Display();
    }

    $this->content .= '
              </div>
            </section>

            <!-- Sidebar-->
            
            <aside class="col-lg-4">
              <hr class="d-lg-none">
              <div class="cz-sidebar-static h-100 ml-auto border-left">
                <div class="accordion" id="services">
                  
                  <!-- Base Service -->

                  <div class="card border-bottom-0 border-left-0 border-right-0">
                    <div class="card-header d-flex justify-content-between align-items-center py-3 border-0">
                      <label class="font-weight-medium text-dark">Base Service</label>
                      <h5 class="mb-0 text-accent font-weight-normal">$' . explode(".", $data['price'])[0] . '.<small>' . explode(".", $data['price'])[1] . '</small></h5>
                    </div>
                    <div class="card-body py-0 pb-2">
                      <ul class="list-unstyled font-size-sm">';
          
          if( $data['steps'] != '' ){
            $steps = explode( "\n" , $data['steps'] );
            foreach ($steps as &$step) {
              $this->content .= '
                        <li class="d-flex align-items-center"><i class="czi-check-circle text-success mr-1"></i><span class="font-size-ms">' . $step . '</span></li>';
            }
          }

          $this->content .= '
                      </ul>
                    </div>
                  </div>
          ';

          // If we have add-ons to show
          if( $data['addons'] != '' ){

            // Get the addons details
            $addons = $this->getAddons( $data['addons'] );
            
            $this->content .= '
                  <!-- Add-ons -->

                  <div class="card border-bottom-0 border-left-0 border-right-0">
                    <div class="card-header d-flex justify-content-between align-items-center py-3 border-0">
                      <label class="font-weight-medium text-dark">Add-ons</label>
                    </div>
                    ';

                foreach ($addons as &$addon) {
                  $this->content .= '
                    <!-- Add-on -->

                    <div class="card-header d-flex justify-content-between align-items-center py-3 border-0">
                      <div class="custom-control custom-checkbox">
                        <input class="form-check-input" type="checkbox" name="' . $addon['id'] . '">
                        <label class="form-check-label" for="extraction">' . $addon['name'] . '</label>
                      </div>
                      <h5 class="mb-0 text-accent font-weight-normal">$' . explode(".", $addon['price'])[0] . '.<small>' . explode(".", $addon['price'])[1] . '</small></h5>
                    </div>';
                }
          }

          $this->content .= '
                  </div>

                  <hr>';
    // If enabled
    if( $this->SiteSettings[10]['value'] == 'on' ){
      $this->content .= '
                  <button class="btn btn-primary btn-shadow btn-block mt-4" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-lg mr-2"></i>Add to Cart</button>';
    }
    
    $this->content .= '
          
                  <br>

                  <!-- Additional Information -->

                  <div class="accordion mb-4" id="infoPanels">
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="accordion-heading">
                          <a href="#locationInfo" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="locationInfo">
                            <i class="czi-announcement text-muted font-size-lg align-middle mt-n1 mr-2"></i>Available Locations<span class="accordion-indicator"><i data-feather="chevron-up"></i></span>
                          </a>
                        </h3>
                      </div>                      
                      <div class="collapse show" id="locationInfo" data-parent="#infoPanels">
                        <div class="card-body">
                          <ul class="font-size-sm pl-4">';

          $locations = $this->getLocations( $data['locations'] );
          foreach ($locations as &$location) {
            $this->content .= '
                            <li>' . $location['city'] . '</li>
            ';
          }

    $this->content .= '                        
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="card border-bottom">
                      <div class="card-header">
                        <h3 class="accordion-heading">
                          <a href="#durationInfo" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="durationInfo">
                            <i class="czi-time text-muted font-size-lg align-middle mt-n1 mr-2"></i>Treatment Time<span class="accordion-indicator"><i data-feather="chevron-up"></i></span>
                          </a>
                        </h3>
                      </div>
                      <div class="collapse show" id="durationInfo" data-parent="#infoPanels">
                        <div class="card-body">
                          <div class="font-size-sm mr-2"><i class="czi-time text-muted mr-1"></i>' . $data['duration'] . ' <span class="font-size-xs ml-1">mins</span></div>
                        </div>
                      </div>
                    </div>';

                // If enabled
    if( $this->SiteSettings[4]['value'] == 'on' ){
      $ServicesSalesNumber = new ServicesSalesNumber();
      $this->content .= $ServicesSalesNumber->Display();
    }

    // If enabled
    if( $this->SiteSettings[5]['value'] == 'on' ){
      $ServicesRating = new ServicesRating();
      $this->content .= $ServicesRating->Display();
    }

    // If enabled
    if( $this->SiteSettings[3]['value'] == 'on' ){
      $ServicesCreator = new ServicesCreator();
      $this->content .= $ServicesCreator->Display();
    }
    
    $this->content .= '
                  </div>

                </div>
              </div>
            </aside>

          </div>
        </div>
      </section>

      <!-- Service description + Reviews + Comments-->
      
      <section class="container mb-4 mb-lg-5">

        <!-- Nav tabs-->

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link p-4 active" href="#details" data-toggle="tab" role="tab">Service Details</a></li>';
    // If enabled
    if( $this->SiteSettings[6]['value'] == 'on' || $this->SiteSettings[7]['value'] == 'on' ){
      $this->content .= '
          <li class="nav-item"><a class="nav-link p-4" href="#reviews" data-toggle="tab" role="tab">Reviews</a></li>';
    }
    // If enabled
    if( $this->SiteSettings[8]['value'] == 'on' ){
      $this->content .= '
          <li class="nav-item"><a class="nav-link p-4" href="#comments" data-toggle="tab" role="tab">Comments</a></li>';
    }

    $this->content .= '
        </ul>

        <!-- Contents -->

        <div class="tab-content pt-2">

          <!-- Service Details Tab-->

          <div class="tab-pane fade show active" id="details" role="tabpanel">
            <div class="row">
              <div class="col-lg-8">
                <p class="font-size-md">' . $data['description'] . '</p>            
              </div>
            </div>
          </div>

          <!-- Reviews tab-->
          
          <div class="tab-pane fade" id="reviews" role="tabpanel">';
      
    // If enabled
    if( $this->SiteSettings[6]['value'] == 'on' ){
      $ServiceReviewGraph = new ServicesDetailsReviewsGraph();
      $this->content .= $ServiceReviewGraph->Display();
    }

    // If enabled
    if( $this->SiteSettings[7]['value'] == 'on' ){
      $ServicesDetailsReviews = new ServicesDetailsReviews();
      $this->content .= $ServicesDetailsReviews->Display();
    }

      $this->content .= '
          
          </div>

          <!-- Comments tab-->
          
          <div class="tab-pane fade" id="comments" role="tabpanel">';

    // If enabled
    if( $this->SiteSettings[8]['value'] == 'on' ){
      $ServicesDetailsComments = new ServicesDetailsComments();
      $this->content .= $ServicesDetailsComments->Display();
    }
  
        $this->content .= '
          
          </div>
          
        </div>
      </section>
    ';

    parent::Display();
  }

}

?>