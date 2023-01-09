@extends('layouts.app')

@section('title', 'Profile-User')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" type="text/css">
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Profile</li>
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

            {{-- Profile --}}
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        @if ($user->thumbnail_url != null)
                                            <img src="{{ asset('images/' . $user->thumbnail_url) }}" alt="">
                                        @else
                                            <img src="{{ asset('images/avtdefault.jfif') }}" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $user->first_name }}
                                                    {{ $user->last_name }}</h3>
                                                <h5 class="text-muted" style="margin-top: 10px">
                                                    {{-- @foreach ($user->groups as $group)
                                                        {{ $group->name }}
                                                    @endforeach --}}
                                                </h5>
                                                <small class="text-muted">
                                                    {{-- @foreach ($user->positions as $position)
                                                        <h4>{{ $position->name }}</h4>
                                                    @endforeach --}}
                                                </small>
                                                <div class="staff-id">ID : FT-000{{ $user->id }}</div>
                                                <div style="margin-top: 10px" class="small doj text-muted">Date of Join :
                                                    {{ $user->date_of_join }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text">
                                                        {{ $user->phone ?? '---' }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">
                                                        {{ $user->email }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text">
                                                        {{ $user->birth_date ?? '---' }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text">
                                                        {{ $user->address ?? '---' }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="title">Gender:</div>
                                                    <div class="text">
                                                        {{ $user->gender ?? '---' }}
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a class="edit-icon" href="{{ route('users.edit', $user->id) }}"><i
                                            class="fa fa-pencil"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab"
                                    class="nav-link active">Projects</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- <div class="tab-content">
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        @foreach ($user->works as $work)
                            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="project-title"><a
                                                href="{{ route('work.show', $work->id) }}">{{ $work->name }}</a></h4>
                                        <small class="block text-ellipsis m-b-15">
                                            <span class="text-xs">{{ $work->title }}</span>

                                        </small>
                                        <p class="text-muted"
                                            style="overflow: hidden;
                                                            text-overflow: ellipsis;
                                                            line-height: 20px;
                                                            height: 100px;
                                                            display: -webkit-box;
                                                            -webkit-box-orient: vertical">
                                            {{ $work->description }}
                                        </p>
                                        <div class="project-members m-b-15">
                                            <div class="sub-title">
                                                Team:
                                            </div>
                                            <ul class="team-members">
                                                @foreach ($work->users as $user)
                                                    <li>
                                                        <a href="{{ route('employees.show', $user->id) }}"
                                                            data-bs-toggle="tooltip" title="{{ $user->first_name }}">
                                                            <img alt=""
                                                                src="{{ asset('images/' . $user->thumbnail_url) }}">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="pro-deadline m-b-15">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="sub-title">
                                                        Start:
                                                    </div>
                                                    <div class="text-muted">
                                                        {{ date('d M Y', strtotime($work->from_date)) }}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="sub-title">
                                                        Deadline:
                                                    </div>
                                                    <div class="text-muted">
                                                        {{ date('d M Y', strtotime($work->to_date)) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div> --}}

        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/pages/datetimepicker.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/select2.init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
@endpush
