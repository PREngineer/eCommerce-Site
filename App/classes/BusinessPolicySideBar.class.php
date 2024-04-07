<?php

class BusinessPolicySideBar
{
  //------------------------- Attributes -------------------------
  
    
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    
  }
  
  /**
   * Display - Returns the HTML of the Business Policy Side Bar
   *
   * @return string BusinessPolicySideBar
   */
  public function Display()
  {
    $out .= '
          <!-- Column for Sidebar -->

          <div class="col-lg-3">

            <!-- Sidebar with links -->
            
            <div class="cz-sidebar border-right" id="help-sidebar">
              
              <!-- Header -->

              <div class="cz-sidebar-header box-shadow-sm">
                <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close">
                  <span class="d-inline-block font-size-xs font-weight-normal align-middle">Close sidebar</span><span class="d-inline-block align-middle ml-2" aria-hidden="true">×</span>
                </button>
              </div>

              <!-- Body -->

              <div class="cz-sidebar-body py-lg-1 pl-lg-0" data-simplebar="init" data-simplebar-auto-hide="true">
                <div class="simplebar-wrapper" style="margin: -4px -16px -4px 0px;">
                  <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                  </div>
                  <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                      <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden; padding-right: 0px; padding-bottom: 0px;">
                        <div class="simplebar-content" style="padding: 4px 16px 4px 0px;">
                          
                          <!-- Links-->
                          
                          <div class="widget widget-links">
                            <h3 class="widget-title">FAQs & Legal</h3>
                            <ul class="widget-list">
                              <li class="widget-list-item"><a class="widget-list-link" href="/AboutUs"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>About Us</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="/BusinessPolicy"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Business Policy</a></li>
                              <!-- li class="widget-list-item"><a class="widget-list-link" href="/Careers"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Careers</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="/News"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>News</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="/Privacy"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Privacy</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="/Support"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Support</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="/TOS"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Terms Of Use</a></li>
                              <li class="widget-list-item"><a class="widget-list-link" href="/AccountPolicy"><i class="czi-book text-muted align-middle mt-n1 mr-1"></i>Account Policy</a></li> -->
                            </ul>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>        
                  <div class="simplebar-placeholder" style="width: auto; height: 364px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                  <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                </div>        
                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                  <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                </div>
              </div>

            </div>
          </div>
    ';

    return $out;
  }

}

?>