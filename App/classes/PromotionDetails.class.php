<?php

require_once 'autoloader.php';

class PromotionDetails extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . ' - Promotion Details';
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
   * getPromotion - Retrieve the promotion's details from the database
   *
   * @return array data
   */
  public function getPromotion()
  {
    $URL = explode( '/', $_GET['url'] );
    return $this->db->query_DB("SELECT * FROM service_promotions WHERE id = '" . $URL[2] . "'")[0];
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
   * getLocationsList - Returns a list of locations
   * 
   * @param array locations
   *
   * @return string locations
   */
  public function getLocationsList( $locations )
  {
    $output;
    // Process all locations
    for( $i=0; $i<sizeof( $locations ); $i++ ){
      // Add city
      $output .= '<li>' . $locations[$i]['city'] . '</li>';
    }

    return $output;
  }

  /**
   * getService - Returns the data of a service
   * 
   * @param int ServiceID
   *
   * @return data
   */
  public function getService( $id )
  {
    return $this->db->query_DB("SELECT * FROM services WHERE id = '" . $id . "'")[0];
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
    // Retrieve the promotion
    $promotion = $this->getPromotion();
    $service = $this->getService( $promotion['service'] );

    // Set the page header
    $this->content .= '

      <!-- Service Name & Breadcrumbs -->

      <div class="page-title-overlap bg-light pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark">
                <li class="breadcrumb-item"><a class="text-nowrap" href="/Home"><i class="czi-home"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="/SpecialOffers">Promotions</a></li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">' . $service['name'] . '</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <h1 class="h3 text-dark mb-0">' . $service['name'] . '</h1>
          </div>
        </div>
      </div>
      
      <!-- Page Content (White box) -->
      
      <div class="container">

        <!-- Gallery + details-->
      
        <div class="bg-light box-shadow-lg rounded-lg px-4 py-3 mb-5">
          <div class="px-lg-3">
            <div class="row">

              <!-- Product gallery-->

              <div class="col-lg-7 pr-lg-0 pt-lg-4">
                <div class="cz-product-gallery">
                  <div class="cz-preview order-sm-2">
                    <div class="cz-preview-item active" id="first"><img class="cz-image-zoom" src="' . $service['image_one'] . '" data-zoom="' . $service['image_one'] . '" alt="' . $service['image_one_description'] . '">
                      <div class="cz-image-zoom-pane"></div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Product details-->
              
              <div class="col-lg-5 pt-4 pt-lg-0">
                <div class="product-details ml-auto pb-3">              
                  <div class="position-relative mr-n4 mb-3">
                    <div class="product-badge product-available mt-n1"><i class="czi-security-check"></i>Limited Time Offer</div>
                  </div>

                  <div class="mb-3">
                    <span class="h3 font-weight-normal text-accent mr-1">$' . explode(".", $promotion['price'])[0] . '.<small>' . explode(".", $promotion['price'])[1] . '</small></span>
                    <del class="text-danger font-size-lg mr-3">$' . explode(".", $service['price'])[0] . '.<small>' . explode(".", $service['price'])[1] . '</small></del>
                    <span class="badge badge-danger badge-shadow align-middle mt-n2">Sale</span>
                  </div>

                  <div class="card-body py-0 pb-2">
                    <label class="font-weight-medium text-dark">Base Service</label>
                    <ul class="list-unstyled font-size-sm">';
          
                  if( $service['steps'] != '' ){
                    $steps = explode( "\n" , $service['steps'] );
                    foreach ($steps as &$step) {
                      $this->content .= '
                      <li class="d-flex align-items-center"><i class="czi-check-circle text-success mr-1"></i><span class="font-size-ms">' . $step . '</span></li>';
                    }
                  }
        
                  $this->content .= '
                    </ul>
                  </div>
                </div>
                  
                <!-- Product panels-->

                <div class="product-details ml-auto pb-3">
              ';
    
              // If we have add-ons to show
              if( $service['addons'] != '' ){
    
                // Get the addons details
                $addons = $this->getAddons( $service['addons'] );
                
                $this->content .= '
                  <!-- Add-ons -->

                  <div class="card">
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
                    </div>
                  ';
                }

                $this->content .= '
                  </div>
                ';
              }
    
    // If enabled
    if( $this->SiteSettings[10][2] == 'yes' ){
      $this->content .= '
                  <button class="btn btn-primary btn-shadow btn-block mt-4" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-lg mr-2"></i>Add to Cart</button>
      ';
    }
              $this->content .= '
                  <br>

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
                          <ul class="font-size-sm pl-4">
                            ';

        // Add list of locations
        $this->content .= $this->getLocationsList( $this->getLocations( $service['locations'] ) );
              
                  $this->content .= '   
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Service description + Reviews + Comments-->
    
      <section class="container mb-4 mb-lg-5">
        
        <!-- Nav tabs-->
        
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link p-4 active" href="#details" data-toggle="tab" role="tab">Service details</a></li>
        </ul>
        
        <!-- Content of tabs -->

        <div class="tab-content pt-2">

          <!-- Service details tab-->

          <div class="tab-pane fade show active" id="details" role="tabpanel">
            <div class="row">
              <div class="col-lg-8">
                <p class="font-size-md">' . $service['description'] . '</p>
              </div>
            </div>
          </div>
          
        </div>

      </section>
    ';

    parent::Display();
  }

}

?>