@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">Skills</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Skills</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            My Skills
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-primary" id="addBtn">
                                Add Skill
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
                                    <th scope="col">Percentage</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skill as $k=>$item)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->percentage . '%' }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info editBtn"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-percentage="{{ $item->percentage }}"
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
                    <h5 class="modal-title" id="addModalLabel">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="skillForm">
                        <input type="hidden" id="skill_id" name="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Skill Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="percentage" class="form-label">Efficiency (<small class="text-secondary percentage"></small>)</label>
                            <input type="range" class="w-100" id="percentage" name="percentage">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 submitBtn">Add Skill</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        let AppUrl = window.location.origin;

        //percentLiveShow
        $('#percentage').on('input', function (e) {
            e.preventDefault();
            let percentage = $(this).val();
            $('.percentage').html(percentage+'%');
        });

        //addModal
        $(document).on('click','#addBtn' , function (e) {
            e.preventDefault();
            $('#addModal').modal('show');
            $('#addModalLabel').html('Add Skill');
            $('.submitBtn').html('Add Skill');
            $('#skill_id').val('');
            $('#name').val('');
            $('#percentage').val('0');
            $('.percentage').html('0%');
        });

        //editModal
        $(document).on('click', '.editBtn', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let percentage = $(this).data('percentage');
            $('#addModal').modal('show');
            $('#addModalLabel').html('Update Skill');
            $('.submitBtn').html('Update Skill');
            $('#skill_id').val(id);
            $('#name').val(name);       
            $('#percentage').val(percentage);       
            $('.percentage').html(percentage+'%');       
        });

        //++ Add & Update Skill Ajax ++//
        $(document).on('submit', '#skillForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#skillForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.skills.store')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notify(res.msg, res.cls)
                    $('#skillForm')[0].reset();
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
                        url: "{{route('admin.skills.delete')}}",
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