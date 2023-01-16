<x-app-dashboard title="{{ __('List of Types of Birth Control') }}">

    <x-slot name="header">
        {{ __('List of Types of Birth Control') }}
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countBirth" class="w-100" value="{{ $birth_controls->count() }}">
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
                        <button formaction="{{ route('birth-controls.deleteAll') }}" class="d-none" type="submit" id="form_deleteAll_birth-controls">
                            {{ __('Delete All Selected') }}
                        </button>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#modal-create-birth-controls">
                            {{ __('Add Types of Birth Control') }} <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table-birth-controls" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="selectall" style="max-width: 15px !important; cursor: pointer;"></th>
                                    <th>{{ __('Name of Birth Control Types') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($birth_controls->count() > 0)
                                @foreach ($birth_controls as $birth_control)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $birth_control->id }}" style="cursor: pointer;"></td>
                                    <td class="fw-500">
                                        {{ $birth_control->name }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center text-center">
                                            <a href="{{ route('birth-controls.show', $birth_control->slug) }}" class="btn btn-sm btn-info ml-1 d-inline-flex align-items-center font-small">
                                                {{ __('Show') }} <i class="fas fa-eye ml-2"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#modal-edit{{ $birth_control->slug }}" class="btn btn-sm btn-warning ml-1 d-inline-flex align-items-center font-small">
                                                {{ __('Edit') }} <i class="fas fa-edit ml-2"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger ml-1 d-inline-flex align-items-center font-small" id="btn_delete_birth_controls{{ $loop->iteration }}">
                                                {{ __('Remove') }} <i class="fas fa-solid fa-trash-alt ml-2"></i>
                                            </a>
                                            <form method="post" class="d-none">
                                                @method('delete')
                                                @csrf
                                                <button formaction="{{ route('birth-controls.destroy', $birth_control->slug) }}"class="d-none" id="form_delete_birth-controls{{ $loop->iteration }}">
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
    <div class="modal fade" id="modal-create-birth-controls">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><i class="fas fa-prescription-bottle-alt"></i> {{ __('New Type of Birth Control Form') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('birth-controls.store') }}" id="form_create_birth-controls">
                    @csrf
                    <div class="modal-body">
                        <div class="border-bottom text-danger" style="border-color: #007BFF !important">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1">
                            <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name" class="col-form-label">{{ __('Name of Birth Control Type') }} <span class="text-danger">*</span></label>
                                <small class="text-lg-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="text" id="name_birth" class="form-control error_input_name" placeholder="{{ __('Enter') }} {{ __('Name of Birth Control Type') }}" name="name" autofocus required>
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="slug" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="disabled" id="slug_birth" class="form-control error_input_slug" placeholder="{{ __('Automatically') }}" name="slug" disable readonly required>
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
    @foreach ($birth_controls as $birth_control_edit)
    <div class="modal fade" id="modal-edit{{ $birth_control_edit->slug }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">
                       <i class="fas fa-edit"></i> {{ __('Birth Control Type Edit Form') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('birth-controls.update', $birth_control_edit->slug) }}" id="form_edit_birth_controls{{ $loop->iteration }}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="border-bottom border-dark text-danger">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1 ">
                            <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name_edit_birth" class="col-form-label">{{ __('Name of Birth Control Type') }} <span class="text-danger">*</span></label>
                                <small class="text-lg-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="text" id="name_edit_birth{{ $loop->iteration }}" class="form-control error_input_name_edit_birth" placeholder="{{ __('Enter') }} {{ __('Name of Birth Control Type') }}" name="name" value="{{ $birth_control_edit->name }}" autofocus required>
                            <span class="text-danger error-text name_edit_birth_error"></span>
                        </div>
                        <div class="form-group mb-1 ">
                            <label for="slug_edit_birth" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="disabled" id="slug_edit_birth{{ $loop->iteration }}" class="form-control error_input_slug_edit_birth" placeholder="{{ __('Automatically') }}" name="slug" disable readonly value="{{ $birth_control_edit->slug }}" required>
                            <span class="text-danger error-text slug_edit_birth_error"></span>
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
    <script>
       
        $("#table-birth-controls").DataTable({
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
        var nameBirth = document.querySelector('#name_birth');
        var slugBirth = document.querySelector('#slug_birth');

        nameBirth.addEventListener('change', function () {
            fetch('birth-controls/slug?name=' + nameBirth.value)
                .then(response => response.json())
                .then(data => slugBirth.value = data.slug)
        });

        $('#form_create_birth-controls').on('submit', function (e) {
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
                        $('#form_create_birth-controls')[0].reset();
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

        const countBirth = document.querySelector('#countBirth');
        for (let i = 1; i <= countBirth.value; i++) {
            const nameEditBirthControls = document.querySelector('#name_edit_birth' + i);
            const slugEditBirthControls = document.querySelector('#slug_edit_birth' + i);
            nameEditBirthControls.addEventListener('change', function () {
                fetch('birth-controls/slug?name=' + nameEditBirthControls.value)
                    .then(response => response.json())
                    .then(data => slugEditBirthControls.value = data.slug)
            });

            $('#form_edit_birth_controls' + i).on('submit', function (e) {
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
                                $('span.' + prefix + '_edit_birth_error').text(val[0]);
                                $('input.error_input_' + prefix + '_edit_birth').addClass('is-invalid');
                                $('select.error_input_' + prefix+ '_edit_birth_error').addClass('is-invalid');
                            });
                            alertToastInfo(data.msg)
                        } else {
                            $('#form_edit_birth_controls' + i)[0].reset();
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

            $('#btn_delete_birth_controls' + i).on('click', function (e) {
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
                        $("#form_delete_birth-controls" + i).click();
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
                    $("#form_deleteAll_birth-controls").click();
                }
            });
        });
    </script>
    @endsection
</x-app-dashboard>