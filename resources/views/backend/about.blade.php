@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">About</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">About</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    About Data
                </div>
                <div class="card-body">
                    <form action="{{route('admin.about.update')}}" method="post" id="aboutForm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ @$about->title }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ @$about->name }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ @$about->email }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ @$about->phone }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="{{ @$about->dob }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{ @$about->website }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="education" class="form-label">Education Qualification</label>
                                <input type="text" class="form-control" id="education" name="education" value="{{ @$about->education }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ @$about->address }}">
                            </div>
                            <div class="mb-3 col">
                                <label for="image" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="col-auto mb-3">
                                <img id="profileImg" class="img-thumbnail" style="height: 100px" src="{{ @$about->image ? asset('assets/img/profile/' . @$about->image) : 'https://www.pngitem.com/pimgs/m/111-1114839_circle-people-icon-flat-png-avatar-icon-transparent.png' }}" alt="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea class="form-control" name="details" id="details" rows="5">{{ @$about->details }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        let AppUrl = window.location.origin;
        //++ update all data ++//
        $(document).on('submit', '#aboutForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#aboutForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.about.update')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    
                    let image = AppUrl+'/assets/img/profile/'+res.data.image
                    notify(res.msg, res.cls)
                    $('#profileImg').attr('src', image);
                }
            });
        });
    </script>
@endpush
