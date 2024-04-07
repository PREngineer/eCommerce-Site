<?php

class ServicesDetailsReviews
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
   * Display - Returns the HTML of the Reviews
   *
   * @return string Reviews
   */
  public function Display()
  {
    $out .= '
            <!-- Reviews and Form (Bottom) -->
            <div class="row pb-4">

              <div class="col-md-7">
                
                <!-- Sorter -->
                <div class="d-flex justify-content-end pb-4">
                  <div class="form-inline flex-nowrap">
                    <label class="text-muted text-nowrap mr-2 d-none d-sm-block" for="sort-reviews">Sort by:</label>
                    <select class="custom-select custom-select-sm" id="sort-reviews">
                      <option>Newest</option>
                      <option>Oldest</option>
                      <option>Popular</option>
                      <option>High rating</option>
                      <option>Low rating</option>
                    </select>
                  </div>
                </div>

                <!-- Reviews List (Left Side) -->
                
                <!-- Review -->
                <div class="product-review pb-4 mb-4 border-bottom">
                  <div class="d-flex mb-3">
                    <div class="media media-ie-fix align-items-center mr-4 pr-2"><img class="rounded-circle" width="50" src="/images/profiles/01.jpg" alt="Rafael Marquez"/>
                      <div class="media-body pl-3">
                        <h6 class="font-size-sm mb-0">Rafael Marquez</h6><span class="font-size-ms text-muted">June 28, 2019</span>
                      </div>
                    </div>
                    <div>
                      <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                      </div>
                      <div class="font-size-ms text-muted">83% of users found this review helpful</div>
                    </div>
                  </div>
                  <p class="font-size-md mb-2">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est...</p>
                  <ul class="list-unstyled font-size-ms pt-1">
                    <li class="mb-1"><span class="font-weight-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi, tempora</li>
                    <li class="mb-1"><span class="font-weight-medium">Cons:&nbsp;</span>Architecto beatae, quis autem</li>
                  </ul>
                  <div class="text-nowrap">
                    <button class="btn-like" type="button">15</button>
                    <button class="btn-dislike" type="button">3</button>
                  </div>
                </div>

                <!-- Review -->
                <div class="product-review pb-4 mb-4 border-bottom">
                  <div class="d-flex mb-3">
                    <div class="media media-ie-fix align-items-center mr-4 pr-2"><img class="rounded-circle" width="50" src="/images/profiles/02.jpg" alt="Barbara Palson"/>
                      <div class="media-body pl-3">
                        <h6 class="font-size-sm mb-0">Barbara Palson</h6><span class="font-size-ms text-muted">May 17, 2019</span>
                      </div>
                    </div>
                    <div>
                      <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i>
                      </div>
                      <div class="font-size-ms text-muted">99% of users found this review helpful</div>
                    </div>
                  </div>
                  <p class="font-size-md mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  <ul class="list-unstyled font-size-ms pt-1">
                    <li class="mb-1"><span class="font-weight-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi, tempora</li>
                    <li class="mb-1"><span class="font-weight-medium">Cons:&nbsp;</span>Architecto beatae, quis autem</li>
                  </ul>
                  <div class="text-nowrap">
                    <button class="btn-like" type="button">34</button>
                    <button class="btn-dislike" type="button">1</button>
                  </div>
                </div>

                <!-- Review -->              
                <div class="product-review pb-4 mb-4 border-bottom">
                  <div class="d-flex mb-3">
                    <div class="media media-ie-fix align-items-center mr-4 pr-2"><img class="rounded-circle" width="50" src="/images/profiles/03.jpg" alt="Daniel Adams"/>
                      <div class="media-body pl-3">
                        <h6 class="font-size-sm mb-0">Daniel Adams</h6><span class="font-size-ms text-muted">May 8, 2019</span>
                      </div>
                    </div>
                    <div>
                      <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i><i class="sr-star czi-star"></i>
                      </div>
                      <div class="font-size-ms text-muted">75% of users found this review helpful</div>
                    </div>
                  </div>
                  <p class="font-size-md mb-2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem.</p>
                  <ul class="list-unstyled font-size-ms pt-1">
                    <li class="mb-1"><span class="font-weight-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi</li>
                    <li class="mb-1"><span class="font-weight-medium">Cons:&nbsp;</span>Architecto beatae,  quis autem, voluptatem sequ</li>
                  </ul>
                  <div class="text-nowrap">
                    <button class="btn-like" type="button">26</button>
                    <button class="btn-dislike" type="button">9</button>
                  </div>
                </div>

                <!-- Load More Button -->
                <div class="text-center">
                  <button class="btn btn-outline-accent" type="button"><i class="czi-reload mr-2"></i>Load more reviews</button>
                </div>
              </div>';

    $ServicesDetailsReviewForm = new ServicesDetailsReviewsForm();
    $out .= $ServicesDetailsReviewForm->Display();
              
    $out .= '
            </div>
    ';

    return $out;
  }

}

?>