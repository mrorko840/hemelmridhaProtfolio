@extends('backend.layouts.app')
@section('content')
    <h1 class="mt-4">Support</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ @$pageTitle }}</li>
    </ol>
    <div id="loadTable">
        <table class="table shadow rounded-3 text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Submitted By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($support as $k => $item)
                    <tr>
                        <td>{{ $k + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $item->is_read == 0 ? 'bg-danger' : 'bg-secondary' }}">
                                {{ $item->is_read == 0 ? 'Pending' : 'Complete' }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info rounded-circle viewMsgInfo"
                                data-bs-toggle="modal"
                                data-bs-target="#viewMsg"
                                data-id="{{$item->id}}"
                                data-name="{{$item->name}}"
                                data-email="{{$item->email}}"
                                data-subject="{{$item->subject}}"
                                data-message="{{$item->message}}"
                                data-is_read="{{$item->is_read}}"
                            >
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-danger rounded-circle deleteMsgInfo"
                                data-id="{{$item->id}}"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="viewMsg" tabindex="-1" aria-labelledby="viewMsgLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewMsgLabel">Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th>From:</th>
                                <td id="name" class="w-100">Hi</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td id="email" class="w-100">Hi</td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td id="subject" class="w-100">Hi</td>
                            </tr>
                            <tr>
                                <th>Message:</th>
                                <td id="message" class="w-100">Hi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="isReadForm">
                        <input type="hidden" id="support_id" name="id">
                        <button type="submit" class="btn btn-primary submitRead">Yes, I have Read</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        //show message
        $(document).on('click', '.viewMsgInfo', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let subject = $(this).data('subject');
            let message = $(this).data('message');
            let is_read = $(this).data('is_read');
            
            $('#support_id').val(id);
            $('#name').html(name);
            $('#email').html(email);
            $('#subject').html(subject);
            $('#message').html(message);
            if(is_read == 0){
                $('.submitRead').html('Yes, I have Read').removeAttr('disabled');
            }else{
                $('.submitRead').html('You have already read this Message!').attr('disabled', 'disabled');
            }
        });

        //selete Message
        $(document).on('click', '.deleteMsgInfo', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.support.delete')}}",
                        data: {id:id},
                        success: function (res) {
                            notify(res.msg, res.cls)
                            $('#loadTable').load(location.href+' #loadTable');
                            pendingAlertCheck(res.count);
                        }
                    });
                }
            })
            
        });

        //isRead submit
        $(document).on('submit', '#isReadForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#isReadForm')[0]);
            $.ajax({
                type: "POST",
                url: "{{route('admin.support.isRead')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notify(res.msg, res.cls);
                    $('#isReadForm')[0].reset();
                    $('#loadTable').load(location.href+' #loadTable');
                    $('#viewMsg').modal('hide');
                    //function-Call
                    pendingAlertCheck(res.count);
                }
            });
            
        });
    </script>
@endpush
