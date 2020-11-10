require('./bootstrap');

$(function() {
    $('.form-check-input:checkbox').on('change', function() {

        let dataID = $(this).attr('data-id');
        let answer = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'check',
            data: { id: dataID, checked: answer }
        }); 

    });

    $('#removeImage:checkbox').on('change', function() {
        if ($(this).is(':checked')) {
            $('#imageUpload').hide();
        } else {
            $('#imageUpload').show();
        }
    });
});