<?php

class ServicesSalesNumber
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
   * Display - Returns the HTML of the Services Sales Number
   *
   * @return string TopBar
   */
  public function Display()
  {
    $out .= '
              <br>          
              <!-- Number of Sales -->
              
              <div class="bg-secondary rounded p-3 mb-2">
                <i class="czi-download h5 text-muted align-middle mb-0 mt-n1 mr-2"></i>
                <span class="d-inline-block h6 mb-0 mr-1">715</span><span class="font-size-sm">Sales</span>
              </div>
    ';

    return $out;
  }

}

?>