<x-app-dashboard title="{{ __('Staff List') }}">

    <x-slot name="header">
        {{ __('Staff List') }}
    </x-slot>

    <div class="row d-none">
        <div class="col-12">
            <input type="text" id="countwork" class="w-100" value="{{ $staffs->count() }}">
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
                        <button formaction="" class="d-none" type="submit" id="form_deleteAll_work">
                            {{ __('Delete All Selected') }}
                        </button>
                        <a href="{{ route('staffs.create') }}" class="btn btn-primary float-right">
                            {{ __('Add New Staff') }}  <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="table-staff" class="table table-bordered table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="selectall" style="max-width: 15px !important; cursor: pointer;"></th>
                                    <th>{{ __('Employee ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Position') }}</th>
                                    <th class="text-center">{{ __("Account activation") }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($staffs->count() > 0)
                                @foreach ($staffs as $staff)
                                <tr>
                                    <td class="text-center" style="width: 15px !important;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $staff->id }}" style="cursor: pointer;"></td>
                                    <td>{{ $staff->employe_id }}</td>
                                    <td class="fw-500">
                                        {{ $staff->name }}
                                    </td>
                                    <td>
                                       {{ $staff->position->name }}
                                    </td>
                                    <td class="text-center d-flex align-items-center justify-content-center">
                                        @if($staff->account)
                                        @if($staff->account->status == 'actived')
                                        <i class="fas fa-check-circle text-success text-lg shadow rounded-circle mr-2"></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger text-lg shadow rounded-circle mr-2"></i>
                                        @endif
                                        <small class="d-flex flex-column">
                                            <span>{{ __('Created date') }}</span>
                                            <span>{{ $staff->account->created_at }}</span>
                                        </small>
                                        @else
                                        -
                                        @endif
                                    </td>
                                   
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light btn-sm border dropdown-toggle" data-toggle="dropdown" data-offset="-120">
                                             <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                              <a href="#" class="dropdown-item">{{ __('Show') }}</a>
                                              <a href="#" class="dropdown-item">{{ __('Edit') }}</a>
                                              <div class="dropdown-divider"></div>
                                              <a href="#" class="dropdown-item">{{ __('Remove') }}</a>
                                            </div>
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

    @section('scripts')
    <script>
       //    -------- Data Table
       $("#table-staff").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            "lengthMenu": [
                [-1, 5, 10, 25, 50, 100],
                ["{{ __('All') }}", 5, 10, 25, 50, 100]
            ],
            "order": [],
            "columnDefs": [{
                "targets": [0, 5],
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
                "sInfoFiltered": "{{ __('DataTabelInfoFiltered') }}"
            },
            "buttons": [{
                    "extend": 'copy',
                    "title": "{{ __('List of Users') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3]
                    }
                },
                {
                    "extend": 'excel',
                    "title": "{{ __('List of Users') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3]
                    }
                },
                {
                    "extend": 'print',
                    "title": "{{ __('List of Users') }}",
                    "exportOptions": {
                        "columns": [1, 2, 3]
                    }
                },
                "colvis"
            ]
        }).buttons().container().appendTo('#table-staff_wrapper .col-md-6:eq(0)');

        // $('#btn_delete_all').on('click',function(e){
        //     e.preventDefault();
        //     swal.fire({
        //         title: "{{ __('Are you sure?') }}",
        //         text: "{{ __('You wont be able to revert this') }}",
        //         icon: 'warning',
        //         iconColor: '#FD7E14',
        //         showCancelButton: true,
        //         confirmButtonColor: '#007BFF',
        //         cancelButtonColor: '#DC3545',
        //         confirmButtonText: "{{ __('Yes, deleted it') }}",
        //         cancelButtonText: "{{ __('Cancel') }}"
        //     }).then((result) => {
        //         if (result.isConfirmed){
        //             $("#form_deleteAll_work").click();
        //         }
        //     });
        // });
    </script>
    @endsection
</x-app-dashboard>