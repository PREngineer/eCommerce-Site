<?php

class ServicesDetailsCommentsForm
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
   * Display - Returns the HTML of the Services Details Comments Form
   *
   * @return string ServicesDetailsCommnetsForm
   */
  public function Display()
  {
    $out .= '
              <!-- Post comment form-->

              <div class="card border-0 box-shadow my-2">
                <div class="card-body">
                  <div class="media"><img class="rounded-circle border p-2" width="50" src="/images/commenters/avatar.png" alt="Avatar"/>
                    <form class="media-body needs-validation ml-3" novalidate>
                      <div class="form-group">
                        <textarea class="form-control" rows="4" placeholder="Write comment..." required></textarea>
                        <div class="invalid-feedback">Please write your comment.</div>
                      </div>
                      <button class="btn btn-primary btn-sm" type="submit">Post comment</button>
                    </form>
                  </div>
                </div>
              </div>
    ';

    return $out;
  }

}

?>