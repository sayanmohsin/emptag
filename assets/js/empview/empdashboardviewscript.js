$(document).ready(function(){
    // $("#tagStatus").mouseenter(function(){
    //     $("#emptagbtn").show();
    // });
    // $("#tagStatus").mouseleave(function(){
    //     $("#emptagbtn").hide();
    // });
    $("#emptagbtn").click(function(){
        $('.ui.basic.modal')
        .modal('show');
    }); 
    $(".tagIn").click(function(){
        var url = path+"/tagProcess";
        var tagp = 1;
        $.post("url",
        {
          uid: uid,
          tagp: 1
        },
        function(data,status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    }); 
});

