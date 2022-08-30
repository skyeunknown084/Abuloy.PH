$('#login-form').submit(function(e){
    // alert("Login-form here");
    e.preventDefault()
    // start_load()
    if($(this).find('.alert-danger').length > 0 )
    $(this).find('.alert-danger').remove();
    $.ajax({
        url:'/ajax?action=login',
        method:'POST',
        data: $(this).serialize(),
        // error:err=>{
        //   console.log(err)
        //   end_load();
        // },
        success:function(resp){
        console.log(resp);
        location.href ='/';
        if(resp == 1){
            location.href ='/';
        }else{
            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
            // end_load()
        }
        }
    })
})