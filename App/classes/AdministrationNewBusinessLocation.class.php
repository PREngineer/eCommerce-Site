<?php

require_once 'autoloader.php';

class AdministrationNewBusinessLocation extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > New Business Location";
  }

  /**
   * createBusinessLocation - Stores the new business location in the database
   *
   * @return bool
   */
  public function createBusinessLocation( $data )
  {
    // Process the phone to make it pretty
    $phoneParts = explode( '-', $data['phone'] );
    $prettyPhone = '1 (' . $phoneParts[0] . ') ' . $phoneParts[1] . '-' . $phoneParts[2];
    // Pick the image URI
    $image;
    if( isset( $_POST['image'] ) ){ $image = $_POST['image']; } else { $image = '/images/locations/' . $_FILES['image']['name']; }

    // Create Business Location
    $result = $this->db->query_DB( "INSERT INTO locations 
                                    ( address, city, state, zip, country, phone, phone_pretty, email, latitude, longitude, photo ) 
                                    VALUES ( '" . $data['address'] . "', '" . $data['city'] . "', '" . $data['state'] . "', '" . $data['zip'] . "', '" . $data['country'] . "', 
                                             '1" . str_replace( "-", "", $data['phone'] ) . "', '" . $prettyPhone . "', '" . $data['email'] . "', '" . $data['latitude'] . "', '" . $data['longitude'] . "', '" . $image . "' )"
                                 );

    if( !$result ){ return false; }

    return true;
  }

  /**
   * uploadImage - Validates image and puts it in the right folder
   *
   * @return bool
   */
  public function uploadImage()
  {
    // If file was uploaded, do validations
    if( $_FILES['image']['tmp_name'] != '' ){
      // Move to folder
      $upload_dir = 'images/locations/';
      $name = $_FILES['image']['name'];
      if( !move_uploaded_file( $_FILES['image']['tmp_name'], $upload_dir . $name ) ){
        return false;
      }
    }

    // If all validations pass or no file uploaded
    return true;
  }

  /**
   * Display - Displays the full page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Display()
  {
    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">New Business Location</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">New Business Location</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    // Handle updates to location
    if( isset( $_POST['address'] ) ){
      // If successful at creating
      if( $this->createBusinessLocation( $_POST ) && $this->uploadImage() ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>New business location created successfully! Refreshing in 5 seconds to show the changes.</div>          
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
        
        header("Refresh: 5; url=/Administration/NewBusinessLocation");
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while creating the new business location!  Please try again later.</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
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
                <label>Address <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="address" placeholder="123 Something St, Suite A" value="" required>
                <small class="text-muted">This is the address of the business location.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>City <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="city" placeholder="Arlington" value="" required>
                <small class="text-muted">This is the city of the business location.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>State <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="state" placeholder="VA" value="" required>
                <small class="text-muted">This is the state of the business.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Zip Code <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="zip" placeholder="22207" value="" required>
                <small class="text-muted">This is the zipcode of the business location.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Country <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="country" placeholder="USA" value="" required>
                <small class="text-muted">This is the country of the business location.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Phone <span class="text-danger">*</span></label>
                <input class="form-control" type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" value="" required>
                <small class="text-muted">This is the phone number of the business location. Format: 123-456-7890</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>E-mail <span class="text-danger">*</span></label>
                <input class="form-control" type="email" name="email" placeholder="business@site.com" value="" required>
                <small class="text-muted">This is the e-mail of the business location.</small>
              </div>

              <div class="col-lg-12 form-group">
                <span class="text-danger">Look up your address in Google Maps.<br>The URL will contain the numbers for Latitude and Longitude. (Numbers can be positive or negative)<br>First one is Latitude. Looks something like:<br> @38.8976804,-77.0391047</span>
              </div>

              <div class="col-lg-12 form-group">
                <label>Latitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="latitude" placeholder="38.8976804" value="" required>
                <small class="text-muted">This is the latitude of the business location. (This will be used for maps directions)</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Longitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="longitude" placeholder="-77.0391047" value="" required>
                <small class="text-muted">This is the longitude of the business location. (This will be used for maps directions)</small>
              </div>

              <hr><br>

              <!-- Image Option -->

              <div class="col-lg-12 form-group" id="imageOption">
                <label>Store Front Image <span class="text-danger">*</span></label><br>
                <div class="btn-group">
                  <label class="btn btn-secondary" onClick="showImageUploader( \'image\', \'imageOption\' )">
                    Upload New Image
                  </label>
                  <label class="btn btn-secondary" onClick="showImagePicker( \'image\', \'imageOption\' )">
                    Use Existing Image
                  </label>
                </div><br>
                <small class="text-muted">How do you want to choose the store front image?</small>
              </div>

              <!-- Image -->

              <div class="col-lg-12 form-group border-top border-bottom border-left border-right" id="image"></div>

              <script>
                // To add the Image Picker
                function showImagePicker( image, picker ){
                  
                  // Grab the div to modify
                  var imageDiv = document.getElementById( image );

                  // Add the new content to the image div
                  imageDiv.innerHTML = `
                    <label>Store Front Image <span class="text-danger">*</span></label>
                    <h5>Pick An Existing Image</h5>';

    // Grab a list of all images in the path given (Only .jpg | .jpeg | .png | .gif allowed)
    $images = array_merge( glob( 'images/locations/*.jpg' ), glob( 'images/locations/*.png' ), glob( 'images/locations/*.jpeg' ), glob( 'images/locations/*.gif' ) );
    
    foreach( $images as $image ){
      // Display or process each image as needed
      $this->content .= '
                    <img src="/' . $image . '" height="250" width="250" class="img-thumbnail rounded-3" onClick="setValue( image, \'/' . $image . '\' )">';
    }
                
                    $this->content .= '
                    <input class="form-control" type="text" name="image" placeholder="Selection will be put here" value="" id="image" required>
                    <small class="text-muted">Click on an image to choose it.</small>
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

                  // Add the new content to the image div
                  imageDiv.innerHTML = `
                    <label>Store Front Image <span class="text-danger">*</span></label>
                    <input class="form-control" name="image" type="file" required>
                    <small class="text-muted">Select an image to upload.</small>
                  `;

                  // Remove the options
                  document.getElementById(picker).remove();
                }
              </script>
              
              <div class="col-lg-12 form-group">
                <button class="btn btn-primary btn-block mt-0" type="submit">Create Business Location</button>
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