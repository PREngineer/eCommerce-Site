<?php

class MobileSearchBar
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
   * Display - Returns the HTML of the Search Bar for Mobiles
   *
   * @return string MobileSearchBar
   */
  public function Display()
  {
    $out .= '
    <!-- Search (in mobile) -->
    <div class="input-group-overlay d-lg-none my-3">
      <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
      <input class="form-control prepended-form-control" type="text" placeholder="Search for products and services">
    </div>
    ';

    return $out;
  }

}

?>