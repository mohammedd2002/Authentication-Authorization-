@extends('back.master')
@section('title', ('Show role'))
@section('roles_active', 'active bg-light')


@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 style="margin: 10px 0px 0px 30px" class="h5 page-title">{{ 'Show role'}}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- MODIFICATIONS FROM HERE --}}
            <div class="row">

                <div class="form-group col-12">
                    <label class="form-label">{{ 'Name'}}</label>
                    <p class="border form-control">{{ $role->name ?? '--' }}</p>
                </div>

                <div class="form-group col-12">
                    <div class="row">
                        @if (count($permissions) > 0)
                            @foreach ($permissions as $permission)
                                <div class="col-md-6">
                                    <div class="form-check form-check-primary mt-1">
                                        <input class="form-check-input" type="checkbox" disabled
                                            @checked($role->hasPermissionTo($permission->name))>
                                        <div class="d-inline-block">
                                            <label class="form-check-label">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
            {{-- MODIFICATIONS TO HERE --}}

            <div class="form-group float-end">
                <a class="btn btn-light"  href="{{route("back.roles.index")}}">Close</a> 
            </div>

        </div>
    </div>

@endsection

