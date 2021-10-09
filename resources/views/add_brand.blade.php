@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Brand Name</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="{{route('brand.store')}}" method="POST" style="height: 100vh">
                @csrf
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success col-8" role="alert">
                                    {{session('success')}}
                                </div>
                            @endif

                            <h4 class="card-title">Add Brand</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Brand Name:</label>
                                        <input type="text" class="form-control" placeholder="Eg. Pomo" name="name" value="{{old('name')}}" required>
                                    </div>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
