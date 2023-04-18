@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">General Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">General Settings</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    General Settings
                </div>
                <div class="card-body">
                    <form id="settingForm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="site_name" class="form-label">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" value="{{ @$setting->site_name }}">
                            </div>
                            <div class="mb-3 col">
                                <label for="image" class="form-label">Favicon</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="col-auto mb-3">
                                <img id="faviconImg" class="img-thumbnail" style="height: 100px" src="{{ @$setting->favicon ? asset('assets/img/logoicon/' . @$setting->favicon) : 'https://static.vecteezy.com/system/resources/thumbnails/003/171/355/small/objective-lens-icon-with-six-rainbow-colors-vector.jpg' }}" alt="">
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
        $(document).on('submit', '#settingForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#settingForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.setting.update')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    let image = AppUrl+'/assets/img/logoicon/'+res.data.favicon
                    notify(res.msg, res.cls)
                    $('#faviconImg').attr('src', image);
                    $('.SiteName').html(res.data.site_name);
                }
            });
        });
    </script>
@endpush
