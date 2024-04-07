<?php

class ServicesRating
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
   * Display - Returns the HTML of the Services Rating
   *
   * @return string TopBar
   */
  public function Display()
  {
    $out .= '
              <!-- Reviews Score -->
              <div class="bg-secondary rounded p-3 mb-4">
                <div class="star-rating">
                  <i class="sr-star czi-star-filled active"></i>
                  <i class="sr-star czi-star-filled active"></i>
                  <i class="sr-star czi-star-filled active"></i>
                  <i class="sr-star czi-star-filled active"></i>
                  <i class="sr-star czi-star"></i>
                </div>
                <span class="font-size-ms ml-2">4.1/5</span>
                <div class="font-size-ms text-muted">based on 74 reviews</div>
              </div>
    ';

    return $out;
  }

}

?>