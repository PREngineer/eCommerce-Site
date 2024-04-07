<?php

class SearchBar
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
   * Display - Returns the HTML of the Search Bar
   *
   * @return string SearchBar
   */
  public function Display()
  {
    $out .= '
    <!-- Search Bar -->
    <div class="input-group-overlay d-none d-lg-block mx-4">
      <div class="input-group-prepend-overlay"><span class="input-group-text"><i class="czi-search"></i></span></div>
      <input class="form-control prepended-form-control appended-form-control" type="text" placeholder="Search for products and services">
    
      <!-- Categories -->
      <div class="input-group-append-overlay">
        <select class="custom-select">
          <option>All categories</option>
          <option>Facials</option>
          <option>Head Spa</option>
          <option>Laser Hair Removal</option>
          <option>Micro Current</option>
          <option>Combos</option>
        </select>
      </div>
    </div>
    ';

    return $out;
  }

}

?>