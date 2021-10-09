@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Product</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <form action="{{route('product.store')}}" method="POST" style="height: 100vh">
                @csrf
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success col-8" role="alert">
                                    {{session('success')}}
                                </div>
                            @endif
                            @if(session()->has('warning'))
                                <div class="alert alert-warning col-8" role="alert">
                                    {{session('warning')}}
                                </div>
                            @endif
                            <h4 class="card-title">Product details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Brand Name:</label>
                                            <select class="form-control" name="brand_name" required>
                                                <option value=""></option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{$brand->name}}"> {{$brand->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if ($errors->has('brand_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('brand_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Model Name:</label>
                                        <input type="text" class="form-control" placeholder="Eg. POMO 210 KG" name="model_name" value="{{old('model_name')}}" required>
                                    </div>

                                    @if ($errors->has('model_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('model_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>WholeSale Price:</label>
                                        <input type="number" step="0.5" placeholder="1 = 1 GHS | 0.5 = 50p" class="form-control" name="wholesale_price" value="{{old('wholesale_price')}}" required>
                                    </div>

                                    @if ($errors->has('wholesale_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wholesale_price') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sellout Price:</label>
                                        <input type="number" step="0.1" placeholder="1 = 1 GHS | 0.5 = 50p" class="form-control" name="min_price" value="{{old('min_price')}}" required>
                                    </div>

                                    @if ($errors->has('min_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('min_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Whole Sale Price:</label>
                                        <input type="number" step="0.5" placeholder="1 = 1 GHS | 0.5 = 50p" class="form-control" name="wholesale_price" value="{{old('wholesale_price')}}" required>
                                    </div>

                                    @if ($errors->has('wholesale_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('wholesale_price') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}


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
