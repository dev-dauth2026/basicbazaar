<div class="d-flex flex-column p-5  mt-5 gap-5">
            
            <h4>Customer Review</h4>
            <div class="col-lg-6 customer-review d-flex flex-column gap-3 mx-auto">
                <div class="star5-group d-flex gap-1 w-100 align-items-center">
                    <label for = "star5" class="col-lg-2">5 Stars</label>
                    <div id="star5" class="progress col-lg-10" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning " style="width: 100%">100%</div>
                    </div>
                </div>
                
                <div class="star4-group d-flex gap-1 w-100 align-items-center">
                    <label for = "star4" class="col-lg-2">4 Stars</label>
                    <div id="star4" class="progress col-lg-10" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning " style="width: 75%">75%</div>
                    </div>
                </div>

                <div class="star3-group d-flex gap-1 w-100 align-items-center">
                    <label for = "star3" class="col-lg-2">3 Stars</label>
                    <div id="star3" class="progress col-lg-10" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning " style="width: 50%">50%</div>
                    </div>
                </div>

                <div class="star2-group d-flex gap-1 w-100 align-items-center">
                    <label for = "star2" class="col-lg-2">2 Stars</label>
                    <div id="star2" class="progress col-lg-10" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning " style="width: 25%">25%</div>
                    </div>
                </div>

                <div class="star1-group d-flex gap-1 w-100 align-items-center">
                    <label  for = "star1" class="col-lg-2">1 Star</label>
                    <div id="star1" class="progress col-lg-10" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning " style="width: 0%">0%</div>
                    </div>
                </div>

            </div>

            <!-- user comments  -->
            <?php 
            for ($i = 0; $i < 5; $i++) {
                echo"
                    <div class='customer-comments  col-lg-6 d-flex flex-column mx-auto'>
                            <p class=''><i class='fas fa-user-circle'></i> David Thampsone</p>
                            <!-- Star Rating -->
                        <div class='rating'>
                            <span class='fas fa-star text-warning'></span> 
                            <span class='fas fa-star text-warning'></span> 
                            <span class='fas fa-star text-warning'></span> 
                            <span class='fas fa-star-half-alt text-warning'></span> 
                            <span class='far fa-star text-warning'></span> 
                        </div>

                        <p class=''>Comments : This is Lorem ipsum dolor sit amet consectetur adipisicing elit.<br>
                                Esse culpa porro quae, deserunt labore incidunt dolorem minus molestias at ipsum!<br>
                                Amet eligendi incidunt reprehenderit consectetur perspiciatis tempora ullam ex et. </p>

                    </div>
                   
                ";
            }

            ?>
            <!-- user comments ends  -->
</div>