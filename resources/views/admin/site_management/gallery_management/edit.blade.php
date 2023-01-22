<x-app-dashboard title="{{ __('Image List') }}">
    @section('links')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endsection

    <x-slot name="header">
        <i class="fas fa-edit"></i> {{ __('Image Edit Form') }}
    </x-slot>
    <x-slot name="links">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('galleries.index') }}">{{ __('Images') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Edit') }}</li>
        </ol>
    </x-slot>


    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark card-outline">
                <form class="form-horizontal" method="POST" action="{{ route('galleries.update', $gallery->slug) }}" id="form_edit_gallery" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="border-bottom border-dark text-danger">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1">
                            <label for="title" class="col-form-label">{{ __('Image Title') }} <span class="text-danger">*</span></label>
                            <input type="text" id="title" class="form-control error_input_title" placeholder="{{ __('Enter') }} {{ __('Image Title') }}" name="title" value="{{ $gallery->title }}" autofocus >
                            <span class="text-danger error-text title_error"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="category_id" class="col-form-label">
                                {{ __('Image Category') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2" style="width: 100%;" name="category_id" id="category_id">
                                <option selected="selected" disabled >{{ __('Select Image Category') }}</option>
                                @foreach ($categories as $category)
                                    @if($gallery->category_id != '' && $gallery->category->id  == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger error-text category_id_error"></span>
                        </div>
                        <input type="hidden" name="oldImage" value="{{ $gallery->image }}">
                        <div class="form-group mb-1">
                            <label for="image" class="col-form-label">{{ __('Image') }} <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input error_input_image" accept="image/png, image/gif, image/jpeg" id="image" name="image" onchange="previewImage()">
                                <label class="custom-file-label" for="image">{{ __('Choose File') }}</label>
                            </div>
                            <small class="mt-1 text-dark">
                                {{ __('Recomen Image') }}
                                <span class="text-bold">800x600</span>| {{ __('File Size') }} <span class="text-bold"> 1024 kb</span>
                                {{ __('or') }} <span class="text-bold"> 1 MB</span>
                            </small>
                            <br>
                            <span class="text-danger error-text image_error"></span>
                        </div>
                        <div class="form-group mb-1">
                            <img src="{{ $gallery->image }}" alt="Preview Image" class="img-fluid mb-3 rounded-lg img-preview img-fluid border w-100" style="height: 600px; width: 800px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-default" href="{{ route('galleries.index') }}"><i class="fas fa-arrow-alt-circle-left"></i> {{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-dark float-right">{{ __('Save Change') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->

    @section('scripts')
    <!-- Select 2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Customs for pages -->
    <script>
        $('.select2').select2();

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $('#form_edit_gallery').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                            $('input.error_input_' + prefix).addClass('is-invalid');
                            $('#'+ prefix +' + span').addClass("is-invalid");
                        });
                        alertToastInfo(data.msg)
                    } else {
                        $('#form_edit_gallery')[0].reset();
                        setTimeout(function () {
                            window.location.href='admin/galleries'
                        }, 1000);
                        alertToastSuccess(data.msg)
                    }
                },
                error: function (xhr) {
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again ') }}', 'error')
                }
            });
        });

    </script>
    @endsection
</x-app-dashboard>