<?php

class ServicesCreator
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
   * Display - Returns the HTML of the Services Creator
   *
   * @return string ServicesCreator
   */
  public function Display()
  {
    $out .= '
                <!-- Creator -->
                <div class="bg-secondary rounded p-3 mt-4 mb-2">
                  <a class="media align-items-center" href="#">
                    <img class="rounded-circle" width="50" src="/images/commenters/01.jpg" alt="Sara Palson"/>
                    <div class="media-body pl-2"><span class="font-size-ms text-muted">Created by</span>
                      <h6 class="font-size-sm mb-0">Sara Palson</h6>
                    </div>
                  </a>
                </div>
    ';

    return $out;
  }

}

?>