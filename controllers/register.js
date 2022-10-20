// $('[name="password"],[name="password_confirmation"]').keyup(function(){
//     var pass = $('[name="password"]').val()
//     var cpass = $('[name="password_confirmation"]').val()
//     if(cpass == '' ||pass == ''){
//         $('#pass_match').attr('data-status','')
//     }else{
//         if(cpass == pass){
//             $('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
//         }else{
//             $('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
//         }
//     }
// })
$(document).ready(function(){
    // Donees-List User (type=2)
    $('#individual').on('click', function() {
        $('#individual_form').removeClass('hide');
        $('#funeralhome_form').addClass('hide');
    })
    $('#funeralhome').on('click', function() {
        $('#funeralhome_form').removeClass('hide');
        $('#individual_form').addClass('hide');
    })
});

// $('#create_new_account').submit(function(e){
//     e.preventDefault()
//     $('input').removeClass("border-danger")
//     // start_load()
//     $.ajax({
//         url:'/ajax?action=create_account',
//         data: new FormData($(this)[0]),
//         cache: false,
//         contentType: false,
//         processData: false,
//         method: 'POST',
//         type: 'POST',
//         success:function(resp){
//             if(resp == 1){
//                 // alert_toast('Data successfully saved.',"success");
//                 setTimeout(function(){
//                     alert("hello, create_account fnc work!");
//                     location.replace('/login-verification');
//                 },750)
//             }
//             if(resp == 2){
//                 $('#msg').html("<div class='alert alert-danger'>Account already exist.</div>");
//                 $('[name="d_firstname"]').addClass("border-danger")
//                 // end_load()
//             }
//         }
//     })
// })

// $('#create_new_account').submit(function(e){
    // e.preventDefault()
    // $('input').removeClass("border-danger")
    // start_load()
    // $('#msg').html('')
    // if($('[name="password"]').val() != '' && $('[name="password_confirmation"]').val() != ''){
    //     if($('#pass_match').attr('data-status') != 1){
    //         if($("[name='password']").val() !=''){
    //             $('[name="password"],[name="password_confirmation"]').addClass("border-danger")
    //             // end_load()
    //             return false;
    //         }
    //     }
    // }
    
    // $.ajax({
    //     url:'/ajax?action=save_user',
    //     data: new FormData($(this)[0]),
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     method: 'POST',
    //     type: 'POST',
    //     success:function(resp){
    //         if(resp == 1){
    //             // alert_toast('Data successfully saved.',"success");
    //             setTimeout(function(){
    //                 location.replace('/startnewfund')
    //             },750)
    //         }else if(resp == 2){
    //             $('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
    //             $('[name="email"]').addClass("border-danger")
    //             // end_load()
    //         }
    //     }
    // })
// })