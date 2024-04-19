<?php

require_once 'autoloader.php';

class AdministrationEditHomeBanner extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Administration > Edit Home Banner";
  }

  /**
   * updateHomeBanner - Update Home Banner in the database
   *
   * @return bool
   */
  public function updateHomeBanner( $id, $data )
  {
    $color = str_replace( '#', '', $data['colorCode'] );
    // Pick the image URI
    $image;
    if( isset( $_POST['image'] ) ){ $image = $_POST['image']; } else { $image = '/images/home-slider/' . $_FILES['image']['name']; }
    
    // Update Home Banner
    $result = $this->db->query_DB( "UPDATE home_carousel 
                                    SET bg_color       = '" . $color                      . "',
                                        image_source   = '" . $image                      . "',
                                        image_alt_text = '" . $data['image_description']  . "',
                                        top_text       = '" . $data['topText']            . "',
                                        middle_text    = '" . $data['middleText']         . "',
                                        lower_text     = '" . $data['bottomText']         . "',
                                        url            = '" . $data['url']                . "'
                                    WHERE id = '$id'"
                                 );
    
    if( !$result ){ return false; }

    return true;
  }

  /**
   * getHomeBanner - Get Home Banner from the database
   *
   * @return bool
   */
  public function getHomeBanner( $id )
  {
    // Create Home Banner
    return $this->db->query_DB( "SELECT * FROM home_carousel WHERE id = '$id'" )[0];
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
      $upload_dir = 'images/home-slider/';
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
    // Get the data
    $URL = explode( '/', $_GET['url'] );
    $banner = $this->getHomeBanner( $URL[3] );

    // Set the page header
    $this->content .= '
    <!-- Service Name & Breadcrumbs -->

    <div class="page-title-overlap bg-light pt-4">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark">
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration"><i class="czi-settings"></i>Administration</a></li>
              <li class="breadcrumb-item"><a class="text-nowrap" href="/Administration/Banner">Home Banners</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">Edit Home Banner</li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 text-dark mb-0">Edit Home Banner</h1>
        </div>
      </div>
    </div>';

    $this->content .= '
    <div class="container pb-5 mb-2 mb-md-4">
      <div class="row">
      ';

    // Handle updates to location
    if( isset( $_POST['topText'] ) ){
      // If successful at creating
      if( $this->updateHomeBanner( $URL[3], $_POST ) && $this->uploadImage() ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-check-circle"></i>
          </div>
          <div>New home banner updated successfully! Refreshing in 5 seconds to show the changes.</div>          
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';

        header("Refresh: 5; url=/Administration/Banner/Edit/" . $URL[3]);
      }
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>Something went wrong while updating the home banner!  Please try again later.</div>
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
                <label>Top Text <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="topText" placeholder="Top text" value="' . $banner['top_text'] . '" required>
                <small class="text-muted">This is the top text of the home banner.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Middle Text <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="middleText" placeholder="Middle text" value="' . $banner['middle_text'] . '" required>
                <small class="text-muted">This is the middle text of the home banner.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Bottom Text <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="bottomText" placeholder="Bottom text" value="' . $banner['lower_text'] . '" required>
                <small class="text-muted">This is the bottom text of the home banner.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Link <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="url" placeholder="/Services/Details/1" value="' . $banner['url'] . '" required>
                <small class="text-muted">This is where the Shop Now button will redirect. Can be a top page or a details page.</small>
              </div>

              <div class="col-lg-12 form-group">
                <label>Background Color <span class="text-danger">*</span></label>
                <input class="form-control" type="color" name="colorCode" placeholder="" value="#' . $banner['bg_color'] . '" required>
                <small class="text-muted">This is the color of the background of the home banner.</small>
              </div>

              <hr><br>

              <!-- Image Option -->

              <div class="col-lg-12 form-group" id="imageOption">
                <label>Image <span class="text-danger">*</span></label><br>
                <div class="btn-group">
                  <label class="btn btn-secondary" onClick="showImageUploader( \'image\', \'imageOption\' )">
                    Upload New Image
                  </label>
                  <label class="btn btn-secondary" onClick="showImagePicker( \'image\', \'imageOption\' )">
                    Use Existing Image
                  </label>
                </div><br>
                <small class="text-muted">How do you want to choose the image?</small>
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
                    <label>Image <span class="text-danger">*</span></label>
                    <h5>Pick An Existing Image</h5>';

    // Grab a list of all images in the path given
    $images = glob( '/app/images/home-slider/*.{jpg,jpeg,png,gif}', GLOB_BRACE );
    
    foreach( $images as $image ){
      // Display or process each image as needed
      $this->content .= '
                    <img src="/' . $image . '" height="250" width="250" class="img-thumbnail rounded-3" onClick="setValue( image, \'/' . $image . '\' )">';
    }
                
                    $this->content .= '
                    <input class="form-control" type="text" name="image" placeholder="Selection will be put here" value="' . $banner['image_source'] . '" id="image" required>
                    <small class="text-muted">Click on an image to choose it.</small>
                    <input class="form-control" type="text" name="image_description" placeholder="A short image description" value="' . $banner['image_alt_text'] . '" required>
                    <small class="text-muted">Enter a short image description.</small>
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
                    <label>Image <span class="text-danger">*</span></label>
                    <input class="form-control" name="image" type="file" required>
                    <small class="text-muted">Select an image to upload.</small>
                    <input class="form-control" type="text" name="image_description" placeholder="A short image description" value="" required>
                    <small class="text-muted">Enter a short image description.</small>
                  `;

                  // Remove the options
                  document.getElementById(picker).remove();
                }
              </script>
              
              <div class="col-lg-12 form-group">
                <button class="btn btn-primary btn-block mt-0" type="submit">Edit Home Banner</button>
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