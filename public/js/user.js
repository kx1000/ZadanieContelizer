const usersApi = {
    fetchFilteredUsers() {
        $.get("https://gorest.co.in/public-api/users?email=" + $('#filter-email').val(), data => {
            $('#users-table > tbody').html('');
            data.data.forEach(user => {
                $('#users-table > tbody')
                    .append(
                        '<tr>' +
                        '<td>' + user.id + '</td>' +
                        '<td>' + user.name + '</td>' +
                        '<td>' + user.email + '</td>' +
                        '<td>' + user.gender + '</td>' +
                        '<td>' + user.status + '</td>' +
                        '<td>' + user.created_at + '</td>' +
                        '<td>' + user.updated_at + '</td>' +
                        '<td>' +
                        '<button ' +
                        'data-id="' + user.id + '" ' +
                        'data-name="' + user.name + '" ' +
                        'data-email="' + user.email + '" ' +
                        'data-gender="' + user.gender + '" ' +
                        'data-status="' + user.status + '" ' +
                        'class="user-edit">' +
                        'edit' +
                        '</button>' +
                        '</td>' +
                        '</tr>'
                    )
            });
        });
    },
    updateUser(id, user) {
        $.ajax({
            url: 'https://gorest.co.in/public-api/users/' + id,
            type: 'put',
            data: user,
            headers: {
                Authorization: 'Bearer b550e0297695de854a5d8fab2351dd3e55b96596107674a745f6ff5fbc712874',
            },
            dataType: 'json',
            success: data => {
                if (401 === data.code) {
                    alert('Auth failed');
                } else if (200 === data.code) {
                    this.fetchFilteredUsers();
                }
            }
        });
    },
}

usersApi.fetchFilteredUsers();

$('#filter-email').keyup(() => {
    usersApi.fetchFilteredUsers();
});

$(document).on('click', '.user-edit' , (e) => {
    let editBtn = $(e.target);
    editBtn.parent().parent().html(
        '<td>#</td>' +
        '<td><input type="text" class="user-name" value="' + editBtn.data('name') + '" /></td>' +
        '<td><input type="email" class="user-email" value="' + editBtn.data('email') + '" /></td>' +
        '<td>' +
        '<select class="user-gender">' +
        '<option value="Male" ' + (editBtn.data('gender') === 'Male' ? 'selected="selected"' : '') + '>Male</option>' +
        '<option value="Female" ' + (editBtn.data('gender') === 'Female' ? 'selected="selected"' : '') + '>Female</option>' +
        '</select>' +
        '</td>' +
        '<td>' +
        '<select class="user-status">' +
        '<option value="Active">Active</option>' +
        '<option value="Inactive">Inactive</option>' +
        '</select>' +
        '</td>' +
        '<td>#</td>' +
        '<td>#</td>' +
        '<td><button class="user-update" data-id="' + editBtn.data('id') + '">update</button></td>'
    );
});

$(document).on('click', '.user-update' , (e) => {
    let updateBtn = $(e.target);
    let editRow = updateBtn.parent().parent();

    usersApi.updateUser(updateBtn.data('id'), {
        name: editRow.find('td > .user-name').val(),
        email: editRow.find('td > .user-email').val(),
        gender: editRow.find('td > .user-gender').val(),
        status: editRow.find('td > .user-status').val(),
    });
});