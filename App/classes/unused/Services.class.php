<?php

require_once 'autoloader.php';

class Services extends Page
{
  
  //------------------------- Attributes -------------------------
  public $content = '';
  public $title = "Meet Spa - Services";
  private $db;
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->db = new Database();
    parent::__construct();
  }

  /**
   * GetData
   *
   * @return data
   */
  public function GetData()
  {
    return $this->db->query_DB("SELECT * FROM services LIMIT 8");
  }

  /**
   * GetCategories
   *
   * @return data
   */
  public function GetCategories()
  {
    return $this->db->query_DB("SELECT DISTINCT category FROM services ORDER BY category ASC");
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
    $data = $this->GetData();

    // Retrieve the filter categories
    $cats = $this->GetCategories();
    
    // Set the page header
    $this->content .= '
    <!-- Recent products grid-->

    <section class="container pb-5 mb-lg-3">
    
      <!-- Heading-->
      
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
        <h2 class="h3 mb-0 pt-3 mr-2">Our Services</h2>
        
        <!-- All Services button-->
        
        <div class="pt-3">
          <a class="btn btn-outline-accent" href="/Services/Catalog">
            View All Services<i class="czi-arrow-right font-size-ms ml-1"></i>
          </a>
        </div>';

    $ServicesFilter = new ServicesFilter( $cats );
    $this->content .= $ServicesFilter->Display();

    $this->content .= '
      </div>
      
      <!-- Grid-->
      
      <div class="row pt-2 mx-n2">
      ';
        
      foreach ($data as &$entry) {
        $this->content .= '
        <!-- Service -->
      
        <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-grid-gutter hideable" data-category="' . $entry['category'] . '">
          <div class="card product-card-alt">
            <div class="product-thumb">
              <div class="product-card-actions"><a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="/Services/Details/1"><i class="czi-eye"></i></a>
                <button class="btn btn-light btn-icon btn-shadow font-size-base mx-2" type="button" data-toggle="toast" data-target="#cart-toast"><i class="czi-cart"></i></button>
              </div><a class="product-thumb-overlay" href="/Services/Details/1"></a><img src="' . $entry['image_one'] . '" alt="' . $entry['category'] . '">
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between align-items-start pb-2">
                <div class="text-muted font-size-xs mr-1">Locations: ' . $entry['locations'] . '</div>
                <!-- <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i></div> -->
              </div>
              <h3 class="product-title font-size-sm mb-2"><a href="/Services/Details/1">' . $entry['name'] . '</a></h3>
              <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="font-size-sm mr-2"><i class="czi-time text-muted mr-1"></i>' . $entry['duration'] . ' <span class="font-size-xs ml-1">mins</span></div>
                <div class="bg-faded-accent text-accent rounded-sm py-1 px-2">$' . $entry['price'] . '.<small>00</small></div>
              </div>
            </div>
          </div>
        </div>
        ';
      }

    $this->content .= '

    </section>
    ';

    $ServicesFilterJS = new ServicesFilterJS();
    $this->content .= $ServicesFilterJS->Display();

    parent::Display();
  }

}

?>