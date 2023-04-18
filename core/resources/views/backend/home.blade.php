@extends('backend.layouts.app')

@section('content')
    <h1 class="mt-4">Home Section</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Home Section</li>
    </ol>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Home Section
                </div>
                <div class="card-body">
                    <form id="homeForm">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="profession" class="form-label">Profession</label>
                                <select class="select2-auto-tokenize form-control" multiple="multiple" id="profession" name="profession[]">
                                    @foreach (json_decode($home_section->profession) as $profession)
                                    <option selected value="{{$profession}}">{{$profession}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <small class="mt-2">Separate multiple keywords by<code>,</code>(@lang('comma')) @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="image" class="form-label">Background Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="col-12 mb-3">
                                <img id="bgImg" class="img-thumbnail img-fluid" src="{{ @$home_section->bg_img ? asset('assets/img/home_section/' . @$home_section->bg_img) : 'https://static.vecteezy.com/system/resources/thumbnails/003/171/355/small/objective-lens-icon-with-six-rainbow-colors-vector.jpg' }}" alt="">
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

        $(".select2-auto-tokenize").select2({
            tags: true,
            tokenSeparators: [',']
        })

        //++ update all data ++//
        $(document).on('submit', '#homeForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#homeForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.home.update')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    let image = AppUrl+'/assets/img/home_section/'+res.data.bg_img
                    notify(res.msg, res.cls)
                    $('#bgImg').attr('src', image);
                    $('.SiteName').html(res.data.site_name);
                }
            });
        });
    </script>
@endpush
