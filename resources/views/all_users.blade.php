@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="tab-pane" id="drugsinfo">
        <div class="row">
            <div class="col-md-12">
                @if(session('updated'))
                    <div class="alert alert-success col-8" role="alert">
                        {{session('updated')}}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success col-8" role="alert">
                        {{session('success')}}
                    </div>
                @endif

                <div class="card-box">
                    <h3 class="card-title">All Users </h3>

                    <div class="table-responsive">
                        <table class="table table-stripped productstable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $c=1;?>
                                @foreach ($users as $user)
                                    <tr>
                                        <td id="{{$user['id']}}">{{$c++}}</td>
                                        <td>{{$user['name']}}</td>
                                        <td>{{$user['username']}}</td>
                                        <td>{{$user['role']}}</td>
                                        <td>
                                            <a href="{{route('user.edit', $user['id'])}}">
                                                <button type="submit" class="btn add btn-primary">Edit</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
