@extends('layouts.starter')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Phone Repair</h4>
        </div>
    </div>

    <div class="row">
        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <div class="col-md-10">
            <form action="{{route('repair.store')}}" method="POST" style="height: 100vh">
                @csrf
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success col-8" role="alert">
                                    {{session('success')}}
                                </div>

                                <script>
                                    //open receipt page
                                    setTimeout(function(){
                                        window.open('http://localhost:8000/repairs_receipt', '_blank');
                                    }, 1000);

                                </script>
                            @endif
                            @if(session()->has('warning'))
                                <div class="alert alert-warning col-8" role="alert">
                                    {{session('warning')}}
                                </div>
                            @endif
                            <h4 class="card-title">Receipt details</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Customer Name:</label>
                                            <input type="text" class="form-control" value="{{old('cust_name')}}" name="cust_name" required>
                                        </div>

                                        @if ($errors->has('cust_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cust_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer Phone:</label>
                                        <input type="text" class="form-control" name="cust_phone" value="{{old('cust_phone')}}" required>
                                    </div>

                                    @if ($errors->has('cust_phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cust_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

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
                                        <input type="text" class="form-control" placeholder="Eg. Nokia 3310" name="model_name" value="{{old('model_name')}}" required>
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
                                        <label>Charge Amount:</label>
                                        <input type="number" step="0.5" placeholder="1 = 1 GHS | 0.5 = 50p" class="form-control" name="amount" value="{{old('amount')}}" required>
                                    </div>

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fault</label>
                                        <input type="text" step="0.5" class="form-control" name="fault" value="{{old('fault')}}" required>
                                    </div>

                                    @if ($errors->has('fault'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fault') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" step="0.5" placeholder="1 = 1 GHS | 0.5 = 50p" class="form-control" name="remarks" value="{{old('remarks')}}" required>
                                    </div>

                                    @if ($errors->has('remarks'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('remarks') }}</strong>
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
