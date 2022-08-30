function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#cimg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$('#create_new_account').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    // start_load()
    $.ajax({
        url:'ajax?action=save_account',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
            alert("hello, save_account fnc work!");
            location.href = '/';
            if(resp == 1){
                // alert_toast('Data successfully saved.',"success");
                setTimeout(function(){
                    location.replace('/');
                },750)
            }else if(resp == 2){
                $('#msg').html("<div class='alert alert-danger'>First Name already exist.</div>");
                $('[name="d_firstname"]').addClass("border-danger")
                // end_load()
            }
        }
    })
})
// $('#create_new_account').submit(function(e){
// 	e.preventDefault()
// 	$('input').removeClass("border-danger")
// 	start_load()
// 	$.ajax({
// 		url:'ajax.php?action=save_account2',
// 		data: new FormData($(this)[0]),
// 	    cache: false,
// 	    contentType: false,
// 	    processData: false,
// 	    method: 'POST',
// 	    type: 'POST',
// 		success:function(resp){
// 			if(resp == 1){
// 				// alert_toast('Data successfully saved.',"success");
// 				setTimeout(function(){
// 					location.replace('index.php?page=home')
// 				},750)
// 			}else if(resp == 2){
// 				$('#msg').html("<div class='alert alert-danger'>Account ID already exist.</div>");
// 				$('[name="account_id"]').addClass("border-danger")
// 				end_load()
// 			}
// 		}
// 	})
// })