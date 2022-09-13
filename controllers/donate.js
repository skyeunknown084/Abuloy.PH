$(document).ready(function(){
    $('#donatebtn_user').on('click', function() {
        if(document.getElementById('agreement').checked == true){
            $(this).addClass('hide');
            $(this).closest('div').find('#user_paynow').not(this).removeClass('hide');
            $(document.getElementById('donate_label')).addClass('hide');
            $(this).closest('div').find(document.getElementById('paynow_label')).not(this).removeClass('hide');
            $(document.getElementById('sharenow')).addClass('hide');
            $(this).closest('div').find(document.getElementById('otherpayments')).not(this).removeClass('hide');
        }
    })	
    $("#donatebtn").prop("disabled", true);
    $("#agreement").click(function () {
        if($(this).is(":checked")){
        $("#donatebtn").prop("disabled", false);
        }else{
        $("#donatebtn").prop("disabled", true);    
        }
    });
	$('#donatebtn').on('click', function() {  
        if(document.getElementById('agreement').checked == true && document.getElementById('amount').value > 0){
            $(this).addClass('hide');
            $(this).closest('div').find('#paynow').not(this).removeClass('hide');
            $(document.getElementById('donate_label')).addClass('hide');
            $(this).closest('div').find(document.getElementById('paynow_label')).not(this).removeClass('hide');
            $(document.getElementById('sharenow')).addClass('hide');
            $(this).closest('div').find(document.getElementById('otherpayments')).not(this).removeClass('hide');
            $("#amount").prop("readonly", true);
            $("#paynote").removeClass('hide');
            $("#amountnote").addClass('hide');
            $("#agreement").prop("disabled", true);           
        }else{
            $("#amountnote").removeClass('hide');
            $("#amount").prop("readonly", false);
            $("#paynote").addClass('hide');
            location.reload(false);
        }        
    })
    $('#anonymous').on('click', function() {
        // alert("anonymous check here");
        if($(this).is(":checked")){
            $('#customer_name').val('');             
            $(document.getElementById('customer_name')).addClass('hide');
            $(document.getElementById('customer_name')).removeClass('show');
            $(document.getElementById('customer_email')).addClass('hide');
            $(document.getElementById('customer_email')).removeClass('show');
            $(document.getElementById('customer_mobile')).addClass('hide');
            $(document.getElementById('customer_mobile')).removeClass('show');             
            $(document.getElementById('note')).removeClass('hide');             
        }else {
            $(document.getElementById('customer_name')).removeClass('hide');    
            $(document.getElementById('customer_name')).addClass('show');
            $(document.getElementById('customer_email')).removeClass('hide');    
            $(document.getElementById('customer_email')).addClass('show');
            $(document.getElementById('customer_mobile')).removeClass('hide');    
            $(document.getElementById('customer_mobile')).addClass('show');
            $(document.getElementById('note')).addClass('hide');   
        }
    })
})

$('#process_payment').submit(function(e){
    e.preventDefault()
    // var acc_id = document.getElementById('id').value;
    // var customer_name = $('#account_name').val();
    // console.log(customer_name);
    $.ajax({
        url:'/ajax?action=donation_payment',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(data){
            response = JSON.parse(data);
            var getdata = response.data;
            console.log(response);
            var checkout_url = getdata.checkouturl;
            var paynowlink = document.getElementById("paynow");
            paynowlink.setAttribute('href', checkout_url);
            // var customername = getdata.customername;
            // if(customername === ''){
            //     customername = $("#account_name").attr('value');
            // }else{
            //     customername = 'Anonymous';
            // }
            // var amount = getdata.amount;
            // var description = getdata.description;
            // var code = getdata.code;
            // var reqcode = getdata.code;
            // console.log("code: "+ code);
            // $('#reqcode').each(function () { this.setAttribute('value', reqcode); })
            // var hash = getdata.hash;
            // console.log("hash: "+ hash);                
            // console.log("checkouturl: "+ checkouturl);
        }
    }).done(function(data) { 
            // console.log(data);
            response = JSON.parse(data);
            var getdata = response.data;
            // console.log(response);        
            var code = getdata.code;
            update_code(code);   
    });
});

function update_code($code) {
    $.ajax({
        url:'/ajax?action=update_code',
        data: {code: $code},
        method: 'POST',
        type: 'POST',
        success:function(){
            // console.log(data);       
        }
    })
}