<?php

require_once 'autoloader.php';

class Locations extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Locations";
  }

  /**
   * GetLocations
   *
   * @return data
   */
  public function GetLocations()
  {
    return $this->db->query_DB("SELECT * FROM locations");
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
    // Retrieve the locations data
    $data = $this->GetLocations();

    // Set the page header
    $this->content .= '
    <!-- Store Location Cards -->

    <section class="container pt-4 mt-md-4 mb-5">
      <h1 class="h3 mb-3">Our Locations</h1>
      <div class="row pt-4">';
        
      foreach ($data as &$entry) {
        $this->content .= '
        <!-- Store Card -->
          
        <div class="col-lg-4 col-sm-6 mb-grid-gutter">
          <div class="card border-0 box-shadow"><img class="card-img-top" src="' . $entry['photo'] . '" alt="' . $entry['city'] . ', ' . $entry['state'] . '"/>
            <div class="card-body">
              <h6>' . $entry['city'] . ', ' . $entry['state'] . '</h6>
              <ul class="list-unstyled mb-0">
                <li class="media pb-3 border-bottom"><i class="czi-location font-size-lg mt-2 mb-0 text-primary"></i>
                  <div class="media-body pl-3">
                  <span class="font-size-ms text-muted">Find Us</span>
                  <a class="d-block text-heading font-size-sm">' . $entry['address'] . ', ' . $entry['city'] . ', ' . $entry['state'] . ' ' . $entry['zip'] . ' ' . $entry['country'] . '</a>
                  <a class="pt-2" target="_blank" href="http://maps.apple.com/?ll=' . $entry['latitude'] . ',' . $entry['longitude'] . '"><img src="/images/icons/amaps.png"/></a>
                  <a class="pt-2" target="_blank" href="https://www.google.com/maps/search/?api=1&query=' . $entry['latitude'] . '%2C' . $entry['longitude'] . '"><img src="/images/icons/gmaps.png"/></a>
                  </div>
                </li>
                <li class="media pt-2 pb-3 border-bottom"><i class="czi-phone font-size-lg mt-2 mb-0 text-primary"></i>
                  <div class="media-body pl-3"><span class="font-size-ms text-muted">Call Us</span><a class="d-block text-heading font-size-sm" href="tel:+' . $entry['phone'] . '">+' . $entry['phone_pretty'] . '</a></div>
                </li>
                <li class="media pt-2"><i class="czi-mail font-size-lg mt-2 mb-0 text-primary"></i>
                  <div class="media-body pl-3"><span class="font-size-ms text-muted">Message Us</span><a class="d-block text-heading font-size-sm" href="mailto:' . $entry['email'] . '">' . $entry['email'] . '</a></div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        ';
      }

    $this->content .= '        
      </div>
    </section>
    ';

    parent::Display();
  }

}

?>