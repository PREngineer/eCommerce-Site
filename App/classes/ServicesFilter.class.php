<?php

class ServicesFilter
{
  //------------------------- Attributes -------------------------
  private $db;
  private $categories;
    
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct( $cats )
  {
    $this->db = new Database();
    $this->categories = $cats;
  }

  /**
   * Display - Returns the HTML of the Services Filter
   *
   * @return string TopBar
   */
  public function Display()
  {
    $out .= '
        <!-- JS function is triggered when dropdown is changed -->
        <div class="pt-3">
          <select class="custom-select" onchange="filterCards( this.value )">
            <option>All Categories</option>';
        
    foreach( $this->categories as &$entry ){
      $out .= '
            <option value="' . $entry['id'] . '">' . $entry['name'] . '</option>';
    }

    $out .= '
          </select>          
        </div>
    ';

    return $out;
  }

}

?>