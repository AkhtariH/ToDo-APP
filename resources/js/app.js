require('./bootstrap');

$(function() {
    $(':checkbox').on('change', function() {

        let dataID = $(this).attr('data-id');
        let answer = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/check',
            data: { id: dataID, checked: answer }
        }); 

    }); 
});