<?php

require_once 'autoloader.php';

class BusinessPolicy extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . ' - Business Policy';
  }

  /**
   * GetData
   *
   * @return data
   */
  public function GetData()
  {
    return $this->db->query_DB("SELECT * FROM business_policies ORDER BY position ASC");
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

    // Set the page header
    $this->content .= '
    <div class="container py-5 mt-md-2 mb-2">
      <div class="row">
    ';
        
    $SideBar = new BusinessPolicySideBar();
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Content -->

        <div class="col-lg-9">
          <h2 class="h4 pb-3">Business Policies</h2>
          <div class="accordion" id="policies">

          <!-- Policy Cards -->
          ';
        
          foreach ($data as &$entry) {
            $this->content .= '
            <!-- Card -->

            <div class="card">
              <div class="card-header">
                <h3 class="accordion-heading">
                  <a href="#policy' . $entry['position'] . '" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="policy' . $entry['position'] . '">
                  ' . $entry['name'] . '<span class="accordion-indicator"><i data-feather="chevron-up"></i></span>
                  </a>
                </h3>
              </div>
              <div class="collapse show" id="policy' . $entry['position'] . '" data-parent="#policies">
                <div class="card-body font-size-md">
                  <p>' . $entry['content'] . '</p>
                </div>
              </div>
            </div>
            ';
          }
    
          $this->content .= '
          </div>
        </div>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>