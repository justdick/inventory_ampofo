@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Product</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="{{route('brand.update', $brand['id'])}}" method="POST" style="height: 100vh">
                @csrf
                @method('PATCH')
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Edit Brand Name</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Brand Name:</label>
                                            <input type="text" class="form-control" name="name" value="{{$brand['name']}}">
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
