@extends('layouts.main',['title'=>'','active'=>''])

@section('content')

    <div class="row justify-content-end">
        <div class="form-group ">
            <form>
                <label class="form-label">Search</label>
                <div class="row gutters-xs">
                    <div class="col">
                        <input type="text" name="search" class="form-control"  value="{{ old('search' , request('search')) }}" placeholder="Search for...">
                    </div>
                    <span class="col-auto">
                    <button class="btn btn-outline-success" type="submit"><i class="fe fe-search"></i></button>
                </span>
                </div>
            </form>

        </div>
    </div>
        <div class="card">

                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter -nowrap card-table">
                        <thead>
                        <tr>
                            <th class="">ID</th>
                            <th class="">Personal Info</th>
                            <th class="">Work Info</th>
                            <th class="">Contact Info</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-primary">#{{ $user->id }}</td>
                                <td>
                                    <div>Name : {{ $user->name }}</div>
                                    <div>Last Name : {{ $user->last_name }}</div>
                                    <div>Gender : {{ $user->gender }}</div>
                                </td>
                                <td>
                                    <div>Job Title : {{ $user->job_title }}</div>
                                    <div>Employee Name : {{ $user->emp_num }}</div>
                                </td>
                                <td>
                                    <div>Phone : {{ $user->mobile_number }}</div>
                                    <div>Office : {{ $user->office_number }}</div>
                                    <div>Email : {{ $user->email }}</div>
                                </td>
                                <td class="text-center">
                                    @can('view' , $user)
                                        <div><a href="/users/{{ $user->id }}/view">Edit</a></div>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <div class="col-3 text-center">
                        {!! $users->appends(request()->except('page'))->render() !!}
                    </div>
                </div>

        </div>
    </div>

@endsection
