@extends('back.master')
@section('title','Show user')
@section('users_active', 'active bg-light')

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 style="margin: 10px 0px 0px 30px"  class="h5 page-title">{{'Show user'}}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- MODIFICATIONS FROM HERE --}}
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label class="form-label">{{'name'}}</label>
                    <p class="border form-control">{{ $user->name ?? '--' }}</p>
                </div>

                <div class="form-group col-12 col-md-6">
                    <label class="form-label">{{ 'email'}}</label>
                    <p class="border form-control">{{ $user->email ?? '--' }}</p>
                </div>
            </div>
            {{-- MODIFICATIONS TO HERE --}}


            <div class="form-group float-end">
                <a class="btn btn-light"  href="{{route("back.users.index")}}">Close</a> 
            </div>

        </div>
    </div>

@endsection
