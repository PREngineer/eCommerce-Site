<?php

class PageNavBar
{
  //------------------------- Attributes -------------------------
  private $SiteSettings;
    
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct( $SiteSettings )
  {
    $this->SiteSettings = $SiteSettings;
  }
  
  /**
   * Display - Returns the HTML of the NavBar
   *
   * @param array URL
   * @return string NavBar
   */
  public function Display( $URL )
  {
    $out .= '
    <!-- Navbar -->

    <header class="box-shadow-sm">';

    //$TopBar = new TopBar();
    //$out .= $TopBar->Display();

    $out .= '

      <!-- Search Bar and Categories (Remove "navbar-sticky" class to make navigation bar scrollable with the page) -->

      <div class="navbar-sticky bg-light">
        
        <!-- NavBar - Top part -->

        <div class="navbar navbar-expand-lg navbar-light">
          <div class="container">

            <!-- Logo -->

            <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0" href="/" style="min-width: 7rem;"><img width="142" src="' . $this->SiteSettings[18]['value'] . '" alt="' . $this->SiteSettings[0]['value'] . '"/></a>
            <a class="navbar-brand d-sm-none mr-2" href="/" style="min-width: 4.625rem;"><img width="74" src="' . $this->SiteSettings[18]['value'] . '" alt="' . $this->SiteSettings[0]['value'] . '"/></a>';
            
    // If enabled
    if( $this->SiteSettings[11]['value'] == 'on' ){
      $SearchBar = new SearchBar();
      $out .= $SearchBar->Display();
    }
            
    $out .= '
            <!-- Toolbar - Account, Cart-->

            <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">

              <!-- Hamburger -->
            
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button>
              <a class="navbar-tool navbar-stuck-toggler" href="#">
                <span class="navbar-tool-tooltip">Expand menu</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon czi-menu"></i></div>
              </a>
    ';

    // Show only for admins
    if( $_SESSION['role'] == 'admin' ){
      $out .= '
              <!-- Admin Widget -->
              
              <div class="navbar-tool ml-3">
                <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="/Administration">
                  <i class="navbar-tool-icon czi-settings"></i>
                </a>
                <a class="navbar-tool-text" href="/Administration"><small>Site</small>Administration</a>
              </div>
            ';
    }

    // If enabled
    if( $this->SiteSettings[9]['value'] == 'on' ){
      $SignInWidget = new SignInWidget();
      $out .= $SignInWidget->Display();
    }

    // If enabled
    if( $this->SiteSettings[10]['value'] == 'on' ){
      $CartWidget = new CartWidget();
      $out .= $CartWidget->Display();
    }

    $out .= '
            </div>
          </div>
        </div>

        <!-- NavBar - Bottom part -->

        <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
          <div class="container">
            <div class="collapse navbar-collapse" id="navbarCollapse">';
            
          // If enabled
          if( $this->SiteSettings[11]['value'] == 'on' ){
            $MobileSearchBar = new MobileSearchBar();
            $out .= $MobileSearchBar->Display();
          }

          // If enabled
          if( $this->SiteSettings[12]['value'] == 'on' ){
            $NavBarMenu = new NavBarMenu();
            $out .= $NavBarMenu->Display();
          }
                    
            $out .= '              
              
              <!-- Primary menu-->

              <ul class="navbar-nav">
                <li class="nav-item dropdown';
                
            if( $URL[0] == 'Home' || $URL[0] == '' ){ $out .= ' active'; }
                
            $out .= '"><a class="nav-link" href="/">Home</a></li>';

          // If enabled
          if( $this->SiteSettings[13]['value'] == 'on' ){

            $out .= '
                <li class="nav-item dropdown';
                
            if( $URL[0] == 'Services' ){ $out .= ' active'; }
                
            $out .= '"><a class="nav-link" href="/Services">Services</a></li>';
          }

          // If enabled
          if( $this->SiteSettings[19]['value'] == 'on' ){

            $out .= '
                <li class="nav-item dropdown';
            
            if( $URL[0] == 'GiftCards' ){ $out .= ' active'; }
            
            $out .= '"><a class="nav-link" href="/GiftCards">Gift Cards</a></li>';
      }
                
          // If enabled
          if( $this->SiteSettings[14]['value'] == 'on' ){

            $out .= '
                <li class="nav-item dropdown';
                
            if( $URL[0] == 'Products' ){ $out .= ' active'; }
                
            $out .= '"><a class="nav-link" href="/Products">Products</a></li>';
          }
                
          // If enabled
          if( $this->SiteSettings[15]['value'] == 'on' ){

            $out .= '
                <li class="nav-item dropdown';
                
            if( $URL[0] == 'Promotions' ){ $out .= ' active'; }
                
            $out .= '"><a class="nav-link" href="/Promotions">Promotions</a></li>';
          }
                
          // If enabled
          if( $this->SiteSettings[16]['value'] == 'on' ){

            $out .= '
                <li class="nav-item dropdown';
                
            if( $URL[0] == 'OurTeam' ){ $out .= ' active'; }
                
            $out .= '"><a class="nav-link" href="/OurTeam">Our Team</a></li>';
          }

          $out .= '
                <li class="nav-item dropdown';
                
            if( $URL[0] == 'Locations' ){ $out .= ' active'; }
                
            $out .= '"><a class="nav-link" href="/Locations">Locations</a></li>';
                
          // If enabled
          if( $this->SiteSettings[17]['value'] == 'on' ){

          $out .= '
                <li class="nav-item dropdown';
                
            if( $URL[0] == 'Blog' ){ $out .= ' active'; }
                
            $out .= '"><a class="nav-link" href="/Blog">Blog</a></li>';
          }

          $out .= '
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    ';

    return $out;
  }

}

?>