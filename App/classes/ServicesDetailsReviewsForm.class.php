<?php

class ServicesDetailsReviewsForm
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
   * Display - Returns the HTML of the Reviews Form
   *
   * @return string ReviewsForm
   */
  public function Display()
  {
    $out .= '
              <!-- Leave Review Form (Right Side) -->

              <div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
                <div class="bg-secondary py-grid-gutter px-grid-gutter rounded-lg">
                  <h3 class="h4 pb-2">Write a review</h3>
                  <form class="needs-validation" method="post" novalidate>
                    <div class="form-group">
                      <label for="review-name">Your name<span class="text-danger">*</span></label>
                      <input class="form-control" type="text" required id="review-name">
                      <div class="invalid-feedback">Please enter your name!</div><small class="form-text text-muted">Will be displayed on the comment.</small>
                    </div>
                    <div class="form-group">
                      <label for="review-email">Your email<span class="text-danger">*</span></label>
                      <input class="form-control" type="email" required id="review-email">
                      <div class="invalid-feedback">Please provide valid email address!</div><small class="form-text text-muted">Authentication only - we won\'t spam you.</small>
                    </div>
                    <div class="form-group">
                      <label for="review-rating">Rating<span class="text-danger">*</span></label>
                      <select class="custom-select" required id="review-rating">
                        <option value="">Choose rating</option>
                        <option value="5">5 stars</option>
                        <option value="4">4 stars</option>
                        <option value="3">3 stars</option>
                        <option value="2">2 stars</option>
                        <option value="1">1 star</option>
                      </select>
                      <div class="invalid-feedback">Please choose rating!</div>
                    </div>
                    <div class="form-group">
                      <label for="review-text">Review<span class="text-danger">*</span></label>
                      <textarea class="form-control" rows="6" required id="review-text"></textarea>
                      <div class="invalid-feedback">Please write a review!</div><small class="form-text text-muted">Your review must be at least 50 characters.</small>
                    </div>
                    <div class="form-group">
                      <label for="review-pros">Pros</label>
                      <textarea class="form-control" rows="2" placeholder="Separated by commas" id="review-pros"></textarea>
                    </div>
                    <div class="form-group mb-4">
                      <label for="review-cons">Cons</label>
                      <textarea class="form-control" rows="2" placeholder="Separated by commas" id="review-cons"></textarea>
                    </div>
                    <button class="btn btn-primary btn-shadow btn-block" type="submit">Submit a Review</button>
                  </form>
                </div>
              </div>
    ';

    return $out;
  }

}

?>