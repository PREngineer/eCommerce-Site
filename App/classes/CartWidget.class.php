<?php

class CartWidget
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
   * Display - Returns the HTML of the Cart Widget
   *
   * @return string SearchBar
   */
  public function Display()
  {
    $out .= '
              <!-- Cart Widget -->
              
              <div class="navbar-tool ml-3">
                <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="/Cart">
                  <span class="navbar-tool-label">4</span><i class="navbar-tool-icon czi-cart"></i>
                </a>
                <a class="navbar-tool-text" href="/Cart"><small>My Cart</small>$1,247.00</a>
              </div>
    ';

    return $out;
  }

}

?>