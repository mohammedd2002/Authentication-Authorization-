@extends('back.master')
@section('title', 'Roles')
@section('roles_active', 'active bg-light')
@section('content')
    <!-- page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 style="margin: 10px 0px 0px 30px"  class="h5 page-title">{{ 'Roles' }}</h2>

                <div class="page-title-right">
                    @if (permission('roles'))
                    <a style="margin: 10px 30px 0px 0px"  href="{{ route('back.roles.create') }}" class="btn btn-primary">
                        {{'Add new' }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card mt-3" id="mainCont">
        <div class="card-body">

            {{-- Table --}}
            <div class="table-responsive">
                @if (session('roleDeleteStatus'))
                <div class="alert alert-success">
                    {{ session('roleDeleteStatus') }}
                </div>
            @endif
                <table class="table align-middle table-nowrap font-size-14">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-primary" width="5%">#</th>
                            <th class="text-primary">{{ 'name' }}</th>
                            <th class="text-primary" width="11%">{{ 'actions' }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($roles) > 0)
                            @foreach ($roles as $index => $role)
                            
                                <tr>
                                    <td>{{$index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            

                                                <a href="{{ route('back.roles.show', ['role' => $role]) }}"
                                                    class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ 'Show' }}
                                                </a>

                                                @if (permission('roles'))
                                                <a href="{{ route('back.roles.edit', ['role' => $role]) }}"
                                                    class="dropdown-item">
                                                    <span class="bx bx-edit-alt"></span>
                                                    {{ 'Edit' }}
                                                </a>
                                                
                                                

                                           
                                               
                                            <form  action="{{ route('back.roles.destroy', ['role' => $role]) }}"
                                                method="POST" id="delete_form" class="d-inline" >
                                                @csrf
                                                @method('delete')
                                                <div style="display: inline" id="liveAlertPlaceholder"></div>
                                                <button class="btn  btn-danger mr-2"  type="submit">Delete</button>
                                            </form>
                                                @endif

                                            

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
