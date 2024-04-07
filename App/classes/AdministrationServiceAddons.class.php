<?php

require_once 'autoloader.php';

class AdministrationServiceAddons extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Service Add-ons";
  }

  /**
   * getServiceAddons - Retrieves all the Service Add-ons from the database
   *
   * @return array
   */
  public function getServiceAddons()
  {
    return $this->db->query_DB( "SELECT * FROM service_addons ORDER BY name ASC" );
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
    // Grab the necessary information from the database
    $addons = $this->getServiceAddons();

    // Set the page header
    $this->content .= '
    <!-- Warning Modal -->
    <div class="modal fade" id="warning-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-danger">Warning!</h3>
          </div>
          <div class="modal-body tab-content py-4">
            <p class="text-danger">Deleting this add-on will also remove it from all the Services and Promotions that currently have it as an option.</p>
          </div>
          <div class="modal-body tab-content py-4">
            <a href="#warning-modal" class="btn btn-danger col-sm-5" type="submit" data-toggle="modal">No, Don\'t Delete!</a>
            <a href="#" class="btn btn-success col-sm-5" type="submit" id="destination">Yes, Delete!</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Service Add-ons</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Service Add-ons</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Column for Content -->

        <section class="col-lg-8">

          <!-- Light table with hoverable rows -->

          <div class="table-responsive">            
            <table class="table table-hover">
              <thead;>
                <tr>
                  <th>Add-on</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>';

    foreach( $addons as $addon ){
      $this->content .= '
                <tr>
                  <th scope="row"> ' . $addon['name'] . '
                  </th>
                  <td>
                    <a href="/Administration/ServiceAddon/Edit/' . $addon['id'] . '" class="text-warning"><span class="ci-edit-alt"></span></a>
                  </td>
                  <td>
                    <a href="#warning-modal" class="text-danger" data-toggle="modal" onClick="updateURL( ' . $addon['id'] . ' )"><span class="ci-trash"></span></a>
                  </td>
                </tr>';
    }
              
      $this->content .= '
              </tbody>
            </table>
          </div>

          <!-- Script to handle modal URLs -->
          <script>
            function updateURL( id ){
              var link = document.getElementById("destination");
              link.getAttribute("href");
              link.setAttribute("href", "/Administration/ServiceAddon/Delete/" + id);              
            }
          </script>

        </section>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>