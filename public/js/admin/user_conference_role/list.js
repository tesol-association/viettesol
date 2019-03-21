$(document).ready(function() {
    $('#user_conference_role_list').DataTable({
        'order': [[0, 'desc']],
    });
    $('#name').select2();
});
