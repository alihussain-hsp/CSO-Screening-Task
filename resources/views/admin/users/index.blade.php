@extends('admin.layout.app')
@push('head-css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }
    </style>
@endpush
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="showNewUserForm()">Create</button>
                    {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> --}}
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm" id="users-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </main>
@endsection
@push('footer-js')
    <script src="{{ asset('assets/js/users.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const modalId = '#userModal';
        var userDataTable = null;
        const showErrors = function(object) {
            var keys = Object.keys(object);

            $(".has-error").find(".invalid-feedback").remove();
            $(".has-error").removeClass("has-error");
            $(".is-invalid").removeClass("is-invalid");

            for (var i = 0; i < keys.length; i++) {
                var ele = $("[name='" + keys[i] + "']");
                if (ele.length == 0) {
                    ele = $("#" + keys[i]);
                }

                var grp = ele.closest(".form-group");
                $(grp).find(".invalid-feedback").remove();
                var helpBlockContainer = $(grp).find("div:first");

                if (helpBlockContainer.length == 0) {
                    helpBlockContainer = $(grp);
                }
                helpBlockContainer.find('input').addClass('is-invalid');
                helpBlockContainer.append('<div class="invalid-feedback">' + object[keys[i]] + '</div>');
                $(grp).addClass("has-error");
            }
        };
        const showError = function(message) {
            Swal.fire({
                icon: 'error',
                toast: true,
                title: message,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        };
        const showSuccess = function(message) {
            Swal.fire({
                toast: true,
                icon: 'success',
                title: message,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        };

        function showNewUserForm() {
            let url = "{{ route('users.create') }}"
            $.ajaxModal(modalId, url, 'Create User', 'md');
        }
        $(document).on('click', '#create-user', function() {

            $.ajax({
                url: "{{ route('users.store') }}",
                container: '#createUserForm',
                type: "POST",
                data: $('#createUserForm', ).serialize(),
                file: true,
                success: function(response) {
                    if (response.status == 'success') {
                        $(modalId).modal('hide');
                        userDataTable.draw();
                        showSuccess(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        showErrors(xhr.responseJSON?.errors);
                    } else {
                        showError('An error occurred while creating the user.');
                    }
                }
            })
        });
        $(document).on('click', '#update-user', function() {
            const id = $(this).data('id');
            let url = "{{ route('users.update', ':id') }}"
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                container: '#updateUserForm',
                type: "PUT",
                data: $('#updateUserForm', ).serialize(),
                file: true,
                success: function(response) {
                    if (response.status == 'success') {
                        $(modalId).modal('hide');
                        userDataTable.draw();
                        showSuccess(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        showErrors(xhr.responseJSON?.errors);
                    } else {
                        showError('An error occurred while creating the user.');
                    }
                }
            })
        });

        function viewUser(id) {
            let url = "{{ route('users.show', ':id') }}"
            url = url.replace(':id', id);
            $.ajaxModal(modalId, url, 'View User', 'md');
        }

        function editUser(id) {
            let url = "{{ route('users.edit', ':id') }}"
            url = url.replace(':id', id);
            $.ajaxModal(modalId, url, 'Update User', 'md');
        }

        function deleteUser(id) {
            new swal({
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    title: "Are you sure?",
                    text: "You will not be able to recover this user!",
                })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        let url = "{{ route('users.destroy', ':id') }}";
                        url = url.replace(':id', 'id');

                        let data = {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        }
                        $.ajax({
                            url,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.status == 'success') {
                                    userDataTable.draw();
                                    showSuccess(response.message);
                                }
                            },
                            error: function(xhr) {
                                showError('An error occurred while creating the user.');
                            }
                        })
                    }
                });
        }
        $(document).ready(function() {
            userDataTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });
    </script>
@endpush
