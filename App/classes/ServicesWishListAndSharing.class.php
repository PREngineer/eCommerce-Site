<?php

class ServicesWishListAndSharing
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
   * Display - Returns the HTML of the Services Wishlist and Sharing Widget
   *
   * @return string TopBar
   */
  public function Display()
  {
    $out .= '
                <!-- Wishlist + Sharing-->
                <div class="d-flex flex-wrap justify-content-between align-items-center border-top pt-3">
                  <div class="py-2 mr-2">
                    <button class="btn btn-outline-accent" type="button"><i class="czi-heart font-size-lg mr-2"></i>Add to Favorites</button>
                  </div>
                  <div class="py-2">
                    <i class="czi-share-alt font-size-lg align-middle text-muted mr-2"></i>
                    <a class="social-btn sb-outline sb-facebook sb-sm ml-2" href="#">
                      <i class="czi-facebook"></i>
                    </a>
                    <a class="social-btn sb-outline sb-twitter sb-sm ml-2" href="#">
                      <i class="czi-twitter"></i>
                    </a>
                    <a class="social-btn sb-outline sb-pinterest sb-sm ml-2" href="#">
                      <i class="czi-pinterest"></i>
                    </a>
                    <a class="social-btn sb-outline sb-instagram sb-sm ml-2" href="#">
                      <i class="czi-instagram"></i>
                    </a>
                  </div>
                </div>
    ';

    return $out;
  }

}

?>