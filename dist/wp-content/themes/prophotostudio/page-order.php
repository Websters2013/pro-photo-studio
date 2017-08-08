<?php
/*
Template Name: Order
*/
 get_header();
$post_id = 16;
?>

 <!-- place-order -->
 <div class="place-order">

  <!-- place-order__preface -->
  <div class="place-order__preface">
    <?= get_post_field('post_content', $post_id); ?>
  </div>
  <!-- /place-order__preface -->

  <!-- place-order__order -->
  <div class="place-order__order">

   <?= get_field('order_content', $post_id); ?>

  </div>
  <!-- /place-order__order -->

  <!-- place-order__warning -->
  <div class="place-order__warning">

	  <?= get_field('order_warning', $post_id); ?>

  </div>
  <!-- /place-order__warning -->

     <!-- place-order__warning -->
     <div class="place-order__steps">
         <div><span></span></div>
         <span class="place-order__steps-item active">1</span>
         <span class="place-order__steps-item">2</span>
         <span class="place-order__steps-item">3</span>
         <span class="place-order__steps-item">4</span>
     </div>
     <!-- /place-order__warning -->

     <!-- place-order__form -->
     <form class="place-order__form" enctype="multipart/form-data">

         <div class="place-order__form-wrap">

             <!-- place-order__form-item -->
             <div class="place-order__form-item active">

                 <div class="place-order__form-topic">Personal Information</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <input type="text" placeholder="Firs Name" data-required="true" name="firs-name" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <input type="text" placeholder="Last Name" data-required="true" name="last-name" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-row -->

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <input type="text" placeholder="Company Name" data-required="true" name="company-name" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <input type="tel" placeholder="Phone Number" data-required="true" name="phone-number" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-row -->

                 <div class="place-order__form-topic">Address</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-address">
                         <input type="text" placeholder="Street Address" data-required="true" name="address" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-city">
                         <input type="text" placeholder="City" data-required="true" name="city" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-state">
                         <input type="text" placeholder="State" data-required="true" name="state" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-zip">
                         <input type="text" placeholder="Zip Code" data-required="true" name="zip-code" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-topic">Contact</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <input type="email" placeholder="Email" data-required="true" name="email" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <input type="text" placeholder="Website" data-required="true" name="website" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-topic">Code</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <input type="text" placeholder="Uniqe code" data-required="true" name="uniqe-code" />
                         <span>*</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-note">
                        <span>Must write same 6 digits you will write on package
                            you are sending</span>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-print">
	                 <?= do_shortcode('[print-me target="body" printicon="false" title="Print"]'); ?>
                 </div>

                 <div class="place-order__btn-wrap">
                     <a href="#" class="place-order__form-next">Next Page ></a>
                 </div>

             </div>
             <!-- /place-order__form-item -->

             <!-- place-order__form-item -->
             <div class="place-order__form-item">

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <div class="place-order__form-topic">Total shot quantity needed <span>*</span></div>
                         <input type="number" placeholder="0" value="0" data-required="true" name="total-shot" />
                         <div class="place-order__form-num">
                             <a href="#" class="plus"></a>
                             <a href="#" class="minus"></a>
                         </div>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <div class="place-order__form-topic">group shot quantity needed</div>
                         <input type="number" placeholder="0" value="0" data-required="true" name="group-shot" />
                         <div class="place-order__form-num">
                             <a href="#" class="plus"></a>
                             <a href="#" class="minus"></a>
                         </div>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-row -->

                 <div class="place-order__form-topic">If pricing was discusses, pleas write here</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-address">
                         <input type="text" placeholder="Price" name="price" />
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-city">
                         <div class="place-order__form-topic">Background</div>
                         <select name="background">
                             <option value="Choose">Choose</option>
                             <option value="Black">Black</option>
                             <option value="White">White</option>
                         </select>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-state">
                         <div class="place-order__form-topic">Turn-around time <span>*</span></div>
                         <select data-required="true" name="time">
                             <option value="Choose">Choose</option>
                             <option value="Black">Black</option>
                             <option value="White">White</option>
                         </select>
                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-zip">
                         <div class="place-order__form-topic">Clipping path <span>*</span>

                             <div class="place-order__info">
                                 <span class="place-order__info-btn">?</span>
                                 <span class="place-order__info-popup">No background - Transparent</span>
                             </div>

                         </div>

                         <select data-required="true" name="clipping-path">
                             <option value="Yes/no">Yes/no</option>
                             <option value="Yes">Yes</option>
                             <option value="No">No</option>
                         </select>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-print">
	                 <?= do_shortcode('[print-me target="body" printicon="false" title="Print"]'); ?>
                 </div>

                 <div class="place-order__btn-wrap">
                     <a href="#" class="place-order__form-next">Next Page ></a>
                 </div>

             </div>
             <!-- /place-order__form-item -->

             <!-- place-order__form-item -->
             <div class="place-order__form-item">

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <div class="place-order__form-topic">Hand image <span>*</span></div>

                         <select data-required="true" name="hand-image">
                             <option value="Yes/no">Yes/no</option>
                             <option value="Yes">Yes</option>
                             <option value="No">No</option>
                         </select>

                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <div class="place-order__form-topic">Imag category <span>*</span></div>

                         <select data-required="true" name="image-category">
                             <option value="Choose">Choose</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                         </select>

                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-row -->

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <div class="place-order__form-topic">Image purpose <span>*</span></div>

                         <select data-required="true" name="image-purpose">
                             <option value="Choose">Choose</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                         </select>

                     </div>
                     <!-- /place-order__form-fieldset -->

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <div class="place-order__form-topic">Coupon code</div>

                         <select name="coupon-code">
                             <option value="Choose">Choose</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                         </select>

                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-row -->

                 <div class="place-order__form-topic">How did you hear about us? <span>*</span></div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset place-order__form-address">
                         <select data-required="true" name="about-us">
                             <option value="Choose">Choose</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                             <option value="Jewelry & Watches">Jewelry & Watches</option>
                             <option value="Food">Food</option>
                             <option value="Handbags">Handbags</option>
                             <option value="Health & Beauty">Health & Beauty</option>
                             <option value="Industrial">Industrial</option>
                         </select>
                     </div>
                     <!-- /place-order__form-fieldset -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-topic">Comments</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <textarea placeholder="Your comments" name="comments"></textarea>

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <div class="place-order__terms">
                         Terms os service <span>*</span>
                         <label>
                             <input type="checkbox" data-required="true" />
                             <span>I agree to the <a href="#">terms of service</a></span>
                         </label>
                     </div>

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-print">
	                 <?= do_shortcode('[print-me target="body" printicon="false" title="Print"]'); ?>
                 </div>

                 <div class="place-order__btn-wrap">
                     <a href="#" class="place-order__form-next">Next Page ></a>
                 </div>

             </div>
             <!-- /place-order__form-item -->

             <!-- place-order__form-item -->
             <div class="place-order__form-item">

                 <div class="place-order__form-topic">Electronic signature <span>*</span></div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__sign -->
                     <div class="place-order__sign">

                                <span>The electronic signature need to be done by pressing the left click
of the mouse inside the rectangle without letting go and grag like you sign</span>

                         <!-- place-order__sign-area -->
                         <div class="place-order__sign-area"></div>
                         <!-- /place-order__sign-area -->

                         <input type="hidden" class="sign_val" name="svg"/>

                     </div>
                     <!-- /place-order__sign -->

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-topic">Upload sample files</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <label class="place-order__upload">
                         <input type="file" name="async-upload" class="image-file">

                         <span>Drop files anywhere to add</span>

                     </label>

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-topic">Need prodect back</div>

                 <!-- place-order__form-row -->
                 <div class="place-order__form-row">

                     <!-- place-order__form-fieldset -->
                     <div class="place-order__form-fieldset">
                         <select name="prodect-back">
                             <option value="Yes/no">Yes/no</option>
                             <option value="Yes">Yes</option>
                             <option value="No">No</option>
                         </select>
                     </div>

                 </div>
                 <!-- /place-order__form-fieldset -->

                 <div class="place-order__form-print">
	                 <?= do_shortcode('[print-me target="body" printicon="false" title="Print"]'); ?>
                 </div>

                 <div class="place-order__btn-wrap">
                     <button>Submit</button>
                 </div>

             </div>
             <!-- /place-order__form-item -->

         </div>

     </form>

 </div>
 <!-- /place-order -->
<!--<script>
    $(document).ready(function() {


        var form    = $('.place-order__form'),
            data = new FormData(),
            imgFile = form.find('.image-file'),
            files;

        $(imgFile).on('change',function(){
            files = this.files;

        });


        form.on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            data.append('action', 'order');

            $.each( files, function( key, value ){
                data.append( key, value );
            });
            var input_value = $( this ).serialize().split('&');
            $.each( input_value, function( key, value ){
                var keys = value.split('=');
                data.append( keys[0], keys[1] );
            });


            $.ajax({
                url: $('body').data('action'),
                data: data,
                dataType: 'json',
                timeout: 20000,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(resp) {
                    console.log(resp);
                }
            });
        });


    });
</script>-->
<?php get_footer(); ?>