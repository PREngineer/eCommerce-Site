<?php

require_once 'autoloader.php';

class AdministrationEditService extends Page
{
  
  //------------------------- Attributes -------------------------
  public $content = '';
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Edit Service";
  }

  /**
   * getAddons - Retrieves all the Service Addons from the database
   *
   * @return array
   */
  public function getAddons()
  {
    return $this->db->query_DB( "SELECT * FROM service_addons ORDER BY price ASC" );
  }

  /**
   * Get - Retrieves all the Locations from the database
   *
   * @return array
   */
  public function getLocations()
  {
    return $this->db->query_DB( "SELECT id,city,state FROM locations ORDER BY city ASC" );
  }
  
  /**
   * getService - Gets the service details from the database
   *
   * @return bool
   */
  public function getService( $id )
  {
    // Update company name
    $result = $this->db->query_DB( "SELECT * from services WHERE id = '" . $id . "'" )[0];
    if( !$result ){ return false; }
    
    return $result;
  }
  
  /**
   * getCategories - Retrieves all the Categories from the database
   *
   * @return array
   */
  public function getCategories()
  {
    return $this->db->query_DB( "SELECT * FROM service_categories ORDER BY name ASC" );
  }
  
  /**
   * updateService - Updates the service in the database
   *
   * @return bool
   */
  public function updateService( $id )
  {
    // Collapse addons array
    $addons = implode(',', $_POST['addons']);

    // Collapse locations array
    $locations = implode(',', $_POST['locations']);

    // Pick the image URIs
    $imageOne;
    if( isset( $_POST['image_one'] ) ){ $imageOne = $_POST['image_one']; } else { $imageOne = '/images/services/' . $_FILES['image_one']['name']; }
    $imageTwo;
    if( isset( $_POST['image_two'] ) ){ $imageTwo = $_POST['image_two']; } else { $imageTwo = '/images/services/' . $_FILES['image_two']['name']; }
    $imageThree;
    if( isset( $_POST['image_three'] ) ){ $imageThree = $_POST['image_three']; } else { $imageThree = '/images/services/' . $_FILES['image_three']['name']; }
    // Update service
    $result = $this->db->query_DB( "UPDATE services 
                                    SET category                = '" . $_POST['category'] . "',
                                        name                    = '" . $_POST['name'] . "', 
                                        price                   = '" . $_POST['price'] . "', 
                                        steps                   = '" . $_POST['steps'] . "', 
                                        addons                  = '" . $addons . "', 
                                        duration                = '" . $_POST['duration'] . "', 
                                        locations               = '" . $locations . "', 
                                        description             = '" . $_POST['description'] . "', 
                                        image_one               = '" . $imageOne . "', 
                                        image_one_description   = '" . $_POST['image_one_description'] . "', 
                                        image_two               = '" . $imageTwo . "', 
                                        image_two_description   = '" . $_POST['image_two_description'] . "', 
                                        image_three             = '" . $imageThree . "', 
                                        image_three_description = '" . $_POST['image_three_description'] . "'
                                    WHERE id     = '" . $id . "'" );
    if( !$result ){ return false; }
    
    return true;
  }

  /**
   * uploadImages - Validates images and puts them in the right folder
   *
   * @return bool
   */
  public function uploadImages()
  {
    // If file was uploaded, do validations
    if( $_FILES['image_one']['tmp_name'] != '' ){
      // Move to folder
      $upload_dir = 'images/services/';
      $name = $_FILES['image_one']['name'];
      if( !move_uploaded_file( $_FILES['image_one']['tmp_name'], $upload_dir . $name ) ){
        return false;
      }
    }

    // If file was uploaded, do validations
    if( $_FILES['image_two']['tmp_name'] != '' ){
      // Move to folder
      $upload_dir = 'images/services/';
      $name = $_FILES['image_two']['name'];
      if( !move_uploaded_file( $_FILES['image_two']['tmp_name'], $upload_dir . $name ) ){
        return false;
      }
    }

    // If file was uploaded, do validations
    if( $_FILES['image_three']['tmp_name'] != '' ){
      // Move to folder
      $upload_dir = 'images/services/';
      $name = $_FILES['image_three']['name'];
      if( !move_uploaded_file( $_FILES['image_three']['tmp_name'], $upload_dir . $name ) ){
        return false;
      }
    }

    // If all validations pass or no file uploaded
    return true;
  }

  /**
   * Display - Displays the full page
   *
   * @return void
   */
  public function Display()
  {
    // Get the addon data
    $URL = explode( '/', $_GET['url'] );
    $service = $this->getService( $URL[3] );
    
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/Service">Services</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Edit Service</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Edit Service</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    // Handle updates to branding
    if( isset( $_POST['name'] ) ){
      // If images handled properly
      if( $this->uploadImages() ){
        // If successful at updating
        if( $this->updateService( $URL[3] ) ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>Service updated successfully! Refreshing in 5 seconds to show the changes.</div>          
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/Service/Edit/" . $URL[3]);
        }
        else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the Service!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
        }
      }
    }
        
    $SideBar = new AdministrationSideBar( $this->SiteSettings );
    $this->content .= $SideBar->Display();
        
    $this->content .= '
        <!-- Column for Content -->

        <section class="col-lg-8">

          <form class="needs-validation" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate id="new_service-form">

            <div class="card-body font-size-md">

              <div class="col-lg-12 form-group">
                <label>Service Name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" placeholder="My Service Add-on" value="' . $service['name'] . '" required>
                <small class="text-muted">This is the name of the Service.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Category <span class="text-danger">*</span></label>
                <select class="form-select" name="category" required>
                  <option value=""></option>';

    $categories = $this->getCategories();
    foreach( $categories as &$category ){
      $this->content .= '
                  <option value="' . $category['id'] . '"';
                  
                  if( $category['id'] == $service['category'] ){
                  $this->content .= ' selected>' . $category['name'] . '</option>';
                  }
                  else{
                    $this->content .= '>' . $category['name'] . '</option>';
                  }
    }

    $this->content .= '
                </select>
                <small class="text-muted">Pick a category from the defined service categories.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Price <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="price" placeholder="50.00" value="' . $service['price'] . '" required>
                <small class="text-muted">This is the price of the service (including cents).</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Service Duration <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="duration" placeholder="45" value="' . $service['duration'] . '" required>
                <small class="text-muted">This is the duration of the service (in minutes).</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Procedure / Steps</label>
                <textarea class="form-control" name="steps" rows="5" placeholder="Enter steps in separate lines.">' . strip_tags( $service['steps'] ) . '</textarea>
                <small class="text-muted">Enter one line per step in the service. Each line appears as a checked item in the Service Details Page.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Full Service Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="5" placeholder="A full description or detailed information should be written here." required>' . strip_tags( $service['description'] ) . '</textarea>
                <small class="text-muted">Enter a full description of the service.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Available Add-ons</label>
                <div data-toggle="buttons">';

    $addons = $this->getAddons();
    foreach ($addons as &$addon) {
              $this->content .= '
                  <label class="btn btn-secondary">
                    <input type="checkbox" name="addons[]" autocomplete="off" value="' . $addon['id'] . '"';
                    
      if( strpos($service['addons'], $addon['id']) !== false ){
        $this->content .= ' checked';
      }

              $this->content .= '> ' . $addon['name'] . '
                  </label>';
    }
                
    $this->content .= '
                </div><br>
                <small class="text-muted">Select all of the addons to show as options for this service.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Locations <span class="text-danger">*</span></label><br>
                <div data-toggle="buttons">';

    $locations = $this->getLocations();
    foreach ($locations as &$location) {
              $this->content .= '
                  <label class="btn btn-secondary">
                    <input type="checkbox" name="locations[]" autocomplete="off" value="' . $location['id'] . '"';
                    
                    if( strpos($service['locations'], $location['id']) !== false ){
                      $this->content .= ' checked';
                    }
              
                            $this->content .= '> ' . $location['city'] . ', ' . $location['state'] . '
                  </label>';
    }
                
    $this->content .= '
                </div><br>
                <small class="text-muted">Select all of the locations that provide this service.</small>
              </div>

              <hr><br>

              <div class="col-lg-12 form-group border-top border-bottom border-left border-right">
                <span class="text-danger">Important! <br>
                1. You must pick three images.<br>
                2. All images in the site must be exactly the same dimensions (in pixels) for the website to look correctly.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;For example: 1000x800</span>
              </div>

              <!-- Main Image Option -->

              <div class="col-lg-12 form-group" id="image_oneOption">
                <label>Main Image <span class="text-danger">*</span></label><br>
                <div class="btn-group">
                  <label class="btn btn-secondary" onClick="showImageUploader( \'image_one\', \'image_oneOption\' )">
                    Upload New Image
                  </label>
                  <label class="btn btn-secondary" onClick="showImagePicker( \'image_one\', \'image_oneOption\' )">
                    Use Existing Image
                  </label>
                </div><br>
                <small class="text-muted">How do you want to choose the main image?</small>
              </div>

              <!-- Main Image -->

              <div class="col-lg-12 form-group border-top border-bottom border-left border-right" id="image_one"></div>

              <!-- Image Two Option -->

              <div class="col-lg-12 form-group" id="image_twoOption">
                <label>Image Two <span class="text-danger">*</span></label><br>
                <div class="btn-group">
                  <label class="btn btn-secondary" onClick="showImageUploader( \'image_two\', \'image_twoOption\' )">
                    Upload New Image
                  </label>
                  <label class="btn btn-secondary" onClick="showImagePicker( \'image_two\', \'image_twoOption\' )">
                    Use Existing Image
                  </label>
                </div><br>
                <small class="text-muted">How do you want to choose the second image?</small>
              </div>

              <!-- Image Two -->

              <div class="col-lg-12 form-group border-top border-bottom border-left border-right" id="image_two"></div>

              <!-- Image Three Option -->

              <div class="col-lg-12 form-group" id="image_threeOption">
                <label>Image Three <span class="text-danger">*</span></label><br>
                <div class="btn-group">
                  <label class="btn btn-secondary" onClick="showImageUploader( \'image_three\', \'image_threeOption\' )">
                    Upload New Image
                  </label>
                  <label class="btn btn-secondary" onClick="showImagePicker( \'image_three\', \'image_threeOption\' )">
                    Use Existing Image
                  </label>
                </div><br>
                <small class="text-muted">How do you want to choose the third image?</small>
              </div>

              <!-- Image Three -->

              <div class="col-lg-12 form-group border-top border-bottom border-left border-right" id="image_three"></div>

              <script>
                // To add the Image Picker
                function showImagePicker( image, picker ){
                  
                  // Grab the div to modify
                  var imageDiv = document.getElementById( image );

                  // Figure out how to name the image
                  var name;
                  if( image == "image_one" ){
                    name = "Main Image";
                    imageURL = "' . $service['image_one'] . '";
                    imageDescription = "' . $service['image_one_description'] . '";
                  }
                  else{
                    name = "Additional Image";
                    if( image == "image_two" ){
                      imageURL = "' . $service['image_two'] . '";
                      imageDescription = "' . $service['image_two_description'] . '";
                    }
                    else{
                      imageURL = "' . $service['image_three'] . '";
                      imageDescription = "' . $service['image_three_description'] . '";
                    }
                  }
                  
                  // Add the new content to the image div
                  imageDiv.innerHTML = `
                    <label>${name} <span class="text-danger">*</span></label>
                    <h5>Pick An Existing Image</h5>';

    // Grab a list of all images in the path given
    $images = glob( 'images/services/*.{jpg,jpeg,png,gif}', GLOB_BRACE );
    
    foreach( $images as $image ){
      // Display or process each image as needed
      $this->content .= '
                    <img src="/' . $image . '" height="250" width="250" class="img-thumbnail rounded-3" onClick="setValue( ${image}, \'/' . $image . '\' )">';
    }
                
                    $this->content .= '
                    <input class="form-control" type="text" name="${image}" placeholder="Selection will be put here" value="${imageURL}" id="${image}" required>
                    <label>Short Description: <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="${image}_description" placeholder="Short Description" value="${imageDescription}" required>
                    <small class="text-muted">Enter a short description.</small>
                  `;

                  // Remove the options
                  document.getElementById(picker).remove();
                }
                
                // Set write the value to the input field
                function setValue( field, source ){
                  field.value = source;
                }
                
                // To add the Image Uploader
                function showImageUploader( image, picker ){
                  
                  // Grab the div to modify
                  var imageDiv = document.getElementById( image );

                  // Figure out how to name the image
                  var name;
                  if( image == "image_one" ){
                    name = "Main Image";
                  }
                  else{
                    name = "Additional Image";
                  }
                  
                  // Add the new content to the image div
                  imageDiv.innerHTML = `
                    <label>${name} <span class="text-danger">*</span></label>
                    <input class="form-control" name="${image}" type="file" required>
                    <label>Short Description: <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="${image}_description" placeholder="Short Description" value="" required>
                    <small class="text-muted">Enter a short description.</small>
                  `;

                  // Remove the options
                  document.getElementById(picker).remove();
                }
              </script>
              
              <div class="col-lg-12 form-group">
                <button class="btn btn-primary btn-block mt-0" type="submit">Update Service</button>
              </div>

            </div>
          </form>
          
        </section>
      </div>
    </div>
    ';

    parent::Display();
  }

}

?>