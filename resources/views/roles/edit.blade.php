@extends('layouts.app')

@section('title', 'Edit-Role')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" type="text/css">
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Roles</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Role</li>
                        </ul>
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

            <div class="card mb-0">
                <div class="card-body">
                    <form action="{{ route('roles.update',$role->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') ?? $role->name }}" required>
                            @error('name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Guard Name <span class="text-danger">*</span></label>
                            <input disabled class="form-control" type="text" name="guard_name" value="{{ old('guard_name') ?? $role->guard_name }}">
                            @error('guard_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="div" style=" width: 100%; height: 200px;overflow: auto;">
                            @foreach ($permissions as $permission)
                                <div class="form-check form-switch">
                                    <input 
                                        @foreach ($rolePermissions as $rolePermission)
                                            @if ($rolePermission === $permission->id)
                                                checked
                                            @endif
                                        @endforeach
                                        value="{{$permission->id}}" name="permission[]" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label">
                                        {{$permission->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Save</button>
                        </div>
                    </form>
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
