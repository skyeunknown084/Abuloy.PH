function status_update($value,$id){
    // start_load()
    $.ajax({
        url:'ajax?action=update_all_fund_status',
        method:'POST',
        data:{id:$id, value:$value},
        success:function(resp){
            alert(resp);
            if(resp){
                setTimeout(function(){
                // end_load()
                location.reload();
                },400)
            }
            else{
                alert("Error! Status not changed!");
            }
        }
    })
}