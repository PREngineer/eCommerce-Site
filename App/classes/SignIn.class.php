<?php

require_once 'autoloader.php';

class SignIn extends Page
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
    $this->title = $this->SiteSettings[0]['value'] . " - Sign In";
  }

  /**
   * checkLogin - Performs the login validation.
   *
   * @return int Count
   */
  private function checkLogin()
  {
    // Encrypt password with SHA512
    $password = hash( 'sha512', $_POST['password'] );

    // Check if the e-mail & password combination exists
    return ( $this->db->query_DB( "SELECT COUNT(email) as Count
                                   FROM accounts
                                   WHERE email = '" . $_POST['email'] . "'
                                   AND password   = '" . $password    . "'" ) [0] ['Count'] );
  }
  
  /**
   * processLogin - Finalizes the Log in process.
   *
   * @return bool Result
   */
  private function processLogin( $result )
  {
    $password = hash( 'sha512', $_POST['password'] );

    // Create the cookie, if successful
    if( $result == 1 )
    {
      $data = ( $this->db->query_DB( "SELECT email, fname, lname, role, api_key
                                      FROM accounts
                                      WHERE email  = '" . $_POST['email'] . "'
                                      AND password = '" . $password       . "'" ) ) [0];

      $this->setupCookie( $data );

      return true;
    }
    else
    {
      return false;
    }
  }
  
  /**
   * setupCookie - Create the cookie for this session.
   *
   * @param  array $data
   *
   * @return void
   */
  private function setupCookie( $data )
  {
    // Initialize the session
    session_start();
    
    $_SESSION['email']   = $data['email'];
    $_SESSION['fname']   = $data['fname'];
    $_SESSION['lname']   = $data['lname'];
    $_SESSION['role']    = $data['role'];
    $_SESSION['api_key'] = $data['api_key'];
    
    // Calculate cookie life time
    // A month in seconds = 30 days * 24 hours * 60 mins * 60 secs
    $cookieLifetime = 30 * 24 * 60 * 60;
    $name = strtolower( ( str_replace(' ', '', $this->SiteSettings[0]['value'] ) ) );
    setcookie( $name, session_id(), time() + $cookieLifetime );
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
    if( isset( $_POST['email'] ) )
    {      
      // If successful
      if( $this->processLogin( $this->checkLogin() ) ){
        header("Location: /MyAccount/SignIn");
      }      
      // If failed
      else{
        $this->content .= '
        <!-- Error Message -->

        <div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">
          <div class="alert-icon">
            <i class="ci-close-circle"></i>
          </div>
          <div>The credentials provided are incorrect!</div>
          <button type = "button" class="close" data-dismiss="alert">x</button>
        </div>
        ';
      }
    }

    // Set the page header
    $this->content .= '
    <!-- Sign in -->

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <!-- Header -->

          <div class="modal-header">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
            
              <!-- Sign In Tab -->
            
              <li class="nav-item">
                <a class="nav-link active" href="/SignIn">
                  <i class="czi-unlocked mr-2 mt-n1"></i>
                  Sign In
                </a>
              </li>

              <!-- Sign Up Tab -->
            
              <li class="nav-item">
                <a class="nav-link" href="/SignUp">
                  <i class="czi-user mr-2 mt-n1"></i>
                  Sign Up
                  </a>
              </li>
            </ul>
          </div>
          
          <!-- Body -->

          <div class="modal-body tab-content py-4">

            <!-- Sign In Form -->

            <form class="needs-validation" method="POST" autocomplete="off" novalidate id="signin-tab">
              <div class="form-group">
                <label for="si-email">Email address</label>
                <input class="form-control" name="email" type="email" id="si-email" placeholder="john.doe@example.com" required>
                <div class="invalid-feedback">Please provide a valid email address.</div>
              </div>
              <div class="form-group">
                <label for="si-password">Password</label>
                <div class="password-toggle">
                  <input class="form-control" name="password" type="password" id="si-password" required>
                  <label class="password-toggle-btn">
                    <input class="custom-control-input" type="checkbox"><i class="czi-eye password-toggle-indicator"></i><span class="sr-only">Show password</span>
                  </label>
                </div>
              </div>
              <div class="form-group d-flex flex-wrap justify-content-between">
                <div class="custom-control custom-checkbox mb-2">
                  <input class="custom-control-input" type="checkbox" id="si-remember">
                  <label class="custom-control-label" for="si-remember">Remember me</label>
                </div><a class="font-size-sm" href="/ForgotPassword">Forgot password?</a>
              </div>
              <button class="btn btn-primary btn-block btn-shadow" type="submit">Sign in</button>
            </form>

            <!-- Sign Up Form -->

            <form class="needs-validation tab-pane fade" method="POST" autocomplete="off" novalidate id="signup-tab">
              <input name="form" type="hidden" value="signup">
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