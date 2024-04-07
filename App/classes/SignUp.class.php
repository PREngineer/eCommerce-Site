<?php

require_once 'autoloader.php';

class SignUp extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Sign Up";
  }

  /**
   * checkLogin - Performs the login validation.
   *
   * @return int Count
   */
  private function checkEmail()
  {
    // Check if the e-mail exists
    return ( $this->db->query_DB( "SELECT COUNT(email) as Count
                                   FROM accounts
                                   WHERE email = '" . $_POST['email'] . "'" ) [0] ['Count'] );
  }
  
  /**
   * processLogin - Finalizes the Log in process.
   *
   * @return bool Result
   */
  private function processSignUp( $result )
  {
    $password = hash( 'sha512', $_POST['password'] );

    // If account doesn't exist
    if( $result == 0 )
    {
      $data = $this->db->query_DB( "INSERT INTO accounts
                                   (email, password, fname, lname)
                                   VALUES (
                                    '" . $_POST['email'] . "',
                                    '" . $password      . "',
                                    '" . $_POST['fname'] . "',
                                    '" . $_POST['lname'] . "'
                                   )" );

      return true;
    }
    else
    {
      return false;
    }
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
    // Handle data and give feedback, sign in
    if( isset( $_POST['fname'] ) )
    {      
      // If successful
      if( $this->processSignUp( $this->checkEmail() ) ){
        $this->content .= '
        <!-- Success Message -->

        <div class="alert alert-with-icon alert-success d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon-box"><i class="alert-icon czi-check-circle"></i></div>
          <div class="alert-icon">Your account was created successfully!</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
      }      
      // If failed
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-with-icon alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon-box"><i class="alert-icon czi-close-circle"></i></div>
          <div class="alert-icon">There is an account with that e-mail already!</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
      }
    }

    // Set the page header
    $this->content .= '
    <!-- Sign up -->

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <!-- Header -->

          <div class="modal-header">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
            
              <!-- Sign In Tab -->
            
              <li class="nav-item">
                <a class="nav-link" href="/SignIn">
                  <i class="czi-unlocked mr-2 mt-n1"></i>
                  Sign In
                </a>
              </li>

              <!-- Sign Up Tab -->
            
              <li class="nav-item">
                <a class="nav-link active" href="/SignUp">
                  <i class="czi-user mr-2 mt-n1"></i>
                  Sign Up
                  </a>
              </li>
            </ul>
          </div>
          
          <!-- Body -->

          <div class="modal-body tab-content py-4">

            <!-- Sign Up Form -->

            <form class="needs-validation" method="POST" autocomplete="off" novalidate id="signup-tab">
              <div class="form-group">
                <label for="su-name">First name</label>
                <input class="form-control" name="fname" type="text" id="su-fname" placeholder="John / Jane" required>
                <div class="invalid-feedback">Please fill in your first name.</div>
              </div>
              <div class="form-group">
                <label for="su-name">Last name</label>
                <input class="form-control" name="lname" type="text" id="su-lname" placeholder="Doe" required>
                <div class="invalid-feedback">Please fill in your last name.</div>
              </div>
              <div class="form-group">
                <label for="su-email">Email address</label>
                <input class="form-control" name="email" type="email" id="su-email" placeholder="john.doe@example.com" required>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="form-group">
                <label for="su-password">Password</label>
                <div class="password-toggle">
                  <input class="form-control" name="password" type="password" id="su-password" required>
                  <label class="password-toggle-btn">
                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="su-password-confirm">Confirm password</label>
                <div class="password-toggle">
                  <input class="form-control" name="password2" type="password" id="su-password-confirm" required>
                  <label class="password-toggle-btn">
                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                  </label>
                </div>
              </div>
              <button class="btn btn-primary btn-block btn-shadow" type="submit">Sign up</button>
            </form>

          </div>
        </div>
      </div>
    ';

    parent::Display();
  }

}

?>