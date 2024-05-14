$(document).ready(function () {
    $('#status').change(function () {
        var status = $('#status').val();

        $('#resstFilterBtn').click(function () {
            window.location.href = '/dashboard';
        });

        $.ajax({
            url: "filter",
            type: 'GET',
            data: { status: status },
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

