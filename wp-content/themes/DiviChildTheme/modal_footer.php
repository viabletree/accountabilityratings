<?php

function add_modals_in_footer(){ 
    ?>
    <!-- quick rating view -->
    <div class="quick-rating-container">
        <div class="quick-rating-main-view">
            <div class="close_model">x</div>
            <h1 class="quick-rating-heading">Add Quick Rating</h1>
            <p class="quick-rating-sub-heading"></p>
            <div class="quick-rating-form-view mt-5">
                <form id="quick_rating">
                    <div>
                        <input type="text" id="quicktitle" name="quicktitle" placeholder="Review Title" />
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="stars">Stars</label>
                            <div class="star-rating-form mt-3">
                                <div class="star-input">
                                    <!-- <input type="radio" name="rating" id="rating-5">
                                    <label for="rating-5" class="fas fa-star"></label>
                                    <input type="radio" name="rating" id="rating-4">
                                    <label for="rating-4" class="fas fa-star"></label>
                                    <input type="radio" name="rating" id="rating-3">
                                    <label for="rating-3" class="fas fa-star"></label>
                                    <input type="radio" name="rating" id="rating-2">
                                    <label for="rating-2" class="fas fa-star"></label>
                                    <input type="radio" name="rating" id="rating-1">
                                    <label for="rating-1" class="fas fa-star"></label> -->

                                    <input type="radio" name="stars" value="5"/>
                                    <input type="radio" name="stars" value="4"/>
                                    <input type="radio" name="stars" value="3"/>
                                    <input type="radio" name="stars" value="2"/>
                                    <input type="radio" name="stars" value="1" checked/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="stars">Icon</label>
                            <div id="smileys" class="mt-3">
                                <input type="radio" name="smiley" value="sad" class="sad">
                                <input type="radio" name="smiley" value="happy" class="happy" checked="checked">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary" id="quicksubmit_btn">Add Rating</button>
                        <input type="hidden" name="pro_id" class="quick-rating-pro-id" value="">
                    </div>
                </form>
                <?php 
                    echo '<div id="wp_quick_rating_error" class="mt-3"></div>';                                 
                ?>
            </div>
        </div>
    </div>
    <!-- quick rating view -->



    <!-- detailed rating view -->
    <div class="detailed-rating-container">
        <div class="detailed-rating-main-view">
            <div class="close_model">x</div>
            <h1 class="detailed-rating-heading">Add Rating</h1>
            <div class="detailed-rating-form-view mt-5">
                <form id="detailed_rating">
                    <div class="form-group">
                        <input type="text" id="situation" name="situation" placeholder="Describe your situation" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="opinion" name="opinion" placeholder="How did your CO perform?" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="business_effect" name="business_effect" placeholder="How did this affect your business?" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="title" name="title" placeholder="Review Title" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="comments" name="comments" placeholder="Comments" />
                    </div>
<!--                     <div class="form-group">
                        <input type="text" id="contracting_professional" name="contracting_professional" placeholder="Your Contracting Pofessional" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="federal_agency" name="federal_agency" placeholder="Federal Agency" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="contract_type" name="contract_type" placeholder="Type of Contract" />
                    </div> -->
                    <div class="form-group">
                        <select id="rate_location" name="rate_location">
                            <option value="1">Rate Professional's Knowledge</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="rate_facilities" name="rate_facilities">
                            <option value="1">Rate Professionalism</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="rate_communication" name="rate_communication">
                            <option value="1">Rate Level of Cooperation</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="rate_value" name="rate_value">
                            <option value="1">Rate Willingness to Communicate</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="rate_management" name="rate_management">
                            <option value="1">Rate Speed of Review/Execution</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="stars">Stars</label>
                            <div class="star-rating-form">
                                <div class="star-input">
                                    <input type="radio" name="stars" value="5"/>
                                    <input type="radio" name="stars" value="4"/>
                                    <input type="radio" name="stars" value="3"/>
                                    <input type="radio" name="stars" value="2"/>
                                    <input type="radio" name="stars" value="1" checked/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="stars">Icon</label>
                            <div id="smileys">
                                <input type="radio" name="smiley" value="sad" class="sad">
                                <input type="radio" name="smiley" value="happy" class="happy" checked="checked">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <button type="submit" class="btn btn-primary" id="quicksubmit_btn">Add Rating</button>
                        <input type="hidden" name="pro_id" class="detailed-rating-pro-id" value="">
                    </div>
                </form>
                <?php 
                    echo '<div id="wp_detailed_rating_error" class="mt-3"></div>';                                 
                ?>
            </div>
        </div>
    </div>
    <!-- detailed rating view -->

    <!-- edit detailed rating view -->
    <div class="update-detailed-rating-container">
        <div class="detailed-rating-main-view">
            <div class="close_model">x</div>
            <h1 class="detailed-rating-heading">Edit Rating</h1>
            <div class="detailed-rating-form-view mt-5">
                <form id="update_detailed_rating">
                    <!-- Dynamic form input -->
                </form>
                <?php 
                    echo '<div id="wp_update_detailed_rating_error" class="mt-3"></div>';                                 
                ?>
            </div>
        </div>
    </div>
    <!-- edit detailed rating view -->


    <!-- Suggest Professional Model -->
    <div class="suggest-pro-container">
        <div class="suggest-pro-heading-container">
            <h1 class="suggest-pro-heading">SUGGEST PROFESSIONAL REQUEST</h1>
        </div>
        <div class="suggest-pro-main-view">
            <div class="close_model">x</div>
            <div class="suggest-pro-form-view mt-5">
                <form id="suggest_pro">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Name" />
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Email Address" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="profession" name="profession" placeholder="Title" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="phone" name="phone" placeholder="Phone Number" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="location" placeholder="Location" id="autocomplete" onFocus="geolocate()" />
                    </div>
                    <input type="hidden" name="city" id="locality" placeholder="Type Here">
                    <input type="hidden" name="state" id="administrative_area_level_1" placeholder="Type Here">
                    <input type="hidden" name="zip_code" id="postal_code" placeholder="Type Here">
                    <input type="hidden" name="country" id="country" placeholder="Type Here">
                    <div class="row mt-4">
                        <button type="submit" class="btn btn-primary" id="quicksubmit_btn">Add Professional</button>
                    </div>
                </form>
                <?php 
                    echo '<div id="wp_suggest_pro_error" class="mt-3"></div>';                                 
                ?>
            </div>
        </div>
    </div>
    <!-- Suggest Professional Model End -->


    <!-- Donate Us Model -->
    <div class="donate-container">
        <div class="donate-heading-container">
            <h1 class="donate-heading">DONATE TO KEEP THIS SITE RUNNING</h1>
        </div>
        <div class="donate-main-view">
            <div class="close_model">x</div>
            <div class="donate-form-view mt-3">
               <!-- Short code will go here in php tag -->

               <!-- 

               Eg: do shortcode function
                -->
                <div class="donation-heart-icon-wrap">
                    <img src="<?php echo get_site_url() ?>/wp-content/uploads/2022/07/donation-heart-icon.png" alt="heart-icon-donation" />
                </div>
                <div class="donation-form-wrap">
                    <?php 
                        echo do_shortcode( '[wp_stripe_donation]' );
                    ?>;
                </div>
            </div>
        </div>
    </div>
    <!-- Donate Us Model End -->

    <!-- Claim Professional Model -->
    <div class="claim-pro-container">
        <div class="claim-pro-heading-container">
            <h1 class="claim-pro-heading">CLAIM YOUR ACCOUNT?</h1>
        </div>
        <div class="claim-pro-main-view">
            <div class="close_model">x</div>
            <p class="claim-pro-sub-heading">If this Professional Profile belongs to you, You can also continue to request access</p>
            <div class="claim-pro-form-view mt-5">
                <form id="claim_pro">
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Ja*************l@exam...l.com" />
                    </div>
                    
                    <div class="row mt-4">
                        <button type="submit" class="btn btn-primary" id="quicksubmit_btn">Claim</button>
                        <input type="hidden" id="claim_pro_id" name="pro_id" value="">
                    </div>
                </form>
                <?php 
                    echo '<div id="wp_claim_pro_error" class="mt-3"></div>';                                 
                ?>
            </div>
        </div>
    </div>
    <!-- Claim Professional Model End -->

    <!-- Add Reply Model -->
    <div class="add-reply-container">
        <div class="add-reply-main-view">
            <div class="close_model">x</div>
            <h1 class="add-reply-heading">Add Reply</h1>
            <div class="add-reply-form-view mt-5">
                <form id="add_reply">
                    <div>
                        <textarea name="addreply" id="addreply" placeholder="Add Your Reply"></textarea>
                    </div>
                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary" id="quicksubmit_btn">Add Reply</button>
                        <input type="hidden" name="r_id" class="reply-rating-id" value="">
                    </div>
                </form>
                <?php 
                        echo '<div id="wp_reply_error" class="mt-3"></div>';
                        
                ?>
            </div>
        </div>
    </div>
    <!-- Add Reply Model End -->


    <?php
    if (!is_user_logged_in()){
    ?>
        <!-- Login Form -->
        <div class="login-container">
            <div class="login-main-view">
                <div class="close_model">x</div>
                <img src="<?php echo home_url('/wp-content/uploads/2022/06/Rating-1-Traced.png');?>" alt="logo" />
                <h1 class="login-heading">Login</h1>
                <div class="login-form-view mt-5">
                    <?php
                        echo wp_login_form( 
                            array( 
                                'echo' => false ,
                                'label_username' => __( 'Username / Email ' ),
                                'label_password' => __( 'Password' ),
                                'label_log_in'   => __( 'Sign In' ),
                                'remember'       => false
                                )
                        ); 
                    ?>

                    <div class="wp_login_error">
                        <?php if( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) { ?>
                            <p>The password you entered is incorrect, Please try again.</p>
                        <?php } 
                        else if( isset( $_GET['login'] ) && $_GET['login'] == 'empty' ) { ?>
                            <p>Please enter both username and password.</p>
                        <?php } ?>
                    </div> 
                    <div class="register-now">
                        <p>Don&lsquo;t have an account yet? <a href="javascript:void(0)" class="signin-register">Register Now</a></p>
                    </div>       
                </div>
            </div>
        </div>
    <?php 
    } 
    ?>
        <!-- Login Form End -->

        <!-- Register Form -->
        <div class="register-container">
            <div class="register-main-view">
                <div class="close_model">x</div>
                <img src="<?php echo home_url('/wp-content/uploads/2022/06/Rating-1-Traced.png');?>" alt="logo" />
                <h1 class="register-heading">Register</h1>
                <?php
                    global $wpdb, $user_ID;  
                    // if (!$user_ID) {  
                        ?>
                        <div class="register-form-view mt-3">
                            <form id="registerform">
                                <div class="form-group mt-3">
                                    <label>Email</label>
                                    <input type="email" name="useremail" class="text" placeholder="useremail@gmail.com" />
                                </div>
                                <div class="form-group mt-3">
                                    <label>Name</label>  
                                    <input type="text" name="fullname" placeholder="Type Here" class="text" />
                                </div>
                                <div class="form-group mt-3">
                                    <label>Username</label>  
                                    <input type="text" name="username" placeholder="Type Here" class="text" />
                                </div>
                                <div class="form-group mt-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="text" placeholder="Password" />
                                </div>
                                <input type="submit" name="user_registeration" value="Register" class="submit-register" />
                            </form>
                            <?php 
                                 echo '<div id="wp_register_error" class="mt-3"></div>';
                                    
                            ?>
                        
                            <div class="signin-now">
                                <p>Already have an account? <a href="javascript:void(0)" class="register-signin">Sign In</a></p>
                            </div>       
                        </div>
                        <?php
                    // }  
                    // else {  
                    //     wp_redirect( home_url() ); exit;  
                    // }
                ?>
            </div>
        </div>
        <!-- Register Form End -->

        <div class="fixed-bottom custom-alert-box">
            <div class="alert alert-primary" role="alert">
                
            </div>
        </div>






        <!-- autocomplete fields -->

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API ?>"></script>


  
<script>
  var placeSearch, autocomplete, autocomplete2;
var componentForm = {

  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};


function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */
    (document.getElementById('autocomplete')), {
      types: ['geocode']
    });

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', function() {
    fillInAddress(autocomplete, "");
   
 
    
  });

  autocomplete2 = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */
    (document.getElementById('autocomplete2')), {
      types: ['geocode']
    });
  autocomplete2.addListener('place_changed', function() {
    fillInAddress(autocomplete2, "2");

// for patient latitude and longitute 

    var place = autocomplete2.getPlace();
    document.getElementById("latitude").value = place.geometry['location'].lat();
  document.getElementById("longitude").value = place.geometry['location'].lng();
  
 
  });


}

function fillInAddress(autocomplete, unique) {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();






  for (var component in componentForm) {
    if (!!document.getElementById(component + unique)) {
      document.getElementById(component + unique).value = '';
      document.getElementById(component + unique).disabled = false;
    }
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType] && document.getElementById(addressType + unique)) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType + unique).value = val;
    }
  }

}
google.maps.event.addDomListener(window, "load", initAutocomplete);

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

  </script>

    
    
    <?php 
} 
    
add_action('wp_footer', 'add_modals_in_footer');


?>