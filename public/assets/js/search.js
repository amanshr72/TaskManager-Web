$(document).ready(function () {
    $('#search-input').on('keyup', function () {
        var search = $('#search-input').val();
        console.log(search);

        if(search == ''){
            window.location.href = '/dashboard';
        }

        $.ajax({
            url: "search",
            type: 'GET',
            data: { search: search },
            success: function (resp) {
                $('#dashboard-task-list').empty();
                $('#dashboard-task-list').html(resp);
            },
            error: function (resp) {
                console.log('Error:', resp);
            }
        });
    });
});
