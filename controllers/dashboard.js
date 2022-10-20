$(document).ready(function(){
    // Donees-List Anonymous/User (type=1/2)
    $('#oldestBtn').on('click', function() {
        $('#new_donees').addClass('hide');
        $('#list_donees').addClass('hide');
        $('#oldestBtn').addClass('bg-lavander');
        $('#oldestBtn').addClass('text-white');
        $('#newestBtn').removeClass('text-white');
        $('#newestBtn').removeClass('bg-lavander');            
        $('#old_donees').removeClass('hide');
        $('.no-donee').addClass('hide');
    })
    $('#newestBtn').on('click', function() {
        $('#old_donees').addClass('hide');
        $('#list_donees').addClass('hide');
        $('#newestBtn').addClass('bg-lavander');
        $('#newestBtn').addClass('text-white');
        $('#oldestBtn').removeClass('text-white');
        $('#oldestBtn').removeClass('bg-lavander');
        $('#new_donees').removeClass('hide');
        $('.no-donee').addClass('hide');
    })
    // Donees-List User (type=2)
    $('#oldestBtnUser').on('click', function() {
        $('#new_donees_user').addClass('hide');
        $('#list_donees_user').addClass('hide');
        $('#oldestBtnUser').addClass('bg-lavander');
        $('#oldestBtnUser').addClass('text-white');
        $('#newestBtnUser').removeClass('text-white');
        $('#newestBtnUser').removeClass('bg-lavander');            
        $('#old_donees_user').removeClass('hide');
        $('.no-donee').addClass('hide');
    })
    $('#newestBtnUser').on('click', function() {
        $('#old_donees_user').addClass('hide');
        $('#list_donees_user').addClass('hide');
        $('#newestBtnUser').addClass('bg-lavander');
        $('#newestBtnUser').addClass('text-white');
        $('#oldestBtnUser').removeClass('text-white');
        $('#oldestBtnUser').removeClass('bg-lavander');
        $('#new_donees_user').removeClass('hide');
        $('.no-donee').addClass('hide');
    })
    
})
// JavaScript code
function search_donees() {
    let input = document.getElementById('searchbar').value
    input=input.toLowerCase();
    let x = document.getElementsByClassName('donee');
    
    for (i = 0; i < x.length; i++) { 
        if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].style.display="none";          
        }
        else {
            x[i].style.display="list-item";
        }
    }
}