@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">Contact</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Contact</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Contact
                </div>
                <div class="card-body">
                    <form id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ @$contact->location }}">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ @$contact->email }}">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ @$contact->phone }}">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="map" class="form-label">Map Link</label>
                                <input type="text" class="form-control" id="map" name="map" value="{{ @$contact->map }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Data</button>
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
        $(document).on('submit', '#contactForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#contactForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.contact.update')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notify(res.msg, res.cls)
                }
            });
        });
    </script>
@endpush
