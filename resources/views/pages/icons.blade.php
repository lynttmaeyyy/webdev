@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'leavetype'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block" style="font-family: 'Montserrat', sans-serif;">Manage Leave Type</h4>
                    <button class="btn btn-info btn-sm float-right mt-3 add-btn">
                        Add Leave Type
                    </button>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leavetypes as $leavetype)
                                    <tr>
                                        <td>{{$leavetype->name}} </td>
                                        <td>{{$leavetype->description}} </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $leavetype->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $leavetype->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addLeaveTypeModal" tabindex="-1" aria-labelledby="addLeaveTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Add New LeaveType</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addLeaveTypeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="leavetype">LeaveType</label>
                        <input type="text" class="form-control" id="leavetype" name="leavetype" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Add LeaveType</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add modal for editing LeaveType -->
<div class="modal fade" id="editLeaveTypeModal" tabindex="-1" aria-labelledby="editLeaveTypeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLeaveTypeModalLabel">Edit LeaveType</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editLeaveTypeForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_leavetype_id" name="id">
                    <div class="form-group">
                        <label for="edit_leavetype">LeaveType</label>
                        <input type="text" class="form-control" id="edit_leavetype" name="leavetype" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="edit_lastname">LastName</label>
                        <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_gender">Gender</label>
                        <input type="text" class="form-control" id="edit_gender" name="gender" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_address">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_phonenumber">PhoneNumber</label>
                        <input type="text" class="form-control" id="edit_phonenumber" name="phonenumber" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_department">Department</label>
                        <input type="text" class="form-control" id="edit_department" name="department" required>
                </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update LeaveType</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.add-btn').click(function() {
            $('#addLeaveTypeModal').modal('show');
        });

        $('#addLeaveTypeForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("leavetypes.store") }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success!', 'LeaveType added successfully', 'success');
                    $('#addLeaveTypeModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('.edit-btn').click(function() {
            var leavetype_id = $(this).data('id');
            $.ajax({
                url: '/leavetypes/' + leavetype_id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#edit_leavetype_id').val(response.id);
                    $('#edit_leavetype').val(response.name);
                    $('#edit_description').val(response.description);
                    // $('#edit_lastname').val(response.lastname);
                    // $('#edit_gender').val(response.gender);
                    // $('#edit_address').val(response.address);
                    // $('#edit_phonenumber').val(response.phonenumber);
                    // $('#edit_department').val(response.department);
                    $('#editLeaveTypeModal').modal('show'); 
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('#editLeaveTypeForm').submit(function(e) {
            e.preventDefault();
            var leavetype_id = $('#edit_leavetype_id').val();
            $.ajax({
                url: '/leavetypes/' + leavetype_id,
                type: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success!', 'LeaveType updated successfully', 'success');
                    $('#editLeaveTypeModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('.delete-btn').click(function() {
            var leavetype_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this leavetype data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/leavetypes/' + leavetype_id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', response.message, 'success');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire('Error!', 'Failed to delete leavetype. Please try again later.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>