<x-app-dashboard title="{{ __('Graduated List') }}">
    @section('links')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endsection

    <x-slot name="header">
        {{ __('Graduated List') }}
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countGraduated" class="w-100" value="{{ $graduateds->count() }}">
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
                        <button formaction="{{ route('admin.graduated.deleteAll') }}" class="d-none" type="submit" id="form_deleteAll_graduated">
                            {{ __('Delete All Selected') }}
                        </button>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#modal-create-graduated">
                            {{ __('Create New a Graduated') }} <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table-graduateds" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="selectall" style="max-width: 15px !important; cursor: pointer;"></th>
                                    <th>{{ __('Graduateds') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($graduateds->count() > 0)
                                @foreach ($graduateds as $graduated)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $graduated->id }}" style="cursor: pointer;"></td>
                                    <td class="fw-500">
                                        {{ $graduated->name }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center text-center">
                                            <a href="{{ route('graduateds.show', $graduated->slug) }}" class="btn btn-sm btn-info ml-1 d-inline-flex align-items-center font-small">
                                                {{ __('Show') }} <i class="fas fa-eye ml-2"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#modal-edit{{ $graduated->slug }}" class="btn btn-sm btn-warning ml-1 d-inline-flex align-items-center font-small">
                                                {{ __('Edit') }} <i class="fas fa-edit ml-2"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger ml-1 d-inline-flex align-items-center font-small" id="btn_delete_graduated{{ $loop->iteration }}">
                                                {{ __('Remove') }} <i class="fas fa-solid fa-trash-alt ml-2"></i>
                                            </a>
                                            <form method="post" class="d-none">
                                                @method('delete')
                                                @csrf
                                                <button formaction="{{ route('graduateds.destroy', $graduated->slug) }}"class="d-none" id="form_delete_graduated{{ $loop->iteration }}">
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
                    <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> {{ __('New Forms of Graduated') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('graduateds.store') }}" id="form_create_graduated">
                    @csrf
                    <div class="modal-body">
                        <div class="border-bottom text-danger" style="border-color: #007BFF !important">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1">
                            <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name" class="col-form-label">{{ __('Graduated Name') }} <span class="text-danger">*</span></label>
                                <small class="text-lg-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="text" id="name_graduated" class="form-control error_input_name" placeholder="{{ __('Enter') }} {{ __('Graduated Name') }}" name="name" autofocus required>
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="slug" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="disabled" id="slug_graduated" class="form-control error_input_slug" placeholder="{{ __('Automatically') }}" name="slug" disable readonly required>
                            <span class="text-danger error-text slug_error"></span>
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
    @foreach ($graduateds as $graduated_edit)
    <div class="modal fade" id="modal-edit{{ $graduated_edit->slug }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">
                       <i class="fas fa-edit"></i> {{ __('Graduated Data Edit Form') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('graduateds.update', $graduated_edit->slug) }}" id="form_edit_graduated{{ $loop->iteration }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="border-bottom border-dark text-danger">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1 ">
                            <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name_edit_graduated" class="col-form-label">{{ __('Graduated Name') }} <span class="text-danger">*</span></label>
                                <small class="text-lg-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="text" id="name_edit_graduated{{ $loop->iteration }}" class="form-control error_input_name_edit_graduated" placeholder="{{ __('Enter') }} {{ __('Graduated Name') }}" name="name" value="{{ $graduated_edit->name }}" autofocus required>
                            <span class="text-danger error-text name_edit_graduated_error"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="slug_edit_graduated" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="disabled" id="slug_edit_graduated{{ $loop->iteration }}" class="form-control error_input_slug_edit_graduated" placeholder="{{ __('Automatically') }}" name="slug" disable readonly value="{{ $graduated_edit->slug }}" required>
                            <span class="text-danger error-text slug_edit_graduated_error"></span>
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
       
        $("#table-graduateds").DataTable({
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
                    // "sFirst": "First page", // This is the link to the first page
                    "sPrevious": "{{ __('Previous') }}", // This is the link to the previous page
                    "sNext": "{{ __('Next') }}", // This is the link to the next page
                    // "sLast": "Last page" // This is the link to the last page
                },
                "sInfoEmpty": "{{ __('DataTableInfoEmpty') }}",
                "sInfoFiltered" : "{{ __('DataTabelInfoFiltered') }}"
            },
        });

        // CheckSlug
        const nameEducation = document.querySelector('#name_graduated');
        const slugEducation = document.querySelector('#slug_graduated');

        nameEducation.addEventListener('change', function () {
            fetch('admin/check-graduateds/slug?name=' + nameEducation.value)
                .then(response => response.json())
                .then(data => slugEducation.value = data.slug)
        });

        $('#form_create_graduated').on('submit', function (e) {
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
                        });
                        alertToastInfo(data.msg)
                    } else {
                        $('#form_create_graduated')[0].reset();
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

        const countGraduated = document.querySelector('#countGraduated');
        for (let i = 1; i <= countGraduated.value; i++) {
            const name_edit_graduated = document.querySelector('#name_edit_graduated' + i);
            const slug_edit_graduated = document.querySelector('#slug_edit_graduated' + i);
            name_edit_graduated.addEventListener('change', function () {
                fetch('admin/check-graduateds/slug?name=' + name_edit_graduated.value)
                    .then(response => response.json())
                    .then(data => slug_edit_graduated.value = data.slug)
            });

            $('#form_edit_graduated' + i).on('submit', function (e) {
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
                                $('span.' + prefix + '_edit_graduated_error').text(val[0]);
                                $('input.error_input_' + prefix + '_edit_graduated').addClass('is-invalid');
                            });
                            alertToastInfo(data.msg)
                        } else {
                            $('#form_edit_graduated' + i)[0].reset();
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
                        $("#form_delete_graduated" + i).click();
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
                    $("#form_deleteAll_graduated").click();
                }
            });
        });
    </script>
    @endsection
</x-app-dashboard>