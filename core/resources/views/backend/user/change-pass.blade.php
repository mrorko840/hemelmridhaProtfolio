@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">Setting</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Change Password</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Password Change
                </div>
                <div class="card-body">
                    <div class="alert alert-danger d-none" id="errorMsg" role="alert">
                        
                    </div>
                    <form id="updatePassForm">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="old_pass" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="old_pass" name="old_pass">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="new_pass" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_pass" name="new_pass">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="confirm_new_pass" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_new_pass" name="confirm_new_pass">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        let AppUrl = window.location.origin;
        
        //update-pass
        $(document).on('submit', '#updatePassForm', function (e) {
            e.preventDefault();
            let formData = new FormData($(this)[0])
            $.ajax({
                type: "POST",
                url: "{{route('update.pass')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notify(res.msg, res.cls)
                    $('#errorMsg').html('').addClass('d-none')
                    if(res.cls == 'success'){
                        $('#updatePassForm')[0].reset();
                        $('#confirm_new_pass').removeClass('is-valid')
                    }
                },
                error: function (err) {
                    let errors = err.responseJSON.errors
                    console.log(errors);
                    $('#errorMsg').html('').addClass('d-none')
                    $.each(errors, function (index, value) { 
                        console.log(value);
                        $('#errorMsg').append(value[0]+'<br>').removeClass('d-none');
                    });
                }
            });
        });


        //is-valid checker
        $(document).on('input', '#confirm_new_pass', function (e) {
            e.preventDefault();
            let new_pass = $('#new_pass').val();

            if($(this).val() != new_pass){
                $(this).removeClass('is-valid').addClass('is-invalid');
            }else{
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        $(document).on('input', '#new_pass', function (e) {
            e.preventDefault();
            let confirm_new_pass = $('#confirm_new_pass').val();

            if($(this).val() != confirm_new_pass){
                if(confirm_new_pass != ''){
                    $('#confirm_new_pass').removeClass('is-valid').addClass('is-invalid');
                }
            }else{
                $('#confirm_new_pass').removeClass('is-invalid').addClass('is-valid');
            }
        });


    </script>
@endpush
