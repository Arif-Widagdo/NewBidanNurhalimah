<x-app-dashboard title="{{ __('Category List') }}">
    @section('links')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endsection

    <x-slot name="header">
        {{ __('Category List') }}
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countCategory" class="w-100" value="{{ $categories->count() }}">
        </div>
    </div>

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <form method="post">
                @method('delete')
                @csrf
                    <div class="card-header align-items-center">
                        <a class="btn btn-danger float-left" id="btn_delete_all" hidden>
                            <i class="fas fa-solid fa-trash-alt"></i> {{ __('Delete All Selected') }}
                        </a>
                        <button formaction="{{ route('admin.category.deleteAll') }}" class="d-none" type="submit" id="form_deleteAll_category">
                            {{ __('Delete All Selected') }}
                        </button>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#modal-create-graduated">
                            {{ __('Create New Category') }} <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table-category" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="selectall" style="max-width: 15px !important; cursor: pointer;"></th>
                                    <th>{{ __('Name') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($categories->count() > 0)
                                @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $category->id }}" style="cursor: pointer;"></td>
                                    <td class="fw-500">
                                        {{ $category->name }}
                                    </td>
                                    <td class="text-center"> 
                                        @if($category->status == 'actived')
                                        <i class="fas fa-check-circle text-success text-lg shadow rounded-circle" ></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center text-center">
                                            <a data-toggle="modal" data-target="#modal-edit{{ $category->slug }}" class="btn btn-sm btn-warning ml-1 d-inline-flex align-items-center font-small">
                                                {{ __('Edit') }} <i class="fas fa-edit ml-2"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger ml-1 d-inline-flex align-items-center font-small" id="btn_delete_graduated{{ $loop->iteration }}">
                                                {{ __('Remove') }} <i class="fas fa-solid fa-trash-alt ml-2"></i>
                                            </a>
                                            <form method="post" class="d-none">
                                                @method('delete')
                                                @csrf
                                                <button formaction="{{ route('categories.destroy', $category->slug) }}" class="d-none" id="form_delete_category{{ $loop->iteration }}">
                                                    {{ __('Remove') }} <i class="fas fa-solid fa-trash-alt ml-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <!--- Modal Create -->
    <div class="modal fade" id="modal-create-graduated">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> {{ __('New Category Form') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}" id="form_create_category">
                    @csrf
                    <div class="modal-body">
                        <div class="border-bottom text-danger" style="border-color: #007BFF !important">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1">
                            <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name" class="col-form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <small class="text-lg-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="text" id="name_category" class="form-control error_input_name" placeholder="{{ __('Enter') }} {{ __('Name') }}" name="name" autofocus >
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="slug" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="disabled" id="slug_category" class="form-control error_input_slug" placeholder="{{ __('Automatically') }}" name="slug" disable readonly >
                            <span class="text-danger error-text slug_error"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="status" class="col-form-label"> {{ __('Activation Status') }} <span class="text-danger">*</span></label>
                            <select required class="form-control select2 error_input_status" style="width: 100%;" name="status">
                                <option selected="selected" disabled>{{ __('Select Status') }}</option>
                                <option value="actived">{{ __('Active') }}</option>
                                <option value="not_actived">{{ __('Not Active') }}</option>
                            </select>
                            <span class="text-danger error-text status_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!--- Modal Edit -->
    @foreach ($categories as $category_edit)
    <div class="modal fade" id="modal-edit{{ $category_edit->slug }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">
                       <i class="fas fa-edit"></i> {{ __('Form Edit Category') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('categories.update', $category_edit->slug) }}" id="form_edit_category{{ $loop->iteration }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="border-bottom border-dark text-danger">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1 ">
                            <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name_edit_category" class="col-form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <small class="text-lg-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="text" id="name_edit_category{{ $loop->iteration }}" class="form-control error_input_name_edit_category" placeholder="{{ __('Enter') }} {{ __('Name') }}" name="name" value="{{ $category_edit->name }}" autofocus >
                            <span class="text-danger error-text name_edit_category_error"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="slug_edit_category" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="disabled" id="slug_edit_category{{ $loop->iteration }}" class="form-control error_input_slug_edit_category" placeholder="{{ __('Automatically') }}" name="slug" disable readonly value="{{ $category_edit->slug }}" >
                            <span class="text-danger error-text slug_edit_category_error"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="category_status_edit" class="col-form-label"> {{ __('Activation Status') }} <span class="text-danger">*</span></label>
                            <select class="form-control error_input_category_status_edit_edit_category_error" style="width: 100%;" name="category_status_edit">
                               <option selected="selected">{{ __('Select Status') }}</option>
                                @if($category_edit->status === 'actived')
                                <option value="actived" selected="selected">{{ __('Active') }}</option> 
                                <option value="not_actived">{{ __('Not Active') }}</option> 
                                @else
                                <option value="actived">{{ __('Active') }}</option>
                                <option value="not_actived" selected="selected">{{ __('Not Active') }}</option>
                                @endif
                            </select>
                            <span class="text-danger error-text category_status_edit_edit_category_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-dark">{{ __('Save Change') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach
    <!-- /.modal -->


    @section('scripts')
    <!-- Select 2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Customs for pages -->
    <script>
       
        $("#table-category").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [[-1, 5, 10, 25, 50 , 100], ["{{ __('All') }}", 5, 10, 25, 50, 100]],
            "order": [],
            "columnDefs": [{
                "targets": [0, 2],
                "orderable": false,
            }],
            "oLanguage": {
                "sSearch": "{{ __('Quick Search') }}",
                "sLengthMenu": "{{ __('DataTableLengthMenu') }}", 
                "sInfo": "{{ __('DataTableInfo') }}",
                "oPaginate": {
                    "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
                    "sNext": "{{ __('Next') }}", // This is the link to the next page
                },
                "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
                "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
            },
        });

        // CheckSlug
        const nameCategory = document.querySelector('#name_category');
        const slugCategory = document.querySelector('#slug_category');

        nameCategory.addEventListener('change', function () {
            fetch('admin/categories/slug?name=' + nameCategory.value)
                .then(response => response.json())
                .then(data => slugCategory.value = data.slug)
        });

        $('#form_create_category').on('submit', function (e) {
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
                            $('select.error_input_' + prefix).addClass('is-invalid');
                        });
                        alertToastInfo(data.msg)
                    } else {
                        $('#form_create_category')[0].reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                        alertToastSuccess(data.msg)
                    }
                },
                error: function (xhr) {
                    Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again ') }}', 'error')
                }
            });
        });

        const countCategory = document.querySelector('#countCategory');
        for (let i = 1; i <= countCategory.value; i++) {
            const name_edit_category = document.querySelector('#name_edit_category' + i);
            const slug_edit_category = document.querySelector('#slug_edit_category' + i);
            name_edit_category.addEventListener('change', function () {
                fetch('admin/categories/slug?name=' + name_edit_category.value)
                    .then(response => response.json())
                    .then(data => slug_edit_category.value = data.slug)
            });

            $('#form_edit_category' + i).on('submit', function (e) {
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
                                $('span.' + prefix + '_edit_category_error').text(val[0]);
                                $('input.error_input_' + prefix + '_edit_category').addClass('is-invalid');
                                $('select.error_input_' + prefix+ '_edit_category_error').addClass('is-invalid');
                            });
                            alertToastInfo(data.msg)
                        } else {
                            $('#form_edit_category' + i)[0].reset();
                            setTimeout(function () {
                                location.reload(true);
                            }, 1000);
                            alertToastSuccess(data.msg)
                        }
                    },
                    error: function (xhr) {
                        Swal.fire(xhr.statusText, '{{ __('Wait a few minutes to try again ') }}', 'error')
                    }
                });
            });

            $('#btn_delete_graduated' + i).on('click', function (e) {
                e.preventDefault();
                swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('You wont be able to revert this') }}",
                    icon: 'warning',
                    iconColor: '#FD7E14',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#DC3545',
                    confirmButtonText: "{{ __('Yes, deleted it') }}",
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_delete_category" + i).click();
                    }
                });
            });
        }

        $('#btn_delete_all').on('click',function(e){
            e.preventDefault();
            swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('You wont be able to revert this') }}",
                icon: 'warning',
                iconColor: '#FD7E14',
                showCancelButton: true,
                confirmButtonColor: '#007BFF',
                cancelButtonColor: '#DC3545',
                confirmButtonText: "{{ __('Yes, deleted it') }}",
                cancelButtonText: "{{ __('Cancel') }}"
            }).then((result) => {
                if (result.isConfirmed){
                    $("#form_deleteAll_category").click();
                }
            });
        });
    </script>
    @endsection
</x-app-dashboard>