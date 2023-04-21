@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">Portfolio</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Portfolio</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            My Portfolios
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-primary" id="addBtn">
                                Add Protfolio
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
                                    <th scope="col">Title</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Links</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($portfolio as $k=>$item)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ strtoupper($item->type) }}</td>
                                    <td>{{ $item->link }}</td>
                                    <td>
                                        <img class="img-thumbnail rounded" src="{{ asset('assets/img/portfolio/'.$item->image) }}" style="height: 40px" alt="img">
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info editBtn"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}"
                                            data-type="{{ $item->type }}"
                                            data-link="{{ $item->link }}"
                                            data-image="{{ $item->image }}"
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
                    <h5 class="modal-title" id="addModalLabel">Add Protfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="portfolioForm">
                        <input type="hidden" id="portfolio_id" name="id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Protfolio Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                                                
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Protfolio Type
                            </label>
                            <select class="form-select" id="type" name="type">
                                <option >Select Type</option>
                                <option value="web">Web</option>
                                <option value="app">App</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Protfolio Link</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="ex: https://example.com/">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Protfolio Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 submitBtn">Add Protfolio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    
    <script>
        let AppUrl = window.location.origin;


        //addModal
        $(document).on('click','#addBtn' , function (e) {
            e.preventDefault();
            $('#addModal').modal('show');
            $('#addModalLabel').html('Add Portfolio');
            $('.submitBtn').html('Add Portfolio');
            $('#portfolio_id').val('');
            $('#title').val('');
            $('#link').val('');
            $('#type').val('Select Type');
        });

        //editModal
        $(document).on('click', '.editBtn', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let title = $(this).data('title');
            let type = $(this).data('type');
            let link = $(this).data('link');
            $('#addModal').modal('show');
            $('#addModalLabel').html('Update Portfolio');
            $('.submitBtn').html('Update Portfolio');
            $('#portfolio_id').val(id);
            $('#title').val(title);
            $('#link').val(link);       
            $('#type').val(type);     
        });

        //++ Add & Update Portfolio Ajax ++//
        $(document).on('submit', '#portfolioForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#portfolioForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.portfolio.store')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notify(res.msg, res.cls)
                    $('#portfolioForm')[0].reset();
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
                        url: "{{route('admin.portfolio.delete')}}",
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