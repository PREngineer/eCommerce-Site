<?php

class SignInWidget
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
   * Display - Returns the HTML of the Login Widget
   *
   * @return string LoginWidget
   */
  public function Display()
  {
    // If not signed in
    if( !isset( $_SESSION['fname'] ) ){
      $out .= '
                <!-- My Account Button -->
                
                <a class="navbar-tool ml-1 ml-lg-0 mr-n1 mr-lg-2" href="/SignIn">
                  <div class="navbar-tool-icon-box"><i class="navbar-tool-icon czi-user"></i></div>
                  <div class="navbar-tool-text ml-n3"><small>Hello, Guest!</small>Sign In</div>
                </a>
      ';
    }
    // If signed in
    else{
      $out .= '
                <!-- My Account Button -->
                
                <a class="navbar-tool ml-1 ml-lg-0 mr-n1 mr-lg-2" href="/MyAccount">
                  <div class="navbar-tool-icon-box"><i class="navbar-tool-icon czi-user"></i></div>
                  <div class="navbar-tool-text ml-n3"><small>Hello, ' . $_SESSION['fname'] . '!</small>My Account</div>
                </a>

                <!-- Sign Out Button -->
                <a class="navbar-tool ml-1 ml-lg-0 mr-n1 mr-lg-2" href="/SignOut">
                  <div class="navbar-tool-icon-box"><i class="navbar-tool-icon czi-sign-out"></i></div>
                  <div class="navbar-tool-text ml-n3">Sign Out</div>
                </a>
      ';
    }

    return $out;
  }

}

?>