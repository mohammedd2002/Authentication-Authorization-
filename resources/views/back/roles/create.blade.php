@extends('back.master')
@section('title', ('Add new role'))
@section('roles_active', 'active bg-light')



@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 style="margin: 10px 0px 0px 30px" class="h5 page-title">{{ 'Add new role'}}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('back.roles.store') }}" method="post" id="add_form" enctype="multipart/form-data">
                @csrf

                <div id="add_form_messages"></div>

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">

                   
                    @if (session('roleCreate'))
                    <div class="alert alert-success">
                        {{ session('roleCreate') }}
                    </div>
                    @endif
                    

                    <div class="form-group col-md-10">
                        <label class="form-label">{{ 'name' }}</label>
                        <input type="text" class="border form-control" name="name"
                            placeholder="{{ ('please enter') }} {{ ('name') }}...">
                    </div>
                   
                    <div class="form-group col-12 mt-2">
                        <div class="row">
                            @if (count($permissions) > 0)
                                @foreach ($permissions as $permission)
                                    <div class="col-md-6">
                                        <div class="form-check form-check-primary mt-1">
                                            <input class="form-check-input" type="checkbox"
                                                name="permissionArray[{{ $permission->name }}]"
                                                id="formCheckcolor{{ $permission->id }}">
                                            <label class="form-check-label"
                                                for="formCheckcolor{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
                {{-- MODIFICATIONS TO HERE --}}

                <div class="form-group float-end mt-3">
                    <button type="submit" class="btn btn-primary" id="submit_add_form">{{ 'Submit'}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

