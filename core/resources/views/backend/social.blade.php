@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">Social Info</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Social Info</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            My Social Info
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-primary" id="addBtn">
                                Add Social Info
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="loadTable">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($social as $k=>$item)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->link }}</td>
                                    <td>
                                        <i class="{{$item->icon}}"></i>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info editBtn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-link="{{ $item->link }}"
                                            data-icon="{{ $item->icon }}"
                                            >
                                            Edit
                                        </a>
                                        <a class="btn btn-sm btn-danger dltBtn" data-id="{{ $item->id }}">
                                            Delete
                                        </a>
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

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Social Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="socialForm">
                        <input type="hidden" id="social_id" name="id">
                        <div class="mb-3">
                            <label for="percentage" class="form-label">Select Icon</label>
                            <input type="text" id="icon" name="icon" class="form-control iconpicker" placeholder="Icon Picker" aria-label="Icone Picker" aria-describedby="basic-addon1" />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Social Platform Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Social Account Link</label>
                            <input type="text" class="form-control" id="link" name="link">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 submitBtn">Add Social Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        let AppUrl = window.location.origin;

        $(function(){
            $('.iconpicker').iconpicker();
        });

        //addModal
        $(document).on('click','#addBtn' , function (e) {
            e.preventDefault();
            $('#addModal').modal('show');
            $('#addModalLabel').html('Add Social Info');
            $('.submitBtn').html('Add Social Info');
            $('#social_id').val('');
            $('#name').val('');
            $('#link').val('');       
            $('#icon').val(''); 
        });

        //editModal
        $(document).on('click', '.editBtn', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let link = $(this).data('link');
            let icon = $(this).data('icon');
            $('#addModal').modal('show');
            $('#addModalLabel').html('Update Social Info');
            $('.submitBtn').html('Update Social Info');
            $('#social_id').val(id);
            $('#name').val(name);       
            $('#link').val(link);       
            $('#icon').val(icon);     
        });

        //++ Add & Update Social Info Ajax ++//
        $(document).on('submit', '#socialForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#socialForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.social.store')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notify(res.msg, res.cls)
                    $('#socialForm')[0].reset();
                    $('#addModal').modal('hide');
                    $('#loadTable').load(location.href+' #loadTable');
                }
            });
        });

        //++ Delete Portfolio ++//
        $(document).on('click', '.dltBtn', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            console.log(id);
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
                        url: "{{route('admin.social.delete')}}",
                        data: {id:id},
                        success: function (res) {
                            notify(res.msg, res.cls)
                            $('#loadTable').load(location.href+' #loadTable');
                        }
                    });
                }
            })
        });
    </script>
@endpush