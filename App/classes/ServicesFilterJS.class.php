<?php

class ServicesFilterJS
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
   * Display - Returns the Filter JavaScript Code
   *
   * @return string FilterJS
   */
  public function Display()
  {
    $out .= '
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Script to handle dropdown filter -->
    
    <script type="text/javascript">

      // Grab all the cards in a var to handle them easier
      var cards = $("div.hideable");

      // Show the cards that match the selected value
      function filterCards( value )
      {

        // Display all cards if nothing chosen
        if( value == "All Categories" )
        {
          cards.each(
            function(i, obj)
            {
              // Show them all
              obj.style.display = "block";
            }
          )
        }
        // Display only the ones that match the value
        else
        {
          // Loop over all the cards
          cards.each(
            function(i, obj)
            {
              // Get the card\'s category
              var temp = $(obj).attr("data-category");

              // If it selected, show it
              if( temp == value )
              {
                obj.style.display = "block";
              }
              else
              {
                obj.style.display = "none";
              }
            }
          )
        }
      }

    </script>
    ';

    return $out;
  }

}

?>