@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card" style="margin-top:10px;">
                    <div class="card-header">{{ __('List') }}</div>

                    <div class="card-body">
                        <div class="bootstrap-table">
                        <table class="table table-bordered" id="user_table" data-plugin='dataTable'>
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Interest</th>
                                <th scope="col">Roles</th>
                            </tr>
                            </thead>
                            <tbody>
                        
                            @if($users->count())
    
                            @foreach($users as $count => $user)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    
                                    <td>
                                        @if($user->userInterests)
                                            @foreach($user->userInterests as $i => $interest)
                                                <span>{{ $interest->interest}}{{ ($user->userInterests->count() - 1 == $i) ? '' : ',' }}</span>
                                               
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->roles)
                                            @foreach($user->roles as $i => $role)
                                                <span>{{ $role->name}}{{ ($user->roles->count() - 1 == $i) ? '' : ',' }}</span>
                                               
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                               Users not found!
                            @endif
    
                            </tbody>
                        </table>
                        @if($users->count())
                            {{$users->links()}}
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection