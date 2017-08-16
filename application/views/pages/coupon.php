<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800" rel="stylesheet"/>
        <style>
            html,body{
                height: 100%;
                margin: 0;
            }
            *{
                font-family: Montserrat;
            }
            ::-webkit-input-placeholder {
                color: #676767;
                font-size: 13px;
                opacity: 1 !important;
            }
            :-moz-placeholder {
                color: #454545;
                font-size: 13px;
                opacity: 1 !important;
            }
            ::-moz-placeholder {
                color: #454545;
                font-size: 13px;
                opacity: 1 !important;
            }
            :-ms-input-placeholder {
                color: #454545;
                font-size: 13px;
            }
            #main-container{
                align-items: center;
                display: flex;
                height: 100%;
                width: 100%;
            }
            .coupon-form{
                background: #F5F5F5;
                border-radius: 5px;
                margin: 0 auto;
                padding: 20px;
                text-align: center;
                width: 500px;
            }
            .coupon-form form *{
                margin: 10px 0;
            }
            p{
                font-size: 17px;
                font-weight: 600;
                letter-spacing: .5px;
                text-decoration: underline;
            }
            input[type='text']{
                border: 1px solid #DDDDDD;
                height: 35px;
                outline: none;
                text-indent: 5px;
                transition: .2s all ease-in-out;
                width: 350px;
            }
            input[type='text']:focus{
                box-shadow: 1px 1px 7px rgba(0,0,0,0.25);
            }
            input[type='date']{
                border: 1px solid #CCCCCC;
                border-radius: 5px;
                height: 35px;
                outline: none;
                text-indent: 5px;
            }
            input[type='button']{
                border: 0;
                color: #454545;
                cursor: pointer;
                height: 35px;
                outline: none;
                transition: .2s all ease-in-out;
                width: 100px;
            }
            input[type='button']:hover{
                box-shadow: 1px 1px 7px rgba(0,0,0,0.35);
            }
            span{
                font-size: 14px;
            }
        </style>
        <script>
            $(function(){
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();

                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();

                var minDate = year + '-' + month + '-' + day;

                $('#start-date').attr('min', minDate);
            });
            function enableEnd(){
                if($('#start-date').val()){
                    $('#end-date').prop('disabled', false);
                    $('#end-date').attr('min', $('#start-date').val())
                }
                else{
                    $('#end-date').prop('disabled', true);
                }
            }
            function getDetails(){
                var code = $('#coupon-code').val(),
                    sdate = $('#start-date').val(),
                    edate = $('#end-date').val(),
                    discount = $('#discount').val();
                    code = code.toUpperCase();
//                alert(code+"  "+sdate+"  "+edate+"  "+discount);

                $.ajax({
			url: "http://localhost/Courses/files/create_coupon.php?code="+code+"&sdate="+sdate+"&edate="+edate+"&discount="+discount,
			type: "POST",
			data: null,
			processData: false,
			contentType: false,
                        cache: false,
                        error: function (jq,status,message){
                            alert('Data : '+ jq + 'Satus : ' + status + 'Message:  ' + message);
                        },
                        success: function (data) {
                            if(data === "Already exists."){
                                alert(data);
                            }
                            else{
                                alert(data);
                                $('form')[0].reset();
                            }
                        }
		});
            }
        </script>
    </head>
    <body>
        <div id="main-container">
            <div class="coupon-form">
                <p>Create a Coupon</p>
                <form>
                    <input type="text" name="coupon-code" id="coupon-code" placeholder="Enter Coupon code"/><br>
                    <span>Start date:</span>&nbsp;&nbsp;<input type="date" id='start-date' onchange="enableEnd()"><br>
                    <span>End Date:</span>&nbsp;&nbsp;<input type="date" id='end-date' disabled/><br>
                    <input type="text" name="discount" id="discount" placeholder="Enter discount (in %)"/><br>
                    <input type="button" value="Create" onclick="getDetails()"/>
                </form>
            </div>
        </div>
    </body>
</html>

