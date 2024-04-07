<?php

require_once 'autoloader.php';

class Page
{
  
  //------------------------- Attributes -------------------------
  protected $content = "<h1>This page was not instantiated correctly.</h1>";
  protected $title;
  protected $keywords;
  public $NavBar;
  public $Footer;
  protected $db;
  protected $SiteSettings;
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->db = new Database();
    $this->SiteSettings = $this->GetSiteSettings();
    $this->title = $this->SiteSettings[0]['value'] . " - " . $this->SiteSettings[1]['value'];
    $this->NavBar = new PageNavBar( $this->SiteSettings );
    $this->Footer = new Footer();
    session_start();
  }

  /**
   * GetSiteSettings
   *
   * @return SiteSettings
   */
  public function GetSiteSettings()
  {
    return $this->db->query_DB("SELECT * FROM settings");
  }
  
  /**
   * Set
   *
   * @param  mixed $name
   * @param  mixed $value
   *
   * @return void
   */
  public function Set($name, $value)
  {
    $this->$name = $value;
  }

  /**
   * Display - Shows the actual page
   *
   * @return void
   */
  public function Display()
  {
    echo '
    <!DOCTYPE html>
    
    <html lang="en">
    
    <!-- ******************* Header Section ******************* -->
    
    <head>
    
      <!----------------- Generic HTML5 App Information ----------------->
      
      <meta charset="utf-8">
      <title>' . $this->title . '</title>
      
      <!-- SEO Meta Tags-->
      <meta name="description" content="Meet Spa - Look and feel your best!">
      <meta name="keywords" content="' . $this->SiteSettings['keywords'] . '">
      <meta name="author" content="Jorge Pabón (pianistapr@hotmail.com)">
      
      <!-- Viewport-->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <!-- Favicon and Touch Icons-->
      <link rel="apple-touch-icon" sizes="180x180" href="/images/icons/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/images/icons/favicon-16x16.png">
      
      <!-- Website Manifest -->
      <!-- <link rel="manifest" href="site.webmanifest"> -->
      
      <!-- Mask Icon -->
      <!-- <link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg"> -->
      
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="theme-color" content="#ffffff">
      
      <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
      <link rel="stylesheet" media="screen" href="/theme/css/vendor.min.css">
      
      <!-- Main Theme Styles + Bootstrap-->
      <link rel="stylesheet" media="screen" id="main-styles" href="/theme/css/theme.min.css">
      <link rel="stylesheet" media="screen" id="main-styles" href="/theme/css/theme-original.min.css">

    </head>
    
    <body>
    ';
    
    $URL = explode( '/', $_GET['url'] );
    echo $this->NavBar->Display( $URL );
    
    echo '
    <!-- ******************* Content Section ******************* -->
    
    <div class="container py-xl-2" id="Content">
    ';

    echo $this->content;
    
    echo '
    </div>
    
    <!-- ******************* Footer Section ******************* -->
    ';

    echo $this->Footer->Display();

    echo '
    <!-- Toolbar for handheld devices -->

    <div class="cz-handheld-toolbar">
      <div class="d-table table-fixed w-100">
        <a class="d-table-cell cz-handheld-toolbar-item" href="/">
          <span class="cz-handheld-toolbar-icon"><i class="czi-home"></i></span>
          <span class="cz-handheld-toolbar-label">Home</span>
        </a>
        <a class="d-table-cell cz-handheld-toolbar-item" href="#navbarCollapse" data-toggle="collapse" onclick="window.scrollTo(0, 0)">
          <span class="cz-handheld-toolbar-icon"><i class="czi-menu"></i></span>
          <span class="cz-handheld-toolbar-label">Menu</span>
        </a>';
    if( $this->SiteSettings[10]['value'] == 'on' ){
      echo'
        <a class="d-table-cell cz-handheld-toolbar-item" href="/Cart">
          <span class="cz-handheld-toolbar-icon"><i class="czi-cart"></i>
          <span class="badge badge-primary badge-pill ml-1">4</span></span>
          <span class="cz-handheld-toolbar-label">$1247.00</span>
        </a>';
    }
    echo '
      </div>
    </div>
    
    <!-- Back To Top Button -->
    
    <a class="btn-scroll-top" href="#top" data-scroll><span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon czi-arrow-up"></i></a>
    
    <!-- JavaScript libraries, plugins and custom scripts-->
    
    <script src="/theme/js/vendor.min.js"></script>
    <script src="/theme/js/theme.min.js"></script>
    
    <!-- Close the alerts after 5 seconds -->
    
    <script>
      window.setTimeout(function()
      {
        $(".alert").fadeTo(500, 0).slideUp(500, function()
        {
            $(this).remove();
        });
      }, 5000);
    </script>

    </body>
    
    </html>
    ';
  }

}

?>