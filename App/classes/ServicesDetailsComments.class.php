<?php

class ServicesDetailsComments
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
   * Display - Returns the HTML of the Services Details Comments
   *
   * @return string ServicesDetailsCommnets
   */
  public function Display()
  {
    $out .= '
          <div class="row">
            <div class="col-lg-8">

              <!-- Visitor Comment -->
              
              <div class="media py-4 border-bottom"><img class="rounded-circle" width="50" src="/images/commenters/04.jpg" alt="Laura Willson"/>
                <div class="media-body pl-3">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="font-size-md mb-0">Laura Willson</h6><a class="nav-link-style font-size-sm font-weight-medium" href="#"><i class="czi-reply mr-2"></i>Reply</a>
                  </div>
                  <p class="font-size-md mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat cupidatat non proident, sunt in culpa qui.</p><span class="font-size-ms text-muted"><i class="czi-time align-middle mr-2"></i>Sep 7, 2019</span>

                  <!-- Owner Reply -->

                  <div class="media border-top pt-4 mt-4"><img class="rounded-circle" width="50" src="/images/commenters/01.jpg" alt="Sara Palson"/>
                    <div class="media-body pl-3">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="font-size-md mb-0">Sara Palson</h6>
                      </div>
                      <p class="font-size-md mb-1">Egestas sed sed risus pretium quam vulputate dignissim. A diam sollicitudin tempor id eu nisl. Ut porttitor leo a diam. Bibendum at varius vel pharetra vel turpis nunc.</p><span class="font-size-ms text-muted"><i class="czi-time align-middle mr-2"></i>Sep 13, 2019</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Visitor Comment -->

              <div class="media py-4"><img class="rounded-circle" width="50" src="/images/commenters/02.jpg" alt="Benjamin Miller"/>
                <div class="media-body pl-3">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="font-size-md mb-0">Benjamin Miller</h6><a class="nav-link-style font-size-sm font-weight-medium" href="#"><i class="czi-reply mr-2"></i>Reply</a>
                  </div>
                  <p class="font-size-md mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat cupidatat non proident, sunt in culpa qui.</p><span class="font-size-ms text-muted"><i class="czi-time align-middle mr-2"></i>Aug 15, 2019</span>
                </div>
              </div>';
        
              $ServicesDetailsCommentsForm = new ServicesDetailsCommentsForm();
              $out .= $ServicesDetailsCommentsForm->Display();
          
              $out .= '

            </div>
          </div>
    ';

    return $out;
  }

}

?>