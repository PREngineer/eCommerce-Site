<?php

class TopBar
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
   * Display - Returns the HTML of the Top Bar
   *
   * @return string TopBar
   */
  public function Display()
  {
    $out .= '
      <!-- Topbar - Language, Currency, Phone Number, Wishlist, Compare, Order Tracking-->

      <div class="topbar topbar-dark bg-dark">
        <div class="container">
          <div>
            <div class="topbar-text dropdown disable-autohide"><a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown"><img class="mr-2" width="20" src="images/flags/en.png" alt="English"/>Eng / $</a>
              <ul class="dropdown-menu">
                <li class="dropdown-item">
                  <select class="custom-select custom-select-sm">
                    <option value="usd">$ USD</option>
                    <option value="eur">€ EUR</option>
                    <option value="ukp">£ UKP</option>
                    <option value="jpy">¥ JPY</option>
                  </select>
                </li>
                <li><a class="dropdown-item pb-1" href="#"><img class="mr-2" width="20" src="images/flags/fr.png" alt="Français"/>Français</a></li>
                <li><a class="dropdown-item pb-1" href="#"><img class="mr-2" width="20" src="images/flags/de.png" alt="Deutsch"/>Deutsch</a></li>
                <li><a class="dropdown-item" href="#"><img class="mr-2" width="20" src="images/flags/it.png" alt="Italiano"/>Italiano</a></li>
              </ul>
            </div>
            <div class="topbar-text text-nowrap d-none d-md-inline-block border-left border-light pl-3 ml-3"><span class="text-muted mr-1">Available 24/7 at</span><a class="topbar-link" href="tel:00331697720">(00) 33 169 7720</a></div>
          </div>
          <div class="topbar-text dropdown d-md-none ml-auto"><a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">Wishlist / Compare / Track</a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="account-wishlist.html"><i class="czi-heart text-muted mr-2"></i>Wishlist (3)</a></li>
              <li><a class="dropdown-item" href="comparison.html"><i class="czi-compare text-muted mr-2"></i>Compare (3)</a></li>
              <li><a class="dropdown-item" href="order-tracking.html"><i class="czi-location text-muted mr-2"></i>Order tracking</a></li>
            </ul>
          </div>
          <div class="d-none d-md-block ml-3 text-nowrap"><a class="topbar-link d-none d-md-inline-block" href="account-wishlist.html"><i class="czi-heart mt-n1"></i>Wishlist (3)</a><a class="topbar-link ml-3 pl-3 border-left border-light d-none d-md-inline-block" href="comparison.html"><i class="czi-compare mt-n1"></i>Compare (3)</a><a class="topbar-link ml-3 border-left border-light pl-3 d-none d-md-inline-block" href="order-tracking.html"><i class="czi-location mt-n1"></i>Order tracking</a></div>
        </div>
      </div>
    ';

    return $out;
  }

}

?>