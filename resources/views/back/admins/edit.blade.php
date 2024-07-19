


@extends('back.master')
@section('title', 'Edit admin')
@section('admins_active', 'active bg-light')
@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2  style="margin: 10px 0px 0px 30px" class="h5 page-title">{{'edit role'}}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if (session('adminUpdate'))
            <div class="alert alert-success">
                {{ session('adminUpdate') }}
            </div>
        @endif
            <form action="{{ route('back.admins.update', ['admin' => $admin]) }}" method="post" id="edit_form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <div id="edit_form_messages"></div>
            
                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label">{{'name'}}</label>
                        <input type="text" class="border form-control" name="name"
                            placeholder="{{'please enter'}} {{'name'}}..." value="{{ $admin->name }}">
                    </div>
            
                    <div class="form-group col-md-6">
                        <label class="form-label">{{'email'}}</label>
                        <input type="email" class="border form-control" name="email"
                            placeholder="{{'please enter'}} {{'email'}}..." value="{{ $admin->email }}">
                    </div>
            
                    <div class="form-group col-md-12">
                        <label class="form-label">{{'role'}}</label>
                        <select class="border form-control" name="role">
                            <option value="">{{'select role'}}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @selected($admin->hasRole($role->name))>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group col-6">
                        <label class="form-label">{{'password'}}</label>
                        <input type="password" class="border form-control" name="password"
                            placeholder="{{'please enter'}} {{'password'}}...">
                    </div>
            
                    <div class="form-group col-6">
                        <label class="form-label">{{'password confirmation'}}</label>
                        <input type="password" class="border form-control" name="password_confirmation"
                            placeholder="{{'please enter'}} {{'password confirmation'}}...">
                    </div>
                </div>
                {{-- MODIFICATIONS TO HERE --}}
            
                <hr class="text-muted">
            
                <div class="form-group float-end">
                    <a class="btn btn-light" href="{{route('back.admins.index')}}">Close</a>
                    
                    <button type="submit" class="btn btn-primary" id="submit_edit_form">{{'submit'}}</button>
                </div>
                
            </form>

        </div>
    </div>

@endsection


