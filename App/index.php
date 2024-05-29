<?php

// In case ingress controller doesn't do the redirection from http to https, do it ourselves.
if( !(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ) {
  $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ' . $redirect);
  exit();
}

// Initiate the session
session_start();

/**
 * This file serves as a router for all the requests to the application.
 * It will call the appropriate class depending on the request type.
 */

require_once 'autoloader.php';

$URL = explode( '/', $_GET['url'] );
// echo '<pre>';
// print_r( $_POST );
// echo '</pre>';

/****************
    Top Pages
****************/

// Handle Home
if( $URL[0] == 'Home' || $URL[0] == '' )
{
    $page = new Home();
    $page->Display();
}

// Handle Locations
else if( $URL[0] == 'Locations' )
{
    $page = new Locations();
    $page->Display();
}

// Handle SignIn
else if( $URL[0] == 'SignIn' )
{
    $page = new SignIn();
    $page->Display();
}

// Handle SignOut
else if( $URL[0] == 'SignOut' )
{
    $page = new SignOut();
    $page->Display();
}

// Handle SignUp
else if( $URL[0] == 'SignUp' )
{
    $page = new SignUp();
    $page->Display();
}

// Handle Services
else if( $URL[0] == 'Services' )
{
    if( $URL[1] == 'Details' ){
        $page = new ServicesDetails();
        $page->Display();
    }
    else{
        $page = new ServicesCatalog();
        $page->Display();
    }
}

// Handle Special Offers
else if( $URL[0] == 'Promotions' )
{
    if( $URL[1] == 'Details' ){
        $page = new PromotionDetails();
        $page->Display();
    }
    else{
        $page = new Promotions();
        $page->Display();
    }
}

/****************
    Legal Pages
****************/

// Handle About Us
else if( $URL[0] == 'AboutUs' )
{
  $page = new AboutUs();
  $page->Display();
}

// Handle Business Policy
else if( $URL[0] == 'BusinessPolicy' )
{
  $page = new BusinessPolicy();
  $page->Display();
}

/****************
    Admin Pages
****************/

// Handle Administration
else if( $URL[0] == 'Administration' )
{
  // Protect admin pages
  if( $_SESSION['role'] != 'admin' ){
    header("Location: /");
    exit;
  }

  // Site Settings
  if( $URL[1] == 'SiteSettings' ){
    $page = new AdministrationSiteSettings();
    $page->Display();
  }
  // Create Business Location
  if( $URL[1] == 'NewBusinessLocation' ){
    $page = new AdministrationNewBusinessLocation();
    $page->Display();
  }
  // Show all Business Locations
  if( $URL[1] == 'BusinessLocation' && !isset( $URL[2] ) ){
    $page = new AdministrationBusinessLocations();
    $page->Display();
  }
  // Edit a Business Location
  if( $URL[1] == 'BusinessLocation' && $URL[2] == 'Edit' ){
    $page = new AdministrationEditBusinessLocation();
    $page->Display();
  }
  // Delete Business Location
  if( $URL[1] == 'BusinessLocation' && $URL[2] == 'Delete' ){
    $page = new AdministrationDeleteBusinessLocation();
    $page->Display();
  }  
  // Create Home Banner
  if( $URL[1] == 'NewBanner' ){
    $page = new AdministrationNewHomeBanner();
    $page->Display();
  }
  // Show all Home Banners
  if( $URL[1] == 'Banner' && !isset( $URL[2] ) ){
    $page = new AdministrationHomeBanners();
    $page->Display();
  }
  // Edit a Home Banner
  if( $URL[1] == 'Banner' && $URL[2] == 'Edit' ){
    $page = new AdministrationEditHomeBanner();
    $page->Display();
  }
  // Delete Home Banner
  if( $URL[1] == 'Banner' && $URL[2] == 'Delete' ){
    $page = new AdministrationDeleteHomeBanner();
    $page->Display();
  }  
  
  // Create New Promotion
  if( $URL[1] == 'NewPromotion' ){
    $page = new AdministrationNewPromotion();
    $page->Display();
  }
  // Show all Promotions
  if( $URL[1] == 'Promotion' && !isset( $URL[2] ) ){
    $page = new AdministrationPromotions();
    $page->Display();
  }
  // Edit a Promotion
  if( $URL[1] == 'Promotion' && $URL[2] == 'Edit' ){
    $page = new AdministrationEditPromotion();
    $page->Display();
  }
  // Delete Promotion
  if( $URL[1] == 'Promotion' && $URL[2] == 'Delete' ){
    $page = new AdministrationDeletePromotion();
    $page->Display();
  }  
  // Create New Service
  if( $URL[1] == 'NewService' ){
    $page = new AdministrationNewService();
    $page->Display();
  }
  // Show all services
  if( $URL[1] == 'Service' && !isset( $URL[2] ) ){
    $page = new AdministrationServices();
    $page->Display();
  }
  // Edit a Service
  if( $URL[1] == 'Service' && $URL[2] == 'Edit' ){
    $page = new AdministrationEditService();
    $page->Display();
  }
  // Delete Service
  if( $URL[1] == 'Service' && $URL[2] == 'Delete' ){
    $page = new AdministrationDeleteService();
    $page->Display();
  }
  // Create New Service Addon
  if( $URL[1] == 'NewServiceAddon' ){
    $page = new AdministrationNewServiceAddon();
    $page->Display();
  }
  // Edit Service Addon
  if( $URL[1] == 'ServiceAddon' && $URL[2] == 'Edit' ){
    $page = new AdministrationEditServiceAddon();
    $page->Display();
  }
  // Edit Service Addon
  if( $URL[1] == 'ServiceAddon' && $URL[2] == 'Delete' ){
    $page = new AdministrationDeleteServiceAddon();
    $page->Display();
  }
  // Show Service Addons
  if( $URL[1] == 'ServiceAddon' && !isset( $URL[2] ) ){
    $page = new AdministrationServiceAddons();
    $page->Display();
  }
  // Create New Service Category
  if( $URL[1] == 'NewServiceCategory' ){
    $page = new AdministrationNewServiceCategory();
    $page->Display();
  }
  // Edit Service Category
  if( $URL[1] == 'ServiceCategory' && $URL[2] == 'Edit' ){
    $page = new AdministrationEditServiceCategory();
    $page->Display();
  }
  // Delete Service Category
  if( $URL[1] == 'ServiceCategory' && $URL[2] == 'Delete' ){
    $page = new AdministrationDeleteServiceCategory();
    $page->Display();
  }
  // Show Service Categories
  if( $URL[1] == 'ServiceCategory' && !isset( $URL[2] ) ){
    $page = new AdministrationServiceCategory();
    $page->Display();
  }
  // Base Admin page
  else{
    $page = new Administration();
    $page->Display();
  }
}

/****************
    User Pages
****************/

// Handle My Account
else if( $URL[0] == 'MyAccount' )
{
  $page = new MyAccount();
  $page->Display();
}

/****************
    Other Pages
****************/
// Handle 404
else
{
  $page = new NotFound();
  $page->Display();
}

?>
