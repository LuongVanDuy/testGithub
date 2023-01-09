@extends('layouts.app')

@section('title', 'Users')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" type="text/css">
    
@endpush


@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Users</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Users</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_user"><i
                                class="fa fa-plus"></i> Add User</a>
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
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Created Date</th>
                                    <th>Role</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{route('users.show', $user->id)}}" class="avatar">
                                                    @if ($user->thumbnail_url != null)
                                                        <img src="{{ asset('assets/img/profiles/' . $user->thumbnail_url) }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('assets/img/profiles/avtdefault.jfif') }}"
                                                            alt="">
                                                    @endif
                                                </a>
                                                <a href="{{route('users.show',$user->id)}}">{{ $user->first_name }}
                                                    {{ $user->last_name }}<span></span></a>
                                            </h2>
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>URSA Technologies</td>
                                        <td>{{ date('d M Y', strtotime($user->created_at)) }}</td>
                                        <td>
                                            @foreach ($user->roles as $userRole)
                                                @if ($userRole->name == "Admin")
                                                    <span class="badge bg-inverse-danger">{{ $userRole->name }}</span>
                                                @elseif ($userRole->name == 'Employee')
                                                    <span class="badge bg-inverse-info">{{ $userRole->name }}</span>
                                                 @else
                                                    <span class="badge bg-inverse-success">{{ $userRole->name }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-end">
                                            <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{route('users.edit', $user->id)}}"><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i
                                                                class="fa fa-trash-o m-r-5"></i> Delete
                                                        </button>
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
            {{ $users->links() }}
            
        </div>

        <div id="add_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="role_id" value="3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="user_name" class="form-label">Username</label>
                                        <input name="user_name" type="text"
                                            class="form-control @error('user_name')is-invalid @enderror"value="{{ old('user_name') }}">
                                        @error('user_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="email"
                                            class="form-control @error('email')is-invalid @enderror"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group"><span class="text-danger">*</span>
                                        <label for="password" class="form-label">Password</label>
                                        <input name="password" type="password"
                                            class="form-control @error('password')is-invalid @enderror"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group"><span class="text-danger">*</span>
                                        <label for="confirm-password" class="form-label">Confirm Password</label>
                                        <input name="confirm-password" type="password"
                                            class="form-control @error('confirm-password')is-invalid @enderror"
                                            value="{{ old('confirm-password') }}">
                                        @error('confirm-password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">First Name</label>
                                        <input class="form-control" type="text" name="first_name"
                                            value="{{ old('first_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Last Name</label>
                                        <input class="form-control" type="text" name="last_name"
                                            value="{{ old('last_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone </label>
                                        <input class="form-control" type="text" name="phone"
                                            value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Joining Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="date" name="date_of_join"
                                                value="{{ old('date_of_join') }} ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        Role
                                        @foreach ($roles as $role)
                                            <div class="form-check form-switch">
                                                <input value="{{ $role->id }}" name="roles[]" class="form-check-input"
                                                    type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefault">{{ $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" value="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script type="text/javascript">    
        $(document).ready(function() {
            $('#multiple-checkboxes').multiselect({
            includeSelectAllOption: true,
            });
    });</script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datetimepicker.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/select2.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
@endpush
