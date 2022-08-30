$('[name="password"],[name="cpass"]').keyup(function(){
    var pass = $('[name="password"]').val()
    var cpass = $('[name="cpass"]').val()
    if(cpass == '' ||pass == ''){
        $('#pass_match').attr('data-status','')
    }else{
        if(cpass == pass){
            $('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
        }else{
            $('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
        }
    }
})
$('#create_new_user').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    // start_load()
    // $('#msg').html('')
    if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
        if($('#pass_match').attr('data-status') != 1){
            if($("[name='password']").val() !=''){
                $('[name="password"],[name="cpass"]').addClass("border-danger")
                // end_load()
                return false;
            }
        }
    }
    $.ajax({
        url:'/ajax?action=save_user',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
            if(resp == 1){
                // alert_toast('Data successfully saved.',"success");
                setTimeout(function(){
                    location.replace('/startnewfund')
                },750)
            }else if(resp == 2){
                $('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
                $('[name="email"]').addClass("border-danger")
                // end_load()
            }
        }
    })
})