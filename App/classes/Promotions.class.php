<?php

require_once 'autoloader.php';

class Promotions extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . ' - Special Offers / Promotions';
  }

  /**
   * getPromotions
   *
   * @return array promotions
   */
  public function getPromotions()
  {
    return $this->db->query_DB("SELECT * FROM service_promotions WHERE expiration >= CURDATE()");
  }

  /**
   * getCategories
   *
   * @return data
   */
  public function getCategories()
  {
    return $this->db->query_DB("SELECT * FROM service_categories ORDER BY id ASC");
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
      $output .= $locations[$i]['city'];

      // Add comma and space if applies
      if( $i < sizeof( $locations )-1 ){
        $output .= ', ';
      }
    }

    return $output;
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
    // Retrieve the Promotions
    $promotions = $this->getPromotions();

    // Retrieve the filter categories
    $cats = $this->getCategories();
    
    // Set the page header
    $this->content .= '
    <!-- Recent products grid-->

    <section class="container pb-5 mb-lg-3">
    
      <!-- Heading-->
      
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">

        <h2 class="h3 mb-0 pt-3 mr-2">Service Promotions</h2>';

    // Add the filter widget
    $ServicesFilter = new ServicesFilter( $cats );
    $this->content .= $ServicesFilter->Display();

    $this->content .= '
      </div>
      
      <!-- Grid-->
      
      <div class="row pt-2 mx-n2">';
    
    if( count( $promotions ) > 0 ){

      foreach( $promotions as $entry ){
        $service = $this->getService( $entry['service'] );
        
        $this->content .= '

        <!-- Offer Card -->

        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter hideable" data-category="' . $service['category'] . '">
          <div class="card product-card-alt">
            <!-- Card Image -->
            <div class="product-thumb">
              <div class="product-card-actions">
                <a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="/Promotions/Details/' . $entry['id'] . '"><i class="czi-eye"></i></a>';
          
          // If enabled, show the cart button
          if( $this->SiteSettings[10]['value'] == 'yes' ){ 
            $this->content .= '
                <button class="btn btn-light btn-icon btn-shadow font-size-base mx-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart"></i></button>';
          }

          $this->content .= '
              </div>
              <a class="product-thumb-overlay" href="/Promotions/Details/' . $entry['id'] . '"></a><img src="' . $service['image_one'] . '" alt="' . $service['image_one_description'] . '">
            </div>
            <!-- Card Contents -->
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted font-size-xs mr-1">';

        $locations = $this->getLocations( $service['locations'] );
        
        // Add list of locations
        $this->content .= $this->getLocationsList( $locations );
        
        $this->content .= '
                </div>
                <!-- <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i></div> -->
              </div>
              <h3 class="product-title font-size-sm mb-2"><a href="/Promotions/Details/1">' . $service['name'] . '</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="font-size-sm mr-2"><i class="czi-time text-muted mr-1"></i>' . $service['duration'] . ' <span class="font-size-xs ml-1">mins</span></div>
                <div class="bg-faded-accent text-accent rounded-sm py-1 px-2">$' . explode(".", $entry['price'])[0] . '.<small>' . explode(".", $entry['price'])[1] . '</small> | 
                  <del class="text-danger font-size-lg mr-3">$' . explode(".", $service['price'])[0] . '.<small>' . explode(".", $service['price'])[1] . '</small></del>
                </div>
              </div>
            </div>
          </div>
        </div>
        ';
      }

    }
    else{
      $this->content .= '<h2>We currently have no running promotions.  Please check back later.</h2>';
    }
        
    $this->content .= '
      
      <!-- More button-->

      <!-- <div class="text-center"><a class="btn btn-outline-accent" href="marketplace-category.html">View more offers<i class="czi-arrow-right font-size-ms ml-1"></i></a></div> -->

      </div>
    </section>
    ';

    $ServicesFilterJS = new ServicesFilterJS();
    $this->content .= $ServicesFilterJS->Display();

    parent::Display();
  }

}

?>