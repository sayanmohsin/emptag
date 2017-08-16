// $(document).ready(function() {
//   $('#example').DataTable( {
//       "paging":   true,
//       "ordering": true,
//       "info":     true
//   } );
//

var initPromoDataTable = function() {
    var tbl='#promoTable';
    var url = path + "/getPromoList";
    var dt = $(tbl).DataTable({
        //"sPaginationType": "full_numbers",
        "searching": false,
        "bProcessing": true,
        "bSortable" : true,
        "serverSide": true,
        "sInfoEmtpy": "No Data Available!!",
        "aoColumns": [
       {"bSortable": false },
       {"bSortable": false },
       {"bSortable": false },
       {"bSortable": false },
       {"bSortable": false },
       {"bSortable": false },
       {"bSortable": false }
          ],
        "ajax": {
          "url": url,
          "type": "POST",
          "dataType": "json",
          "data": {
          },
         "dataSrc": function(json) {
             //Get the Array in the Order of display
             return processPromoResponse(json);
          },
      },
      //End of Ajax
    });
    return dt;
};

/**
 *
 * @param JSON response - API response
 * @returns {processPromoResponse.dataList|Array} - Array of Table rows.
 * Order of data in the array will me mapped into the table
 *
 */
var processPromoResponse = function (response){
    var dataList = [];
    if(response.status){
        var list = response.data;
         $.each(list, function( index, element ) {
             var data = [];
             var action = "";
            //  onclick= \"promoStatus("+element['id']+") \"
            promoStatus = element['statusPromo'];

            var classBtn = (promoStatus == 1) ? "fa-toggle-on" : "fa-toggle-off";
            // var classBtn = 'fa fa-toggle-off';
            // var action = "<a id= "+element['id']+" data-toggle='tooltip' title='Disable' class='btn btn-mini btn-default statusBtn'><i id='sbtn"+promoStatus+"' class='fa "+classBtn+"'></i></a>";

            //Status Button
            if(promoStatus == 1)
            {
              var actionStatus = "<a id= "+element['id']+" data-toggle='tooltip' title='Disable' class='btn btn-mini btn-default statusBtn' onclick='updateStatusPromo(" +element['id']+ ",0)'><i class='fa "+classBtn+"'></i></a>";
            } else if(promoStatus == 0){
              var actionStatus = "<a id= "+element['id']+" data-toggle='tooltip' title='Enable' class='btn btn-mini btn-default statusBtn' onclick='updateStatusPromo(" +element['id']+ ",1)'><i class='fa "+classBtn+"'></i></a>";
            }

            //Edit Option Button
            var actionEditDelete = "<a id= "+element['id']+" data-toggle='tooltip' title='Edit' class='btn btn-mini btn-default' onclick='viewPromo(" +element['id']+ ")'><i class='fa fa-pencil'></i></a>"+
              "<a id= "+element['id']+" data-toggle='tooltip' title='Delete' class='btn btn-mini btn-default' onclick='deletePromoCode(" +element['id']+ ")'><i class='fa fa-times'></i></a>";

      // var action = "<a id= "+element['id']+" data-toggle='tooltip' title='Disable' class='btn btn-mini btn-default statusBtn'><i class='fa fa-pencil' ></i></a>";
        //  href="+path+"/viewSelectedVendor/"+element['id']+" class='btn btn-mini btn-default'><i class='fa fa-pencil' ></i></a>";
              console.log(action);
             data.push(element['sl']);
             data.push(element['code']);
             data.push(element['start_date']);
             data.push(element['end_date']);
             data.push(element['discount']+'%');
             data.push(actionStatus);
             data.push(actionEditDelete);
             dataList.push(data);
             "</div>"
         });
    }
    return dataList;
};

// $(document).on("click", '.statusBtn', function(event) {
//   var ref = event.target.id;
//   alert(ref);
//   // $("#"+ref).find('i').toggleClass('fa fa-toggle-off');
// });

function updateStatusPromo(id,status){
  var url = path + "/promoStatusChanger";
  // if (status == 1){status = 'enable';}
  // else if(status == 0){status = 'disable';}
  // alert(status);
  $.ajax({
    url: url,
    type: "POST",
    data: {
      id : id,
      status : status
    } ,
    dataType: "json",
    beforeSend: function(XMLHttpRequest) {
    },
    complete: function(XMLHttpRequest, textStatus) {
    },
    success: function(msg, textStatus){
      if(msg.status>0){
        $(document).on('click', '.statusBtn', function() {
          $(this).find('i').toggleClass('fa-toggle-on fa-toggle-off');
        });
          $("#promoTable").dataTable().fnDestroy();
          promoData = initPromoDataTable();
      }
    },
    error: function(XMLHttpRequest, err) {
      alert('Something went wrong');
    }
  });
}

// function updatePromoCode(id){
//   alert('Sorry this feature is not available at this time');
// }

function deletePromoCode(id){
  if (!confirm('Are you sure?')){return 0;}
  else{
  var url = path + "/promoCodeDelete";
  $.ajax({
    url: url,
    type: "POST",
    data: {
      id : id
    } ,
    dataType: "json",
    beforeSend: function(XMLHttpRequest) {
    },
    complete: function(XMLHttpRequest, textStatus) {
      // alert('Selected promocode deleted');
    },
    success: function(msg, textStatus){
      if(msg.status>0){
          $("#promoTable").dataTable().fnDestroy();
          promoData = initPromoDataTable();
      }
    },
    error: function(XMLHttpRequest, err) {
      alert('Something went wrong');
    }
  });
  }
}

function viewPromo(id){
  var tbl='#promoTable';
  var url = path + "/getSelectedPromoList";
  $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    data: {
      id : id
    },
    // dataSrc: function(json) {
    //        //Get the Array in the Order of display
    //        var dataList = [];
    //        if(json.status){
    //            var list = json.data;
    //             $.each(list, function( index, element ) {
    //                 var data = [];
    //                 alert(element['sl']);
    //             });
    //           }
    //     },
    success: function(json){
           //Get the Array in the Order of display
           var dataList = [];
           if(json.status){
               var list = json.data;
                $.each(list, function( index, element ) {
                    var data = [];
                    // var promoStatus = element['statusPromo'] == 1 ? 'Active' : 'Inactive';
                    $('#viewPromoModal').modal('show')
                    $("#idView").val(element['id']);
                    $("#codeView").val(element['code']);
                    $("#startDateView").val(element['start_date']);
                    $("#endDateView").val(element['end_date']);
                    $("#discountView").val(element['discount']);
                    // $("#promoStatusView").val(promoStatus);
                    $('#promoStatusView').val(element['statusPromo']).attr("selected", "selected");
                    // $promoListData['code'] = $user->code;
                    // $promoListData['start_date'] = $user->start_date;
                    // $promoListData['end_date'] = $user->end_date;
                    // $promoListData['discount'] = $user->discount;
                    // $promoListData['statusPromo'] = $user->status;
                });
              }
          }
    });
    //End of Ajax
  }
function updatePromoAJAX()  {
  var url = path + "/updatePromo";
  var id = $("#idView").val();
  var code = $("#codeView").val();
  var start_date = $("#startDateView").val();
  var end_date = $("#endDateView").val();
  var discount = $("#discountView").val();
  var statusPromo = $('#promoStatusView').val();
  $.ajax({
    url: url,
    type: "POST",
    data: {
      id : id,
      code : code,
      start_date : start_date,
      end_date : end_date,
      discount : discount,
      statusPromo : statusPromo
    } ,
    dataType: "json",
    beforeSend: function(XMLHttpRequest) {
    },
    complete: function(XMLHttpRequest, textStatus) {
      $("#promoTable").dataTable().fnDestroy();
      promoData = initPromoDataTable();
      $("#viewPromoModal").trigger("click");
    },
    success: function(msg, textStatus){
      if(msg.status>0){
        alert('Promo code updated');
      }
    },
    error: function(XMLHttpRequest, err) {
      alert('Something went wrong');
    }
    });
  }

// Close Modal on ESC
  $(document).keyup(function(ev){
      if(ev.keyCode == 27)
          $("#viewPromoModal").trigger("click");
  });
