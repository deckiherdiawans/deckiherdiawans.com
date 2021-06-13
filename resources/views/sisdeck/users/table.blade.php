<div class="table-responsive">
    <table class="table table-bordered table-hover" id="dhs_users-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Fullname</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sisdeckUsers as $sisdeckUser)
            <tr>
                <td>{{ $sisdeckUser->username }}</td>
                <td>{{ $sisdeckUser->fullname }}</td>
                <td class="text-center">
                    <div class='btn-group'>
                        <a href="#" data-user_id="{{ $sisdeckUser->id }}" data-username="{{ $sisdeckUser->username }}"
                           data-fullname="{{ $sisdeckUser->fullname }}" data-role_name="{{ $sisdeckUser->role_name }}"
                           data-email="{{ $sisdeckUser->email }}" data-toggle="modal" data-target="#read-user_modal"
                           title="Detail" class="btn btn-success btn-xs"><i class="fas fa-fw fa-eye"></i>
                        </a>
                        <a href="#" data-username="{{ $sisdeckUser->username }}" data-fullname="{{ $sisdeckUser->fullname }}"
                           data-role_name="{{ $sisdeckUser->role_name }}" data-email="{{ $sisdeckUser->email }}" data-toggle="modal"
                           data-target="#update-user_modal" title="Update" class="btn btn-warning btn-xs text-white update-user_button">
                           <i class="fas fa-fw fa-edit"></i>
                        </a>
                        {!! Form::open(['route' => ['sisdeck.users.destroy', $sisdeckUser->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fas fa-fw fa-trash"></i>', ['type' => 'submit', 'title' => 'Delete', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $('#read-user_modal').on('show.bs.modal', function (event) {
            const
                button = $(event.relatedTarget),
                user_id = button.data('user_id'),
                username = button.data('username'),
                fullname = button.data('fullname'),
                role_name = button.data('role_name'),
                email = button.data('email'),
                modal = $(this);

            modal.find('.modal-body table tbody tr #user-id_value').text(user_id);
            modal.find('.modal-body table tbody tr #user-username_value').text(username);
            modal.find('.modal-body table tbody tr #user-fullname_value').text(fullname);
            modal.find('.modal-body table tbody tr #user-role_name_value').text(role_name);
            modal.find('.modal-body table tbody tr #user-email_value').text(email);
        });

        $('#update-user_modal').on('show.bs.modal', function (event) {
            const
                button = $(event.relatedTarget),
                username = button.data('username'),
                fullname = button.data('fullname'),
                role_name = button.data('role_name'),
                email = button.data('email'),
                modal = $(this);

            modal.find('.modal-body #user-username_update').val(username);
            modal.find('.modal-body #user-fullname_update').val(fullname);
            modal.find('.modal-body #user-role-name_update').val(role_name);
            modal.find('.modal-body #user-email_update').val(email);

            setTimeout(function () {
                modal.find('.modal-body #user-username_update').focus();
            }, 100);
        });
    </script>
@endpush