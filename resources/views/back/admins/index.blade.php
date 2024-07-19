@extends('back.master')
@section('title', __('Admins'))
@section('admins_active', 'active bg-light')

@section('content')
    <!-- page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 style="margin: 10px 0px 0px 30px"  class="h5 page-title">{{'Admins'}}</h2>

                <div class="page-title-right">
                    @if (permission('admins'))
                    <a style="margin: 10px 30px 0px 0px"  href="{{ route('back.admins.create') }}" 
                        class="btn btn-primary" >
                        Add New Admin
                    </a>
                    <br>
                 
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
                @if (session('adminDelete'))
                <div class="alert alert-success">
                    {{ session('adminDelete') }}
                </div>
            @endif

                <table class="table align-middle table-nowrap font-size-14">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-primary" width="5%">#</th>
                            <th class="text-primary">{{ 'name'}}</th>
                            <th class="text-primary">{{'email'}}</th>
                            <th class="text-primary">{{'role'}}</th>
                            <th class="text-primary" width="11%">{{'actions'}}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($admins) > 0)
                            @foreach ($admins as $index => $admin)
                                <tr>
                                    <td>{{ $index + 1}}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @if (count($admin->getRoleNames()) > 0)
                                            <span class="badge bg-warning text-white p-2">
                                                {{ $admin->getRoleNames()[0] ?? '' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ 'Actions'}} <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a href="{{ route('back.admins.show', ['admin' => $admin]) }}"
                                                    class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    {{ 'show' }}
                                                </a>

                                                @if (permission('admins'))
                                                <a href="{{ route('back.admins.edit', ['admin' => $admin]) }}"
                                                    class="dropdown-item">
                                                    <span class="bx bx-edit-alt"></span>
                                                    {{ 'edit' }}
                                                </a>
                                           

                                              


                                                <form action="{{ route('back.admins.destroy', ['admin' => $admin]) }}"
                                                    method="POST" id="delete_form" class="dropdown-item deleteClass">
                                                    @csrf
                                                    @method('delete')
                                                    <div style="display: inline" id="liveAlertPlaceholder"></div>
                                                    <button class="btn btn-sm btn-danger mr-2" type="submit">Delete</button>
                                                </form>
                                                @endif

                                            </div>
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

