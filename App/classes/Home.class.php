<?php

require_once 'autoloader.php';

class Home extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - " . $this->SiteSettings[1]['value'];
  }

  /**
   * GetHero
   *
   * @return data
   */
  public function GetHero()
  {
    return $this->db->query_DB("SELECT * FROM home_carousel");
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
    // Retrieve the hero data
    $data = $this->GetHero();

    // Set the page header
    $this->content .= '
    <!-- Hero slider-->

    <section class="cz-carousel cz-controls-lg mb-4 mb-lg-5">
      <div class="cz-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: false},&quot;992&quot;:{&quot;nav&quot;:false, &quot;controls&quot;: true}}}">
    ';
        
      foreach ($data as &$entry) {
        $this->content .= '
        <!-- Item -->
        
        <div class="px-lg-5" style="background-color: #' . $entry['bg_color'] . ';">
          <div class="d-lg-flex justify-content-between align-items-center pl-lg-4">
            <img class="d-block order-lg-2 mr-lg-n5 flex-shrink-0" src="' . $entry['image_source'] . '" alt="' . $entry['image_alt_text'] . '">
            <div class="position-relative mx-auto mr-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">
              <div class="pb-lg-5 mb-lg-5 text-center text-lg-left text-lg-nowrap">
                <h2 class="text-light font-weight-light pb-1 from-bottom">' . $entry['top_text'] . '</h2>
                <h1 class="text-light display-4 from-bottom delay-1">' . $entry['middle_text'] . '</h1>
                <p class="font-size-lg text-light pb-3 from-bottom delay-2">' . $entry['lower_text'] . '</p>
                <a class="btn btn-primary scale-up delay-4" href="' . $entry['url'] . '">Shop Now<i class="czi-arrow-right ml-2 mr-n1"></i></a>
              </div>
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