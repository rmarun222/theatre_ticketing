<script>
  window.onload = function() {
    var d = new Date().getTime();
    document.getElementById("tid").value = d;
  };
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<main class="donate">
    <section class="section container mb-5">
      <header>
        <h3 class="fs-2">ಪಕ್ಷ ಸೇರಿ</h3>
      </header>
      <section>
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-8">
           
            <fieldset>
              <form id="registration" name="registration" method="post" action="<?php echo site_url('Main/save_member_join'); ?>">
                <div class="mb-3">
                  <input type="hidden" name="language" value="EN"/>
                  <input type="hidden" name="merchant_id" value="683131"/>
                  
                  <input type="hidden" name="order_id" value="123654789" />
                  <input type="hidden" name="currency" value="INR" />

                  <input type="hidden" name="redirect_url" value="<?php echo site_url('payment_handler/'); ?>"/>
                  <input type="hidden" name="cancel_url" value="<?php echo site_url('payment_handler/'); ?>"/>
                  <label for="inputFullName" class="form-label">ಪೂರ್ಣ ಹೆಸರು</label>
                  <input type="text" name="billing_name" class="form-control" id="inputFullName" aria-describedby="fullNameHelp">
                </div>
                <div class="form-group mb-3">
                <label for="gender">ಲಿಂಗ</label><br />
                <div style="padding-left: 40px;">
                  <?php foreach ($gender as $key => $value): ?>
                  <div class="form-check">
                    <input
                      type="radio"
                      class="form-check-input"
                      name="gender"
                      value="<?php echo $value->gender_id; ?>"
                      id="male"
                      aria-describedby="genderMHelp"
                      <?php if($value->gender_id==1){echo 'checked';} ?>
                    />
                    <label for="male"><?php echo $value->gender; ?></label>
                  </div>
                  <?php endforeach ?>
                  <!-- <div class="form-check">
                    <input
                      type="radio"
                      class="form-check-input"
                      name="gender"
                      value="Female"
                      id="female"
                      aria-describedby="genderFHelp"
                    />
                    <label for="female">ಹೆಣ್ಣು</label>
                  </div> -->
                </div>
              </div>

              <div class="form-group mb-3">
          <label for="age">ವಯಸ್ಸು</label>
          <input
            type="text"
            class="form-control"
            id="age"
            name="age"
            aria-describedby="ageHelp"
          />
        </div>
        <div class="form-group mb-3">
          <label for="dateOfBirth">ಹುಟ್ಟಿದ ದಿನಾಂಕ</label>
          <input
            placeholder="DD/MM/YYYY"
            type="date"
            class="form-control"
            id="dob"
            name="dob"
            
            aria-describedby="dateOfBirthHelp"
          />
        </div>
        <div class="form-group mb-3">
          <label for="spouse"
            >ತಂದೆ/ತಾಯಿ/ಸಂಗಾತಿ ಹೆಸರು</label
          >
          <input
            type="text"
            class="form-control"
            id="spouse"
            name="p_f_h_name"
            aria-describedby="spouseHelp"
          />
        </div>

        <div class="form-group mb-3">
          <label for="district">ಜಿಲ್ಲೆ</label>
         <!--  <input
            type="text"
            class="form-control"
            id="district"
            name="district"
            aria-describedby="districtHelp"
          /> -->
          <select   class="form-select" id="district" name="district">
          <option value=''></option>
          <!-- <option value=''>ಜಿಲ್ಲೆಯನ್ನು ಆಯ್ಕೆ ಮಾಡಿ</option> -->
          <?php foreach($districts as $d){?>
              <option  value="<?php echo $d->d_id ; ?>"><?php echo $d->d_name_ka ; ?>  </option>
          <?php }?>  
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="taluk">ತಾಲೂಕು</label>
          <div style="display: none;" class="form-selecttaluk_alert alert alert-danger">
            <strong>ಮೊದಲು ಜಿಲ್ಲೆಯನ್ನು ಆಯ್ಕೆ ಮಾಡಿ.</strong>
          </div>
          <select  name="taluk" class="form-select"  id="taluk">
            <option value=''></option>
            <!-- <option value=''>ತಾಲ್ಲೂಕನ್ನು ಆಯ್ಕೆ ಮಾಡಿ</option> -->
          </select>

        </div>
        <div class="form-group mb-3">
          <label for="constituency"
            >ವಿಧಾನಸಭಾ ಕ್ಷೇತ್ರ</label
          >
          <input
            type="text"
            class="form-control"
            id="constituency"
            name="v_const"
            aria-describedby="constituencyHelp"
          />
        </div>

         
        <div class="form-group mb-3">
          <label for="address">ಸಂಪರ್ಕ ವಿಳಾಸ</label>
          <input
            type="text"
            class="form-control"
            id="billing_address"
            name="billing_address"
            aria-describedby="addressHelp"
          />
        </div>
        <div class="form-group mb-3">
          <label for="mobile">ಮೊಬೈಲ್ ಸಂಖ್ಯೆ</label>
          <input
            type="text"   
            class="form-control"
            id="mobile"
            name="mobile_number"
            aria-describedby="mobileHelp"
          />
        </div>
        <div class="form-group mb-3">
          <label for="email">ಇಮೇಲ್ ವಿಳಾಸ</label>
          <input
            type="email"
            class="form-control"
            id="email"
            name="billing_email"
            aria-describedby="emailHelp"
          />
        </div>

        <div class="form-group mb-3">
          <label for="email">ಕೆಆರ್‌ಎಸ್ ಬಗ್ಗೆ ನಿಮಗೆ ಹೇಗೆ ಗೊತ್ತಾಯಿತು?</label>
             <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="media[]"
                value="facebook"
                id="bearer"
                aria-describedby="bearerHelp"
              />
              <label for="bearer">ಫೇಸ್ಬುಕ್</label>
            </div> 
           
            <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="media[]"
                value="twitter"
                id="bearer"
                aria-describedby="bearerHelp"
              />
              <label for="bearer">ಟ್ವಿಟರ್</label>
            </div>  

            <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="media[]"
                value="instagram"
                id="bearer"
                aria-describedby="bearerHelp"
              />
              <label for="bearer">ಇನ್ಸ್ಟಾಗ್ರಾಂ</label>
            </div>

            <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="media[]"
                value="youtube"
                id="bearer"
                aria-describedby="bearerHelp"
              />
              <label for="bearer">ಯೂಟುಬ್</label>
            </div> 
            <!-- 
          <input
            type="email"
            class="form-control"
            id="how"
            name="how"
            aria-describedby="emailHelp"
          /> -->
        </div>


        <div class="form-group mb-3">
          <label for="interest">ನಿಮ್ಮ ಆಸಕ್ತಿ / Interest</label><br />

          <div style="padding-left: 40px;">
            <?php foreach ($interests as $key => $value) {?>
            <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="interest[]"
                value="<?php echo $value->interest_id; ?>"
                id="worker"
                aria-describedby="workerHelp"
                <?php if($value->interest_id == 1){echo 'checked';} ?>
              />
              <label for="worker"><?php echo $value->interest; ?></label>
            </div>
          <?php } ?>

          <!--   <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="interest[]"
                value="bearer"
                id="bearer"
                aria-describedby="bearerHelp"
              />
              <label for="bearer">ಪದಾಧಿಕಾರಿ</label>
            </div> -->
            <!-- <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="interest[]"
                value="aspirant"
                id="aspirant"
                aria-describedby="aspirantHelp"
              />
              <label for="aspirant">ಚುನಾವಣಾ ಆಕಾಂಕ್ಷಿ</label>
            </div> -->
          </div>
        </div>
        <div class="form-group mb-3">
          <label for="mode"
            >ಸದಸ್ಯತ್ವ ಶುಲ್ಕ ಪಾವತಿಸಿದ ವಿಧಾನ</label
          ><br />
          <div style="padding-left: 40px;">
            <?php foreach ($payment_mode as $key => $pm) { ?>
              
            
            <div class="form-check">
              <input
                type="radio"
                class="form-check-input"
                name="payment_mode"
                value="<?php echo $pm->payment_mode_id ;?>"
                id="cash"
                aria-describedby="cashHelp"
                <?php if($pm->payment_mode_id==1){echo 'checked'; } ?>
              />
              <label for="cash"><?php echo $pm->payment_mode ;?></label>
            </div>
           <!--  <div class="form-check">
              <input
                type="radio"
                class="form-check-input"
                name="mode"
                value="online"
                id="online"
                aria-describedby="onlineHelp"
              />
              <label for="online">ಆನ್ಲೈನ್</label>
            </div> -->
            <?php if($pm->payment_mode_id==2){ ?>
    
                 
                      <img width="100px" height="50px" src="<?php echo base_url('assets/images/payment_methods/all_payment_icons.png'); ?>" alt="
                      Facebook">
              
            <?php } } ?>
          <!--   <div class="form-check">
              <p>
                ಸಾಮಾನ್ಯ ಸದಸ್ಯತ್ವ ಶುಲ್ಕ <i class="fa fa-inr"></i>100. 
                <br>  
                ಪ್ರಾಥಮಿಕ ಸದಸ್ಯತ್ವ ಶುಲ್ಕ <i class="fa fa-inr"></i>1000.
              </p>
            </div> -->
          </div>
        </div> 

         <div class="form-group mb-3">
                <label for="gender">ನೋಂದಣಿಗಾಗಿ ಪವತಿಸುವ ಮೊತ್ತ</label><br />
                <div style="padding-left: 40px;">
                  <div class="form-check">
                    <input
                      type="radio"
                      class="form-check-input"
                      name="amount"
                      value="100"
                      id="male"
                      aria-describedby="genderMHelp"
                    />
                    <label for="male">ಸಾಮಾನ್ಯ ಸದಸ್ಯತ್ವ ಶುಲ್ಕ <i class="fa fa-inr"></i>100.</label>
                  </div>
                  <div class="form-check">
                    <input
                      type="radio"
                      class="form-check-input"
                      name="amount"
                      value="1000"
                      id="male"
                      aria-describedby="genderMHelp"
                    />
                    <label for="male">ಪ್ರಾಥಮಿಕ ಸದಸ್ಯತ್ವ ಶುಲ್ಕ <i class="fa fa-inr"></i>1000.</label>
                  </div>
               
                </div>
              </div>

                <button type="submit" class="btn btn-warning">ಪಕ್ಷ ಸೇರಿ</button>
              </form>
            </fieldset>
          </div>
          <div class="col-md-4 col-lg-4">
            <br>
            <img src="<?php echo base_url('assets/images/contents/join_party.webp');?>" alt="Donate" class="img-fluid" style="max-height: 600px;max-width: 100%;
        max-height: 100%;
        display: block;">
          </div>
        </div>
      </section>
    </section>
  </main>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>


  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script type="text/javascript">
  $('#district').change(function(){
    var dist_id = $(this).val();
    if(dist_id!='' || dist_id!=0){
      // alert(dist_id);
      $.ajax({
        url: "<?php echo site_url('ajax/get_taluks')?>", 
        method:'POST',
        data:{dist_id:dist_id},
        success: function(result){
          $('#taluk').html(result);
        }
      });
    }else{
      alert('select district');
    }  
  });

  $('#taluk').focus(function(){
    var dist_id = $('#district').val();
    if(dist_id==''){
      $('.taluk_alert').fadeIn(3000).delay(1000).fadeOut("slow");;
      $(this).blur();
    }
      
  });

// Wait for the DOM to be ready
$(function() {

  //Display Only Date till today // 
  var dtToday = new Date();
  var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();
  if(month < 10)
      month = '0' + month.toString();
  if(day < 10)
      day = '0' + day.toString();

  var maxDate = year + '-' + month + '-' + day;
  $('#dob').attr('max', maxDate);
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      billing_name: "required",
      // age: "required",
      // p_f_h_name: "required",
      district: "required",
      // v_const: "required",
      // address: "required",
      mobile_number: "required",
      // taluk: "required",
      amount: "required",
      // dob: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      }
    },
    // Specify validation error messages
    messages: {
      billing_name: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ಪೂರ್ಣ ಹೆಸರನ್ನು ನಮೂದಿಸಿ",
      // age: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ವಯಸ್ಸನ್ನು ನಮೂದಿಸಿ",
      // p_f_h_name: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ತಂದೆ/ತಾಯಿ/ಸಂಗಾತಿಯ ಹೆಸರನ್ನು ನಮೂದಿಸಿ",
      // v_const: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ವಿಧಾನಸಭಾ ಕ್ಷೇತ್ರವನ್ನು ನಮೂದಿಸಿ",
      address: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ವಿಳಾಸವನ್ನು ನಮೂದಿಸಿ",
      mobile_number: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ಮೊಬೈಲ್ ಸಂಖ್ಯೆಯನ್ನು ನಮೂದಿಸಿ",
      district: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ಜಿಲ್ಲೆಯನ್ನು ಆಯ್ಕೆ ಮಾಡಿ",
      // taluk: "ದಯವಿಟ್ಟು ನಿಮ್ಮ ತಾಲ್ಲೂಕನ್ನು ಆಯ್ಕೆ ಮಾಡಿ",
      // dob: "ದಯವಿಟ್ಟು ಹುಟ್ಟಿದ ದಿನಾಂಕವನ್ನು ಆಯ್ಕೆಮಾಡಿ",
      // fullname: "Please enter your age",
      //       password: {
      //   required: "Please provide a password",
      //   minlength: "Your password must be at least 5 characters long"
      // },
      // email: "ದಯವಿಟ್ಟು ಸರಿಯಾದ ಇಮೇಲ್ ವಿಳಾಸವನ್ನು ನಮೂದಿಸಿ",
      amount: "ದಯವಿಟ್ಟು ನೋಂದಣಿಗಾಗಿ ಪಾವತಿಸಿದ ಮೊತ್ತ ಆಯ್ಕೆ ಮಾಡಿ"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>




<style>


form .error {
  color: #ff0000;
}

</style>





























