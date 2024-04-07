<?php

class NavBarMenu
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
   * Display - Returns the HTML of the Nav Bar Services Menu
   *
   * @return string TopBar
   */
  public function Display()
  {
    $out .= '
              <!-- Services menu-->

              <ul class="navbar-nav mega-nav pr-lg-2 mr-lg-2">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle pl-0" href="#" data-toggle="dropdown"><i class="czi-menu align-middle mt-n1 mr-2"></i>Services</a>
                  <ul class="dropdown-menu">

                    <!-- Facials -->

                    <li class="dropdown mega-dropdown"><a class="dropdown-item dropdown-toggle" href="/Facials" data-toggle="dropdown">Facials</a>
                      <div class="dropdown-menu p-0">
                        <div class="d-flex flex-wrap flex-md-nowrap px-2">
                          <div class="mega-dropdown-column py-4 px-3">
                            <div class="widget widget-links">
                              <h6 class="font-size-base mb-3">Facials</h6>
                              <ul class="widget-list">
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/Facials/Basic">Basic Facials</a></li>
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/Facials/Seasonal">Seasonal Facials</a></li>
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/Facials/Advanced">Advanced Facials</a></li>
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/Facials/VIP">VIP Facials</a></li>
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/Facials/Premium">Premium Facials</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="mega-dropdown-column d-none d-lg-block py-4 text-center"><a class="d-block mb-2" href="#"><img src="/images/services/01.png" alt="Facials"/></a>
                            <div class="font-size-sm mb-3">Starting from <span class=\'font-weight-medium\'>$60.<small>00</small></span></div>
                            <a class="btn btn-primary btn-shadow btn-sm" href="/Facials/Offers">See offers<i class="czi-arrow-right font-size-xs ml-1"></i></a>
                          </div>
                        </div>
                      </div>
                    </li>

                    <!-- Head Spa -->
                    
                    <li class="dropdown mega-dropdown"><a class="dropdown-item dropdown-toggle" href="/HeadSpa" data-toggle="dropdown">Head Spa</a>
                      <div class="dropdown-menu p-0">
                        <div class="d-flex flex-wrap flex-md-nowrap px-2">
                          <div class="mega-dropdown-column py-4 px-3">
                            <div class="widget widget-links mb-3">
                              <h6 class="font-size-base mb-3">Head Spa</h6>
                              <ul class="widget-list">
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/HeadSpa/Scalp">Scalp Treatments</a></li>
                              </ul>
                            </div>
                          </div>                          
                          <div class="mega-dropdown-column d-none d-lg-block py-4 text-center"><a class="d-block mb-2" href="#"><img src="/images/services/02.png" alt="Head Spa"/></a>
                            <div class="font-size-sm mb-3">Starting from <span class=\'font-weight-medium\'>$80.<small>00</small></span></div>
                            <a class="btn btn-primary btn-shadow btn-sm" href="/HeadSpa/Offers">See offers<i class="czi-arrow-right font-size-xs ml-1"></i></a>
                          </div>
                        </div>
                      </div>
                    </li>

                    <!-- Laser Hair Removal -->
                    <!-- 
                    <li class="dropdown mega-dropdown"><a class="dropdown-item dropdown-toggle" href="/LaserHairRemoval" data-toggle="dropdown">Laser Hair Removal</a>
                      <div class="dropdown-menu p-0">
                        <div class="d-flex flex-wrap flex-md-nowrap px-2">
                          <div class="mega-dropdown-column py-4 px-3">
                            <div class="widget widget-links">
                              <h6 class="font-size-base mb-3">Laser Hair Removal</h6>
                              <ul class="widget-list">
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/LaserHairRemoval/Face">Face</a></li>  
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/LaserHairRemoval/Arms">Arms</a></li>
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/LaserHairRemoval/Legs">Legs</a></li>
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/LaserHairRemoval/Chest">Chest</a></li>
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/LaserHairRemoval/Back">Back</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="mega-dropdown-column d-none d-lg-block py-4 text-center"><a class="d-block mb-2" href="#"><img src="/images/services/03.png" alt="Laser Hair Removal"/></a>
                            <div class="font-size-sm mb-3">Starting from <span class=\'font-weight-medium\'>$90.<small>00</small></span></div>
                            <a class="btn btn-primary btn-shadow btn-sm" href="/LaserHairRemoval/Offers">See offers<i class="czi-arrow-right font-size-xs ml-1"></i></a>
                          </div>
                        </div>
                      </div>
                    </li>
                    -->
                    <li class="dropdown mega-dropdown"><a class="dropdown-item dropdown-toggle" href="/MicroCurrent" data-toggle="dropdown">Micro-current</a>
                      <div class="dropdown-menu p-0">
                        <div class="d-flex flex-wrap flex-md-nowrap px-2">
                          <div class="mega-dropdown-column py-4 px-3">
                            <div class="widget widget-links">
                              <h6 class="font-size-base mb-3">Micro-current</h6>
                              <ul class="widget-list">
                                <li class="widget-list-item pb-1"><a class="widget-list-link" href="/MicroCurrent/Unblock">Unblock Body Meridians</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="mega-dropdown-column d-none d-lg-block py-4 text-center"><a class="d-block mb-2" href="#"><img src="/images/services/04.png" alt="Micro-current"/></a>
                            <div class="font-size-sm mb-3">Starting from <span class=\'font-weight-medium\'>$210.<small>00</small></span></div>
                            <a class="btn btn-primary btn-shadow btn-sm" href="/MicroCurrent/Offers">See offers<i class="czi-arrow-right font-size-xs ml-1"></i></a>
                          </div>
                        </div>
                      </div>
                    </li>                    
                  </ul>
                </li>
              </ul>
    ';

    return $out;
  }

}

?>