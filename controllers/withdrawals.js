// On change status update
function status_update(value,id){
    alert(value);
    let url = '/withdrawals';
    window.location.href = url + "?id=" + id + "&status=" + value;
}