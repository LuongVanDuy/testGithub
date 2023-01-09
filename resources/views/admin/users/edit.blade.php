@extends('layouts.app')

@section('title', 'Edit-User')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" type="text/css">
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">User</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Edit User</li>
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
                    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multiform/form-data">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap edit-img">
                                    @if ($user->thumbnail_url != null)
                                        <img class="inline-block"
                                            src="{{ asset('assets/img/profiles/' . $user->thumbnail_url) }}" alt="">
                                    @else
                                        <img class="inline-block" src="{{ asset('assets/img/profiles/avtdefault.jfif') }}"
                                            alt="">
                                    @endif
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" type="file" name="thumbnail_url" accept="image/*"
                                            value="{{ old('thumbnail_url') ?? $user->thumbnail_url }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_name" class="form-label">Username</label>
                                            <input name="user_name" type="text"
                                                class="form-control @error('user_name')is-invalid @enderror" id="user_name"
                                                value="{{ old('user_name') ?? $user->user_name }}">
                                            @error('user_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Username</label>
                                            <input name="email" type="email"
                                                class="form-control @error('email')is-invalid @enderror" id="email"
                                                value="{{ old('email') ?? $user->email }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ old('first_name') ?? $user->first_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ old('last_name') ?? $user->last_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" type="date" name="birth_date"
                                                    value="{{ old('birth_date') ?? $user->birth_date }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="select form-select" name="gender">
                                                <option {{ $user->gender == 'Male' ? 'selected' : '' }} value="Male">Male
                                                </option>
                                                <option {{ $user->gender == 'Female' ? 'selected' : '' }} value="Female">
                                                    Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ old('address') ?? $user->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state"
                                                value="{{ old('state') ?? $user->state }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone') ?? $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style=" height: 200px;overflow: auto;">
                                        <label for="">Roles</label>
                                        @foreach ($roles as $role)
                                            <div class="form-check form-switch">
                                                <input 
                                                @foreach ($userRoles as $userRole)
                                                    @if ($userRole === $role->name)
                                                        checked
                                                    @endif
                                                @endforeach
                                                    value="{{$role->id}}" name="roles[]" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label">
                                                    {{$role->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
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
