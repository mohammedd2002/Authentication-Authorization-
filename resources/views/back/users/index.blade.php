@extends('back.master')
@section('title', 'Users')
@section('users_active', 'active bg-light')
@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 style="margin: 10px 0px 0px 30px" class="h5 page-title">{{ 'users' }}</h2>

                @if (permission('add_user'))
                    <div class="page-title-right">
                        <a style="margin: 10px 30px 0px 0px" href="{{ route('back.users.create') }}" class="btn btn-primary">
                            Add User
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card mt-3" id="mainCont">
        <div class="card-body">

            {{-- Table --}}
            <div class="table-responsive">
                @if (session('userDelete'))
                    <div class="alert alert-success">
                        {{ session('userDelete') }}
                    </div>
                @endif
                <table class="table align-middle table-nowrap font-size-14">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-primary" width="5%">#</th>
                            <th class="text-primary">{{ 'name' }}</th>
                            <th class="text-primary">{{ 'email' }}</th>
                            <th class="text-primary" width="11%">{{ 'Actions' }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email ?? '' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">


                                                <a href="{{ route('back.users.show', ['user' => $user]) }}"
                                                    class="dropdown-item">
                                                    <span class="bx bx-show-alt"></span>
                                                    show
                                                </a>


                                                @if (permission('edit_user'))
                                                    <a href="{{ route('back.users.edit', ['user' => $user]) }}"
                                                        class="dropdown-item">
                                                        <span class="bx bx-edit-alt"></span>
                                                        edit
                                                    </a>
                                                @endif

                                                @if (permission('delete_user'))
                                                    <form action="{{ route('back.users.destroy', ['user' => $user]) }}"
                                                        method="POST" id="delete_form" class="dropdown-item deleteClass">
                                                        @csrf
                                                        @method('delete')
                                                        <div style="display: inline" id="liveAlertPlaceholder"></div>
                                                        <button class="btn btn-sm btn-danger mr-2"
                                                            type="submit">Delete</button>
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
