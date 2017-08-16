<div id="bookingview" class="container-fluid" style="display: block;">
  <a href="<?= $path?>/download" id="downloadCSV" class="">Download CSV Report</a>
  <table id="bookingTable"  class="display table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
                <td>#</td>
                <th>Name</th>
                <th>Email ID</th>
                <th>Nationality</th>
                <th>Country</th>
                <th>Booking Status</th>
                <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td>#</td>
              <th>Name</th>
              <th>Email ID</th>
              <th>Nationality</th>
              <th>Country</th>
              <th>Booking Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
      </table>

      <!-- Modal -->
      <div class="modal fade" id="viewBookingModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Booking information of <span id="nameHeading"></span></h4>
            </div>
            <div class="modal-body">
              <form role="form">
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="nameView">Name</label>
                      <input type="text" class="form-control" id="nameView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="emailView">Email</label>
                      <input type="email" class="form-control" id="emailView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="dobView">Date of birth</label>
                      <input type="date" class="form-control" id="dobView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="genderView">Gender</label>
                      <input type="text" class="form-control" id="genderView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="nationalityView">Nationality</label>
                      <input type="text" class="form-control" id="nationalityView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="passportNationalityView">Passport Nationality</label>
                      <input type="text" class="form-control" id="passportNationalityView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="addressLine1View">Address Line 1</label>
                      <input type="text" class="form-control" id="addressLine1View" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="addressLine2View">Address Line 2</label>
                      <input type="text" class="form-control" id="addressLine2View" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="zipcodeView">Post Code/Zip Code</label>
                      <input type="number" class="form-control" id="zipcodeView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="cityView">City</label>
                      <input type="text" class="form-control" id="cityView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="countryView">Country</label>
                      <input type="text" class="form-control" id="countryView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="regionView">Region</label>
                      <input type="text" class="form-control" id="regionView" disabled/>
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="regionView">Payment Status</label>
                      <input type="text" class="form-control" id="paymentStatusView" disabled/>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger col-md-2 col-md-offset-5" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</div>
