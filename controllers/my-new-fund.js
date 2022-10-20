function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $('#photo_upload').attr('src', e.target.result);
            // $('#preview').html('<img src="'+event.target.result+'" width="300" height="auto"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#file-upload").change(function () {
    imagePreview(this);
});


// function displayImg(input,_this) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#cimg').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $('#create_new_fund').submit(function(e){
//     e.preventDefault()
//     $('input').removeClass("border-danger")
//     // start_load()
//     var token = document.getElementById("csrf").value;
//     $.ajax({
//         url:'/ajax?action=start_new_fund_user',
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
//                     // alert("hello, start_new_fund_user fnc work!");
//                     location.replace('/my-new-fund/' + token);
//                 },750)
//             }else{
//                 $('#msg').html("<div class='alert alert-danger'>Account already exist.</div>");
//                 $('[name="d_firstname"]').addClass("border-danger")
//                 // end_load()
//             }
//         }
//     })
// })
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

