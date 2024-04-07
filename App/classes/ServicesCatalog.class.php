<?php

require_once 'autoloader.php';

class ServicesCatalog extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . ' - Our Services';
  }

  /**
   * GetCategories
   *
   * @return data
   */
  public function getCategories()
  {
    return $this->db->query_DB("SELECT * FROM service_categories ORDER BY id ASC");
  }

  /**
   * getService
   *
   * @return array data
   */
  public function getService()
  {
    return $this->db->query_DB("SELECT * FROM services");
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
    // Retrieve the Service
    $service = $this->getService();

    // Retrieve the filter categories
    $cats = $this->getCategories();

    // Set the page header
    $this->content .= '
      <!-- Heading-->
      
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2">Our Services</h2>';

    $ServicesFilter = new ServicesFilter( $cats );
    $this->content .= $ServicesFilter->Display();

    $this->content .= '
      </div>

      <!-- Service grid-->
      
      <div class="row pt-3 mx-n2">
      ';
        
      foreach( $service as $entry ){
        $this->content .= '
        <!-- Service Card -->

        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4 hideable" data-category="' . $entry['category'] . '">
          <div class="card product-card">
            <a class="card-img-top d-block overflow-hidden" href="/Services/Details/' . $entry['id'] . '"><img src="' . $entry['image_one'] . '" alt="' . $entry['image_one_description'] . '"></a>
            <div class="card-body py-2">
              <span class="product-meta d-block font-size-xs pb-1">';

            $locations = $this->getLocations( $entry['locations'] );
            for( $i=0; $i<sizeof( $locations ); $i++ ){
              $this->content .= $locations[$i]['city'];
              if( $i < sizeof( $locations )-1 ){
                $this->content .= ', ';
              }
            }
  
      $this->content .= '
              </span>
              <h3 class="product-title font-size-sm">
                <a href="/Services/Details/' . $entry['id'] . '">' . $entry['name'] . '</a>
              </h3>
              <div class="d-flex justify-content-between">
                <div class="font-size-sm mr-2"><i class="czi-time text-muted mr-1"></i>' . $entry['duration'] . ' <span class="font-size-xs ml-1">mins</span></div>
                <div class="product-price"><span class="text-accent">$' . explode(".", $entry['price'])[0] . '.<small>' . explode(".", $entry['price'])[1] . '</small></span></div>
              </div>
            </div>
            <!--
            <div class="card-body card-body-hidden">
              <button class="btn btn-primary btn-sm btn-block mb-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>
              <div class="text-center"><a class="nav-link-style font-size-ms" href="/Services/Details/' . $entry['id'] . '"><i class="czi-eye align-middle mr-1"></i>View Details</a></div>
            </div>
            -->
          </div>
        </div>
        ';
      }

    $this->content .= '
      </div>
    ';

    $ServicesFilterJS = new ServicesFilterJS();
    $this->content .= $ServicesFilterJS->Display();

    parent::Display();
  }

}

?>