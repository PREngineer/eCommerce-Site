<?php

class Footer
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
   * Display - Returns the HTML of the Footer
   *
   * @return string TopBar
   */
  public function Display()
  {
    $out .= '
    <!-- Footer-->

    <footer class="container bg-dark pt-2">
      <div class="container">
        <div class="row pb-2">
          
          <!-- Business Policies -->

          <div class="col-md-3">
            <div class="widget widget-links widget-light pb-2 mb-4">
              <h3 class="widget-title text-light">Business Policies</h3>
              <ul class="widget-list">
                <!-- <li class="widget-list-item"><a class="widget-list-link" href="/AccountPolicy">Account Policy</a></li> -->
                <li class="widget-list-item"><a class="widget-list-link" href="/BusinessPolicy">Business Policy</a></li>
              </ul>
            </div>
          </div>

          <!-- About, Careers, News -->

          <div class="col-md-3">
            <div class="widget widget-links widget-light pb-2 mb-4">
              <h3 class="widget-title text-light">About Us</h3>
              <ul class="widget-list">
                <li class="widget-list-item"><a class="widget-list-link" href="/AboutUs">About Company</a></li>
                <!-- <li class="widget-list-item"><a class="widget-list-link" href="/Careers">Careers</a></li>
                <li class="widget-list-item"><a class="widget-list-link" href="/News">News</a></li> -->
              </ul>
            </div>
          </div>

          <!-- Socials -->

          <div class="col-md-3">
            <div class="widget pb-2 mb-4">
              <h3 class="widget-title text-light pb-1">Follow Us On</h3>
              <div class="mb-3"><a class="social-btn sb-light sb-twitter ml-2 mb-2" href="#"><i class="czi-twitter"></i></a>
                <a class="social-btn sb-light sb-facebook ml-2 mb-2" href="#"><i class="czi-facebook"></i></a>
                <a class="social-btn sb-light sb-instagram ml-2 mb-2" href="#"><i class="czi-instagram"></i></a>
                <a class="social-btn sb-light sb-pinterest ml-2 mb-2" href="#"><i class="czi-pinterest"></i></a>
                <a class="social-btn sb-light sb-youtube ml-2 mb-2" href="#"><i class="czi-youtube"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="widget pb-2 mb-4">
              <h3 class="font-size-base text-light mb-1">Secure Online Payment</h3>
              <br>
              <img class="d-inline-block" width="187" src="/images/cards.png" alt="Payment methods"/>
              <p class="mb-0 font-size-ms text-light opacity-50">Using SSL / Secure Certificate</p>
            </div>
          </div>
        
        </div>

        <div class="row pb-2">

          <!-- Legal Links -->

          <!-- <div class="col-md-8 text-center text-md-left mb-4">
            <div class="widget widget-links widget-light">
              <ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
                <li class="widget-list-item mr-4"><a class="widget-list-link" href="/Support">Support</a></li>
                <li class="widget-list-item mr-4"><a class="widget-list-link" href="/Privacy">Privacy</a></li>
                <li class="widget-list-item mr-4"><a class="widget-list-link" href="/TOS">Terms of use</a></li>
              </ul>
            </div>
          </div> -->

          <div class="pb-2 font-size-xs text-light opacity-50 text-center text-md-left">
            © ' . DATE("Y") . ' All rights reserved | Made by <a class="text-light" href="https://www.github.com/PREngineer" target="_blank">Jorge Pabón</a>
          </div>
        </div>
      </div>
    </footer>
    ';

    return $out;
  }

}

?>