<?php

require_once 'autoloader.php';

class AdministrationDeleteHomeBanner extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Delete Home Banner";
  }

  /**
   * getHomeBanner - Retrieves the Home Banner data from the database
   *
   * @param int id
   * 
   * @return array
   */
  public function getHomeBanner( $id )
  {
    return $this->db->query_DB( "SELECT * FROM home_carousel WHERE id = '" . $id . "'" )[0];
  }

  /**
   * deleteHomeBanner - Removes the home banner from the database
   *
   * @return bool
   */
  public function deleteHomeBanner( $id )
  {
    // Remove from database
    return $this->db->query_DB( "DELETE FROM home_carousel 
                                 WHERE id     = '" . $id . "'" );
  }

  /**
   * Display - Displays the full page
   *
   * @return void
   */
  public function Display()
  {
    // Get the data to process
    $URL = explode( '/', $_GET['url'] );
    $banner = $this->getHomeBanner( $URL[3] );
        
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/Banner">Home Banners</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Delete Home Banner</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Delete Home Banner</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    $bannersDeleted = $this->deleteHomeBanner( $URL[3] );

    // If successful at deleting
    if( $bannersDeleted == 1 ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Home banner deleted successfully!</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
    }
    else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while deleting the home banner!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
    }
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Column for Content -->

        <section class="col-lg-8">

          <!-- Table - Service Add-on Deleted -->

          <h5>Service Add-on Deleted:</h5>

          <div class="table-responsive">
            <table class="table table-hover">
              
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Top Text</th>
                  <th>Middle Text</th>
                  <th>Bottom Text</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">' . $banner['id']       . '</th>
                  <td>'             . $banner['top_text'] . '</td>
                  <td>'             . $banner['middle_text']     . '</td>
                  <td>'             . $banner['lower_text']    . '</td>
                </tr>
                </tr>
              </tbody>
            </table>
          </div>
          ';

  $this->content .= '
        </section>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>