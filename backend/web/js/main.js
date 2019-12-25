$(document).ready(function () {
    $('select[name="status"]').change(function () {
        $.ajax({
            url: "/admin/author-requests/status-change?user_id=" + $(this).attr("data-id") + "&status=" + $(this).val()
        })
    })
});