<body>
  <div id="paymentFormContainer" class="container">

      <div class="stepwizard col-md-offset-3">
          <div class="stepwizard-row setup-panel">
              <div class="stepwizard-step"> <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>

                  <p>Booking Summary</p>
              </div>
              <div class="stepwizard-step"> <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>

                  <p>Personal Details</p>
              </div>
              <div class="stepwizard-step"> <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>

                  <p>Billing Details</p>
              </div>

          </div>
      </div>
      <form role="form" id="profileForm" action="" method="post" data-toggle="validator" role="form">
      <div class="row setup-content" id="step-1">
          <div class="col-xs-6 col-md-offset-3">
              <div class="col-md-12">
                <h3>Booking Summary</h3>

                <div class="form-group">
                    <label class="control-label">Course</label>
                    <input  maxlength="100" type="text" required="required" class="form-control" value= "<?= $option['courseAct'] ?>" disabled/>
                </div>

                <div class="form-group">
                    <label class="control-label">Time</label>
                    <input maxlength="100" type="text" required="required" class="form-control" value= "<?= $option['timeAct'] ?>" disabled/>
                </div>

                <div class="form-group">
                    <label class="control-label">Date</label>
                    <input maxlength="100" type="text" required="required" class="form-control" value= "<?= $option['dateAct'] ?>" disabled/>
                </div>

                <div class="form-group">
                    <label class="control-label">Length of Course</label>
                    <input maxlength="100" type="text" required="required" class="form-control" value= "<?= $option['lengthAct'] ?>" disabled/>
                </div>

                <div class="form-group">
                    <label class="control-label">Course Fees</label>
                    <input maxlength="100" type="text" required="required" class="form-control" value= "£<?= $option['courseFees'] ?>" disabled/>
                </div>

                <div class="form-group">
                    <label class="control-label">Registration Fees</label>
                    <input maxlength="100" type="text" required="required" class="form-control" value= "£<?= $option['regFees'] ?>" disabled/>
                </div>

                <div class="form-group">
                    <label class="control-label">Total Fees</label>
                    <input maxlength="100" type="text" required="required" class="form-control" value= "£<?= $option['totalFees'] ?>" disabled/>
                </div>

                  <button class="btn btn-primary nextBtn btn-md pull-right" type="button">Next</button>
              </div>
          </div>
      </div>
      <div class="row setup-content" id="step-2">
          <div class="col-xs-6 col-md-offset-3">
              <div class="col-md-12">
                <h3>Personal Details</h3>

                <!-- Name -->
                <div class="form-group">
                  <label for="name" class="control-label">Name</label>
                  <input id="name" maxlength="200" type="text" required="required" class="form-control" required>
                </div>

                <!-- <div class="form-group">
                  <label class="control-label">Password</label>
                  <input maxlength="200" type="password" required="required" class="form-control" placeholder="Password" />
                </div>

                <div class="form-group">
                  <label class="control-label">Company Address</label>
                  <input maxlength="200" type="password" required="required" class="form-control" placeholder="Confirm Password"  />
                </div> -->

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" id="email" class="form-control" data-error="Email address is invalid" required>
                </div>

                <!-- Date of Birth -->
                <div class="form-group">
                  <label for="dob" class="control-label">Date of Birth</label>
                  <input id="dob" type="date" required="required" class="form-control" required>
                </div>

                <!-- Gender -->
                <div class="form-group">
                  <label class="control-label">Gender</label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" value="Male" checked required>Male
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="optradio" value="Female" required>Female
                  </label>
                </div>

                <!-- Passport Nationality  -->
                <div class="form-group">
                    <label for="nationality" class="control-label">Nationality</label>
                    <select id="nationality" class="form-control" required>
                      <option selected="selected">Choose one</option>
                      <?php
                        foreach($nationals as $nationality) { ?>
                          <option><?= $nationality ?></option>
                      <?php
                        } ?>
                    </select>
                </div>

                <!-- Nationality  -->
                <div class="form-group">
                    <label for="passportNationality" class="control-label">Passport Nationality</label>
                    <select id="passportNationality" class="form-control" required>
                      <option selected="selected">Choose one</option>
                      <?php
                        foreach($nationals as $nationality) { ?>
                          <option><?= $nationality ?></option>
                      <?php
                        } ?>
                    </select>
                </div>

                <!-- Address Line 1 -->
                <div class="form-group">
                  <label for="addressline1" class="control-label">Address Line 1</label>
                  <input id="addressline1" maxlength="200" type="text" required="required" class="form-control" required>
                </div>

                <!-- Address Line 2 -->
                <div class="form-group">
                  <label for="addressline2" class="control-label">Address Line 2</label>
                  <input id="addressline2" maxlength="200" type="text" required="required" class="form-control" required>
                </div>

                <!-- Post Code/Zip Code -->
                <div class="form-group">
                  <label for="addressline2" class="control-label">Post Code/Zip Code</label>
                  <input id="zipcode" maxlength="200" type="text" required="required" class="form-control" required>
                </div>

                <!-- City -->
                <div class="form-group">
                  <label for="addressline2" class="control-label">City</label>
                  <input id="city" maxlength="200" type="text" required="required" class="form-control" required>
                </div>

                <!-- Country  -->
                <div class="form-group">
                    <label for="country" class="control-label">Country</label>
                      <select id="country" class="crs-country" data-region-id="region" required></select>
                </div>

                <!-- Region  -->
                <div class="form-group">
                    <label for="region" class="control-label">Region</label>
                      <select id="region" required></select>
                </div>
              <div class="form-group">
                <label>
                  <input type="checkbox"> I accept <a href="#">terms</a>
                </label>
              </div>

                  <button class="btn btn-primary prevBtn btn-md pull-left" type="button">Previous</button>
                  <button onclick="saveContinue()" class="btn btn-primary nextBtn btn-md pull-right" type="button">Save and Continue</button>
              </div>
          </div>
      </div>
      <div class="row setup-content" id="step-3">
          <div class="col-xs-6 col-md-offset-3">
              <div class="col-md-12">
                   <h3>Billing Details</h3>

                  <button class="btn btn-primary prevBtn btn-md pull-left" type="button">Previous</button>
                  <button class="btn btn-success btn-md pull-right" type="submit">Submit</button>
              </div>
          </div>
      </div>
        </form>
  </div>

<!-- country-region-selector js -->
<script src="<?= $base_url ?>/assets/country-region-selector-master/dist/jquery.crs.min.js"></script>
<script src="<?PHP echo $js ?>/confirmviewscript.js"></script>
