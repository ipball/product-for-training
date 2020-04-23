$(function(){
    $('.is-all').on('click', function(){
        var checkClass = $(this).attr('data-id');
        var isChecked = $(this).children('.check-all').is(':checked');
        
        $('.'+checkClass).prop('checked', isChecked);
        // check all long code...., result sam above code
        // if(isChecked) {
        //     $('.'+checkClass).prop('checked', true);
        // } else {
        //     $('.'+checkClass).prop('checked', false);
        // }
    });
});