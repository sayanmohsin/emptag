<div id="promoview" class="container-fluid" style="display: none;">
  <table id="promoTable" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
                <td>#</td>
                <th>Code</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Discount</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <td>#</td>
                <th>Code</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Discount</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
      </table>

      <!-- Modal -->
      <div class="modal fade" id="viewPromoModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Promo Code</h4>
            </div>
            <div class="modal-body">
                  <input type="hidden" class="form-control" id="idView">
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="codeView">Code</label>
                      <input type="text" class="form-control" id="codeView">
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="startDateView">Start Date</label>
                      <input type="date" class="form-control" id="startDateView">
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="endDateView">End Date</label>
                      <input type="date" class="form-control" id="endDateView">
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="discountView">Discount Value</label>
                      <input type="number" class="form-control" id="discountView">
                  </div>
                  <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                      <label for="promoStatusView">Promo Status</label>
                      <!-- <input type="text" class="form-control" id="promoStatusView" disabled/> -->
                      <select class="form-control" id="promoStatusView">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning col-md-2 col-md-offset-4" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary col-md-2" onclick="updatePromoAJAX()">Update</button>
            </div>
          </div>
        </div>
      </div>
</div>
