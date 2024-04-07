<?php

class Paginator
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
   * Display - Returns the Paginator
   *
   * @return string Paginator
   */
  public function Display()
  {
    $out .= '
        <!-- Paginator -->

        <div class="d-flex">
          <a class="nav-link-style mr-3" href="#"><i class="czi-arrow-left"></i></a>
          <span class="font-size-md">1 / 5</span>
          <a class="nav-link-style ml-3" href="#"><i class="czi-arrow-right"></i></a>
        </div>
    ';

    return $out;
  }

}

?>