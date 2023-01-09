@extends('layouts.app')

@section('title', 'Roles')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" type="text/css">
@endpush


@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Roles</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        @can('role-create')
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_holiday"><i
                                    class="fa fa-plus"></i> Add role</a>
                        @endcan
                    </div>
                </div>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name </th>
                                    <th>Gruard Name</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr class="holiday-upcoming">
                                        <td>{{ $role->id }}</td>
                                        <td><a href="{{route('roles.edit', $role->id)}}">{{ $role->name }}</a></td>
                                        <td>{{ $role->guard_name }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @can('role-edit')
                                                            <a class="dropdown-item"
                                                                href="{{ route('roles.edit', $role->id) }}"><i
                                                                    class="fa fa-pencil m-r-5"></i>
                                                                Edit
                                                            </a>
                                                        @endcan
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('role-delete')
                                                            <button class="dropdown-item"
                                                                onclick="return confirm('Are you sure?')"><i
                                                                    class="fa fa-trash-o m-r-5"></i>
                                                                Delete
                                                            </button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ADD --}}
        <div class="modal custom-modal fade" id="add_holiday" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add role</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Role Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Guard Name <span class="text-danger">*</span></label>
                                <input disabled class="form-control" type="text" name="guard_name"
                                    value="web" >
                                @error('guard_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="div" style=" width: 100%; height: 200px;overflow: auto;">
                                @foreach ($permissions as $permission)
                                    <div class="form-check form-switch">
                                        <input value="{{ $permission->id }}" name="permission[]" class="form-check-input"
                                            type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label"
                                            for="flexSwitchCheckDefault">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/pages/datetimepicker.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/select2.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
@endpush
