<x-app-dashboard title="{{ __('Data Master') }}">

    <x-slot name="header">
        {{ __('User Positions Management') }}
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countPosition" class="w-100" value="{{ $positions->count() }}">
        </div>
    </div>

    <!-- Row Roles -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header align-items-center">
                    <h5 class="float-left mt-2 text-bold"><i class="fas fa-user-tie"></i> {{ __('List of Position Roles') }}</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary " data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="table-roles" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>{{ __('Name Role Position') }}</th>
                                <th class="text-center">{{ __('Registered amount') }}</th>
                                <th class="text-center">{{ __('Activation Status') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($roles->count() > 0)
                            @foreach ($roles as $role)
                            <tr>
                                <td class="text-center" style="width: 15px !important;">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="fw-500">
                                    @if($role->slug === 'patient')
                                    {{ __('Patient') }}
                                    @else
                                    {{ __('Staff') }} 
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($role->slug !== 'patient')
                                        {{ $staffs->count() }}
                                    @else
                                        {{ $patients->count() }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($role->slug === 'patient' && $role->status === 'actived')
                                    <i class="fas fa-check-circle text-success text-lg shadow rounded-circle"></i>
                                    @elseif($role->slug === 'patient' && $role->status === 'blocked')
                                    <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle"></i>
                                    @else
                                    <i class="fas fa-lock text-lg shadow rounded-circle"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light btn-sm border dropdown-toggle" data-toggle="dropdown" data-offset="-120">
                                         <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                          <a href="{{ $role->slug !== 'patient' ? route('staffs.index') : route('patients.index')   }}" class="dropdown-item">{{ __('Show') }}</a>
                                          {{-- <a href="{{ $role->slug !== 'patient' ?   }}" class="dropdown-item">{{ __('Show') }}</a> --}}
                                          @if($role->slug !== 'administrator')
                                          <div class="dropdown-divider"></div>
                                          <a href="#" class="dropdown-item">{{ __('Edit') }}</a>
                                          @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.roles -->

    <!-- Row Position -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header align-items-center">
                    <h5 class="float-left mt-2 text-bold"><i class="fas fa-user-nurse"></i> {{ __('Position Staff') }}</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-create-position">
                            {{ __('Create New Staff Position') }} <i class="fas fa-plus-circle"></i>
                        </button>
                        <button type="button" class="btn btn-primary " data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="table-positions" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>{{ __('Position Names') }}</th>
                                <th>{{ __('Position Code') }}</th>
                                <th class="text-center">{{ __('Number of Staff') }}</th>
                                <th class="text-center">{{ __('Activation Status') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($positions->count() > 0)
                            @foreach ($positions as $position)
                            <tr>
                                <td class="text-center" style="width: 15px !important;">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="fw-500">
                                    @if(Str::length($position->name) > 20)
                                    {{ substr( $position->name, 0, 20) }} ...
                                    @else
                                    {{ $position->name }}
                                    @endif
                                </td>
                                <td>
                                    #{{ $position->position_code }}
                                </td>
                                <td class="text-center">
                                    {{ $position->staff->count() }}
                                </td>
                                <td class="text-center">
                                    @if($position->status === 'actived' && $position->slug !== 'admin')
                                    <i class="fas fa-check-circle text-success text-lg shadow rounded-circle"></i>
                                    @elseif($position->status === 'blocked' && $position->slug !== 'admin')
                                    <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle"></i>
                                    @else
                                    <i class="fas fa-lock text-lg shadow rounded-circle"></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light btn-sm border dropdown-toggle" data-toggle="dropdown" data-offset="-120">
                                         <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="#" class="dropdown-item"><i class="fas fa-eye mr-2"></i> {{ __('Show') }}</a>
                                            @if($position->slug !== 'admin')
                                            <a data-toggle="modal" data-target="#modal-edit{{ $position->slug }}" class="dropdown-item" style="cursor: pointer">
                                                <i class="fas fa-edit mr-2"></i> {{ __('Edit') }} 
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" id="btn_delete_position{{ $loop->iteration }}" style="cursor: pointer">
                                                <i class="fas fa-solid fa-trash-alt mr-2"></i> {{ __('Remove') }}
                                            </a>
                                            <form method="post" class="d-none">
                                                @method('delete')
                                                @csrf
                                                <button formaction="{{ route('positions.destroy', $position->slug) }}" class="d-none" id="form_delete_position{{ $loop->iteration }}">
                                                    {{ __('Remove') }} <i class="fas fa-solid fa-trash-alt ml-2"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Position -->
  
    <!--- Modal Create -->
    <div class="modal fade" id="modal-create-position">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title"><i class="fas fa-pencil-alt"></i> {{ __('New Form of Staff Position') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('positions.store') }}" id="form_create_position">
                    @csrf
                    <div class="modal-body">
                        <div class="border-bottom text-danger" style="border-color: #007BFF !important">
                            {{ __('* required fileds') }}
                        </div>
                        <div class="form-group mb-1">
                            <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name" class="col-form-label">{{ __('Position Name') }} <span class="text-danger">*</span></label>
                                <small class="text-lg-right ">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                            </div>
                            <input type="text" id="name_position" class="form-control error_input_name" placeholder="{{ __('Enter') }} {{ __('Position Name') }}" name="name" required>
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="slug" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="disabled" id="slug_position" class="form-control error_input_slug" placeholder="{{ __('Automatically') }}" name="slug" disable readonly required>
                            <span class="text-danger error-text slug_error"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label for="status" class="col-form-label"> {{ __('Activation Status') }} <span class="text-danger">*</span></label>
                            <select required class="form-control select2 error_input_status" style="width: 100%;" name="status">
                                <option selected="selected" disabled>{{ __('Select Status') }}</option>
                                <option value="actived">{{ __('Active') }}</option>
                                <option value="blocked">{{ __('Not Active') }}</option>
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
    @foreach ($positions as $position_edit)
    <div class="modal fade" id="modal-edit{{ $position_edit->slug }}">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header bg-dark">
                     <h5 class="modal-title">
                        <i class="fas fa-edit"></i> {{ __('Staff Position Edit Form') }}
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <form class="form-horizontal" method="POST" action="{{ route('positions.update', $position_edit->slug) }}" id="form_edit_position{{ $loop->iteration }}">
                     @csrf
                     @method('PATCH')
                     <div class="modal-body">
                         <div class="border-bottom border-dark text-danger">
                             {{ __('* required fileds') }}
                         </div>
                         <div class="form-group mb-1 ">
                             <div class="col-form-label d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                                <label for="name" class="col-form-label">{{ __('Position Name') }} <span class="text-danger">*</span></label>
                                 <small class="text-lg-right">{{ __('Press') }} <kbd>Tab</kbd> {{ __('or switch columns to insert slug values automatically') }}</small>
                             </div>
                             <input type="text" id="name_edit_position{{ $loop->iteration }}" class="form-control error_input_name_edit_position" placeholder="{{ __('Enter') }} {{ __('Position Name') }}" name="name" value="{{ $position_edit->name }}" autofocus >
                             <span class="text-danger error-text name_edit_position_error"></span>
                         </div>
                         <div class="form-group mb-1 ">
                             <label for="slug_edit_position" class="col-form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
                             <input type="disabled" id="slug_edit_position{{ $loop->iteration }}" class="form-control error_input_slug_edit_position" placeholder="{{ __('Automatically') }}" name="slug" disable readonly value="{{ $position_edit->slug }}" required>
                             <span class="text-danger error-text slug_edit_position_error"></span>
                         </div>
                         <div class="form-group mb-1">
                             <label for="position_status_edit" class="col-form-label"> {{ __('Job Status') }} <span class="text-danger">*</span></label>
                             <select class="form-control error_input_position_status_edit_edit_position_error" style="width: 100%;" name="position_status_edit">
                                <option selected="selected">{{ __('Select Status') }}</option>
                                 @if($position_edit->status === 'actived')
                                 <option value="actived" selected="selected">{{ __('Active') }}</option> 
                                 <option value="blocked">{{ __('Not Active') }}</option> 
                                 @else
                                 <option value="actived">{{ __('Active') }}</option>
                                 <option value="blocked" selected="selected">{{ __('Not Active') }}</option>
                                 @endif
                             </select>
                             <span class="text-danger error-text position_status_edit_edit_position_error"></span>
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
        // CheckSlug
        const namePosition = document.querySelector('#name_position');
        const slugEducation = document.querySelector('#slug_position');

        namePosition.addEventListener('change', function () {
            fetch('admin/check-positions/slug?name=' + namePosition.value)
                .then(response => response.json())
                .then(data => slugEducation.value = data.slug)
        });

        $('#form_create_position').on('submit', function (e) {
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
                        $('#form_create_position')[0].reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                        alertToastSuccess(data.msg)
                    }
                },
                error: function (xhr) {
                    Swal.fire(xhr.statusText, '{{ __('The data has already been taken ') }}', 'info')
                }
            });
        });

        const countPosition = document.querySelector('#countPosition');
        for (let i = 1; i <= countPosition.value; i++) {
            const name_edit_position = document.querySelector('#name_edit_position' + i);
            const slug_edit_position = document.querySelector('#slug_edit_position' + i);
            name_edit_position.addEventListener('change', function () {
                fetch('admin/check-positions/slug?name=' + name_edit_position.value)
                    .then(response => response.json())
                    .then(data => slug_edit_position.value = data.slug)
            });

            $('#form_edit_position' + i).on('submit', function (e) {
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
                                $('span.' + prefix + '_edit_position_error').text(val[0]);
                                $('input.error_input_' + prefix + '_edit_position').addClass('is-invalid');
                                $('select.error_input_' + prefix+ '_edit_position_error').addClass('is-invalid');
                            });
                            alertToastInfo(data.msg)
                        } else {
                            $('#form_edit_position' + i)[0].reset();
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

            $('#btn_delete_position' + i).on('click', function (e) {
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
                        $("#form_delete_position" + i).click();
                    }
                });
            });
        }

       
    </script>
    @endsection
</x-app-dashboard>