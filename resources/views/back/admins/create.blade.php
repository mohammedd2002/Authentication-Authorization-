    

@extends('back.master')
@section('title', __('Create admin'))
@section('admins_active', 'active bg-light')


@section('content')
{{-- title --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h2 style="margin: 10px 0px 0px 30px" class="h5 page-title">{{ 'Add new admin'}}</h2>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('back.admins.store') }}" method="post" id="add_form" enctype="multipart/form-data">
            @csrf
        
            <div id="add_form_messages"></div>
            @if (session('adminCreate'))
            <div class="alert alert-success">
                {{ session('adminCreate') }}
            </div>
        @endif
        
            {{-- MODIFICATIONS FROM HERE --}}
            <div class="row">
              
                <div class="form-group col-md-6">
                    <label class="form-label">{{ 'name'}}</label>
                    <input type="text" class="border form-control" name="name"
                        placeholder="{{ ('please enter') }} {{'name'}}...">
                </div>
        
                <div class="form-group col-md-6">
                    <label class="form-label">{{ 'email'}}</label>
                    <input type="email" class="border form-control" name="email"
                        placeholder="{{ 'please enter' }} {{'email' }}...">
                </div>
        
                <div class="form-group col-md-12">
                    <label class="form-label">{{ 'role' }}</label>
                    <select class="border form-control" name="role">
                        <option value="">{{'select role'}}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="form-group col-6">
                    <label class="form-label">{{('password') }}</label>
                    <input type="password" class="border form-control" name="password"
                        placeholder="{{ 'please enter' }} {{'password'}}...">
                </div>
        
                <div class="form-group col-6">
                    <label class="form-label">{{ 'password confirmation'}}</label>
                    <input type="password" class="border form-control" name="password_confirmation"
                        placeholder="{{'please enter' }} {{'password confirmation' }}...">
                </div>
            </div>
            {{-- MODIFICATIONS TO HERE --}}
        
            <hr class="text-muted">
        
            <div class="form-group float-end">
                <a  class="btn btn-light" href="{{route('back.admins.index')}}">Close</a>
                <button type="submit" class="btn btn-primary" id="submit_add_form">{{ 'submit'}}</button>
            </div>
        </form> 
    </div>
</div>


@endsection
 
{{-- @includeIf("$directory.scripts")
@includeIf("$directory.pushScripts") --}}
