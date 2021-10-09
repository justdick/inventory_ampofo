@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="tab-pane" id="drugsinfo">
        <div class="row">
            <div class="col-md-8">
                @if(session('updated'))
                    <div class="alert alert-success col-8" role="alert">
                        {{session('updated')}}
                    </div>
                @endif

                <div class="card-box">
                    <h3 class="card-title">All Brand </h3>

                    <div class="table-responsive">
                        <table class="table table-stripped brandstable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $c=1;?>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td id="{{$brand['id']}}">{{$c++}}</td>
                                        <td>{{$brand['name']}}</td>
                                        <td>
                                            @if (Auth::user()->role == 'admin')
                                                <a href="{{route('brand.edit', $brand['id'])}}">
                                                    <button class="btn btn-info">Edit</button>
                                                </a>
                                            @endif

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

    <script>
        $(document).ready(function() {
            table = $('.brandstable').DataTable();
        });
    </script>
</div>
@endsection
