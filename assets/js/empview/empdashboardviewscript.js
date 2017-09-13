$(document).ready(function(){
    // $("#tagStatus").mouseenter(function(){
    //     $("#emptagbtn").show();
    // });
    // $("#tagStatus").mouseleave(function(){
    //     $("#emptagbtn").hide();
    // });
    function checknetwork(){
        $.getJSON('http://ip-api.com/json?callback=?', function(data) {
            console.log(JSON.stringify(data, null, 2));
            window.isp = data.isp;
        });
    }    
    setInterval(checknetwork, 2000);

    $("#emptagbtn").click(function(){
        $('.ui.basic.modal')
        .modal('show');
    }); 
    $(".tagIn").click(function(){
        alert(window.isp);
            if (window.isp != 'BNL'){
            $.confirm({
                title: '',
                content: 'You are not in office or not connected to office network',
                buttons: {
                    confirm: {
                        text: 'Work at home',
                        btnClass: 'btn-green',
                        keys: ['enter', 'shift'],
                        action: function(){
                            $.alert('Confirmed!');
                            var url = path+"/tagProcess";
                            var tagp = 1;
                            dateTime = getDateTime();
                            $.post(url,
                            {
                              uid: uid,
                              tagp: tagp,
                              dateTime: dateTime
                            },
                            function(data,status){
                                alert("Data: " + data + "\nStatus: " + status);
                            });
                        }
                    },
                    cancel: function () {
                        $('.ui.basic.modal')
                        .modal('hide');
                    }
                }
            });
        }    
    }); 
    $(".tagOut").click(function(){
        var url = path+"/tagProcess";
        var tagp = 0;
        dateTime = getDateTime();
        $.post(url,
        {
          uid: uid,
          tagp: tagp,
          dateTime: dateTime
        },
        function(data,status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    }); 
});

