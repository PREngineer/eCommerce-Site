<?php

class AdministrationSideBar
{
  //------------------------- Attributes -------------------------
  private $SiteSettings;
    
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct( $SiteSettings )
  {
    $this->SiteSettings = $SiteSettings;
  }
  
  /**
   * Display - Returns the HTML of the Administration Side Bar
   *
   * @return string BusinessPolicySideBar
   */
  public function Display()
  {
    $URL = explode( '/', $_GET['url'] );
        
    $out .= '
          <!-- Sidebar-->

          <aside class="col-lg-4">

            <!-- Sidebar-->

            <div class="cz-sidebar rounded-lg box-shadow-lg" id="admin-sidebar">
              <div class="cz-sidebar-header box-shadow-sm">
                <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span class="d-inline-block font-size-xs font-weight-normal align-middle">Close sidebar</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">&times;</span></button>
              </div>
              <div class="cz-sidebar-body" data-simplebar data-simplebar-auto-hide="true">

                <!-- Categories-->

                <div class="widget widget-categories mb-4 pb-4">
                  <h3 class="widget-title">Administrative Options</h3>
                  <div class="accordion mt-n1" id="admin-categories">        
          
                    <!-- Site Settings -->

                    <div class="card">
                      <div class="card-header">
                        <h3 class="accordion-heading">
                          <a';

    if( $URL[0] == 'Administration' && $URL[1] == 'SiteSettings' ){ $out .= ' class="active"'; } else{ $out .= ' class="collapsed"'; }
                    
                  $out .= ' href="/Administration/SiteSettings">
                            Site Settings
                          </a>
                        </h3>
                      </div>
                    </div>';

    // Business Locations
    $out .= ' 
                    <!-- Business Locations -->
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="accordion-heading">
                          <a';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewBusinessLocation' || $URL[1] == 'BusinessLocation' ) ){ $out .= ' class="active"'; }
      else{ $out .= ' class="collapsed"'; }
              
                  $out .= ' href="#businesslocations" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="businesslocations">
                            Business Locations<span class="accordion-indicator"></span>
                          </a>
                        </h3>
                      </div>
                    <div';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewBusinessLocation' || $URL[1] == 'BusinessLocation' ) ){  }
      else{ $out .= ' class="collapse"'; }
                        
          $out .= ' id="businesslocations" data-parent="#admin-categories">
                  <div class="card-body">
                    <div class="widget widget-links">
                      <ul class="widget-list-list pt-1" style="height: 4rem;" data-simplebar data-simplebar-auto-hide="false">
                        <li class="widget-list-item-item">
                          <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'NewBusinessLocation' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                
                  $out .= ' d-flex justify-content-between align-items-center" href="/Administration/NewBusinessLocation"><span class="cz-filter-item-text">
                            New Location</span><span class="font-size-xs text-muted ml-3"></span>
                          </a>
                        </li>
                        <li class="widget-list-item-item">
                          <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'BusinessLocation' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                
                  $out .= ' d-flex justify-content-between align-items-center" href="/Administration/BusinessLocation"><span class="cz-filter-item-text">
                            Edit Location</span><span class="font-size-xs text-muted ml-3"></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>';

    // Home Page Banners
    $out .= ' 
                    <!-- Home Page Banners -->
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="accordion-heading">
                          <a';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewBanner' || $URL[1] == 'Banner' ) ){ $out .= ' class="active"'; }
      else{ $out .= ' class="collapsed"'; }
              
                  $out .= ' href="#banners" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="banners">
                            Home Page Banners<span class="accordion-indicator"></span>
                          </a>
                        </h3>
                      </div>
                    <div';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewBanner' || $URL[1] == 'Banner' ) ){  }
      else{ $out .= ' class="collapse"'; }
                        
          $out .= ' id="banners" data-parent="#admin-categories">
                  <div class="card-body">
                    <div class="widget widget-links">
                      <ul class="widget-list-list pt-1" style="height: 4rem;" data-simplebar data-simplebar-auto-hide="false">
                        <li class="widget-list-item-item">
                          <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'NewBanner' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                
                  $out .= ' d-flex justify-content-between align-items-center" href="/Administration/NewBanner"><span class="cz-filter-item-text">
                            New Banner</span><span class="font-size-xs text-muted ml-3"></span>
                          </a>
                        </li>
                        <li class="widget-list-item-item">
                          <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'Banner' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                
                  $out .= ' d-flex justify-content-between align-items-center" href="/Administration/Banner"><span class="cz-filter-item-text">
                            Edit Banner</span><span class="font-size-xs text-muted ml-3"></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>';

    // If Products enabled
    if( $this->SiteSettings[14]['value'] == 'on' ){
                  $out .= ' 
                    
                    <!-- Products -->
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="accordion-heading">
                          <a';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewProduct' || $URL[1] == 'EditProduct' ) ){ $out .= ' class="active"'; } else{ $out .= ' class="collapsed"'; }
                    
                  $out .= ' href="#products" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="products">
                            Products<span class="accordion-indicator"></span>
                          </a>
                        </h3>
                      </div>
                      <div';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewProduct' || $URL[1] == 'EditProduct' ) ){  } else{ $out .= ' class="collapse"'; }
                              
                $out .= ' id="products" data-parent="#admin-categories">
                        <div class="card-body">
                          <div class="widget widget-links">
                            <ul class="widget-list-list pt-1" style="height: 4rem;" data-simplebar data-simplebar-auto-hide="false">
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'NewProduct' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/NewProduct"><span class="cz-filter-item-text">
                                  New Product</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'EditProduct' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/EditProduct"><span class="cz-filter-item-text">
                                  Edit Product</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>';
    }

    // If Promotions enabled
    if( $this->SiteSettings[15]['value'] == 'on' ){
      $out .= ' 

              <!-- Promotions -->
              
              <div class="card">
                <div class="card-header">
                  <h3 class="accordion-heading">
                    <a';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewPromotion' || $URL[1] == 'Promotion' ) ){ $out .= ' class="active"'; } else{ $out .= ' class="collapsed"'; }
              
            $out .= ' href="#promotions" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="promotions">
                      Promotions<span class="accordion-indicator"></span>
                    </a>
                  </h3>
                </div>
                <div';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewPromotion' || $URL[1] == 'Promotion' ) ){  } else{ $out .= ' class="collapse"'; }
                        
        $out .= ' id="promotions" data-parent="#admin-categories">
                  <div class="card-body">
                    <div class="widget widget-links">
                      <ul class="widget-list-list pt-1" style="height: 4rem;" data-simplebar data-simplebar-auto-hide="false">
                        <li class="widget-list-item-item">
                          <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'NewPromotion' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                  
                  $out .= ' d-flex justify-content-between align-items-center" href="/Administration/NewPromotion"><span class="cz-filter-item-text">
                            New Promotion</span><span class="font-size-xs text-muted ml-3"></span>
                          </a>
                        </li>
                        <li class="widget-list-item-item">
                          <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'Promotion' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                  
                  $out .= ' d-flex justify-content-between align-items-center" href="/Administration/Promotion"><span class="cz-filter-item-text">
                            Edit Promotion</span><span class="font-size-xs text-muted ml-3"></span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>';
    }

    // If Services enabled
    if( $this->SiteSettings[13]['value'] == 'on' ){
            $out .= ' 

                    <!-- Services -->
                    
                    <div class="card">
                      <div class="card-header">
                        <h3 class="accordion-heading">
                          <a';

      if( $URL[0] == 'Administration' && ( $URL[1] == 'NewService' || $URL[1] == 'Service' || $URL[1] == 'NewServiceAddon' || $URL[1] == 'ServiceAddon' || $URL[1] == 'NewServiceCategory' || $URL[1] == 'ServiceCategory' ) ){ 
                  $out .= ' class="active"';
      }
      else{ $out .= ' class="collapsed"'; }
                    
                  $out .= ' href="#services" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="services">
                            Services<span class="accordion-indicator"></span>
                          </a>
                        </h3>
                      </div>
                      <div';

      if( $URL[0] == 'Administration' && 
          ( $URL[1] == 'NewService' || $URL[1] == 'Service' || $URL[1] == 'NewServiceAddon' || $URL[1] == 'ServiceAddon' || $URL[1] == 'NewServiceCategory' || $URL[1] == 'ServiceCategory' ) ){  }
      else{ $out .= ' class="collapse"'; }
                              
                $out .= ' id="services" data-parent="#admin-categories">
                        <div class="card-body">
                          <div class="widget widget-links">
                            <ul class="widget-list-list pt-1" style="height: 10rem;" data-simplebar data-simplebar-auto-hide="false">
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'NewService' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/NewService"><span class="cz-filter-item-text">
                                  New Service</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'Service' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/Service"><span class="cz-filter-item-text">
                                  Edit Service</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'NewServiceAddon' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/NewServiceAddon"><span class="cz-filter-item-text">
                                  New Add-on</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'ServiceAddon' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/ServiceAddon"><span class="cz-filter-item-text">
                                  Edit Add-on</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'NewServiceCategory' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/NewServiceCategory"><span class="cz-filter-item-text">
                                  New Category</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                              <li class="widget-list-item-item">
                                <a class="';

      if( $URL[0] == 'Administration' && $URL[1] == 'ServiceCategory' ){ $out .= 'active'; } else{ $out .= 'widget-list-link'; }
                                        
                        $out .= ' d-flex justify-content-between align-items-center" href="/Administration/ServiceCategory"><span class="cz-filter-item-text">
                                  Edit Category</span><span class="font-size-xs text-muted ml-3"></span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>';
    }

          $out .= ' 
                  </div>
                </div>

              </div>
            </div>
          </aside>
    ';

    return $out;
  }

}

?>