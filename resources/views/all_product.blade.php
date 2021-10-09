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

                <div class="card-box">
                    <h3 class="card-title">All Products </h3>

                    <div class="table-responsive">
                        <table class="table table-stripped productstable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand Name</th>
                                    <th>Model Name</th>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'adminassitant')
                                    <th>WholeSale</th>
                                    @endif
                                    <th>Min Price</th>
                                    <th>Quantity (In Stock)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $c=1;?>
                                @foreach ($products as $product)
                                    <tr>
                                        <td id="{{$product['id']}}">{{$c++}}</td>
                                        <td>{{$product['brand_name']}}</td>
                                        <td>{{$product['model_name']}}</td>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'adminassitant')
                                        <td>{{$product['wholesale_price']}} GHS</td>
                                        @endif
                                        <td>{{$product['min_price']}} GHS</td>
                                        <td id="{{$product['id']}}q">{{$product['quantity_available']}} Pieces</td>
                                        <td>
                                            @if ($product['quantity_available'] != 0)
                                                <button type="submit" class="btn add btn-primary">Add to Cart</button>
                                            @endif

                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'adminassistant')
                                                <a href="{{route('product.edit', $product['id'])}}">
                                                    <button class="btn btn-info">Edit</button>
                                                </a>

                                                <a href="{{route('stock.create', $product['id'])}}">
                                                    <button class="btn btn-danger">Add Stocks</button>
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

    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'adminassitant')
        <script>
            $(document).ready(function() {
                table = $('.productstable').DataTable();

                cartrowid = 0;

                $('.table tbody').on( 'click', 'button', function () {
                    $(this).prop('disabled', true);
                    var data = table.row( $(this).parents('tr') ).data();
                    data[4] = parseFloat(data[4]);

                    var product_id = $(this).closest('tr').find("td:eq(0)").attr('id');
                    var delete_id = data[0];

                    $('.app').append('<div class="form-group"><div class="row"><input type="text" class="form-control col-md-2 mr-1" name="cart['+cartrowid+']['+'brand_name'+']" value="'+data[1]+'" readonly><input type="text" class="form-control col-md-2 mr-1" name="cart['+cartrowid+']['+'model_name'+']" value="'+data[2]+'" readonly><input type="text" class="form-control col-md-2 mr-1 min_price" name="cart['+cartrowid+']['+'min_price'+']" value="'+data[4]+'" readonly><input type="number" min="1"  class="form-control col-md-2 mr-1 price_sold" name="cart['+cartrowid+']['+'price_sold'+']" value="'+data[4]+'" readonly><input type="number" min="1"  class="form-control col-md-2 mr-1 quantity" name="cart['+cartrowid+']['+'quantity'+']" ><input type="hidden" class="form-control col-md-2 mr-1 available" value="'+data[5]+'" readonly><input type="hidden" class="form-control col-md-2 mr-1 product_id" name="cart['+cartrowid+']['+'product_id'+']" value="'+product_id+'"><a href="javascript:void(0)" style="color:red" class="delete" id="_'+delete_id+'"><i class="fa fa-trash"></i>  Delete </a></div></div>'
                    );


                    cartrowid++;

                } );

            } );
        </script>

    @else
        <script>
            $(document).ready(function() {
                table = $('.productstable').DataTable();

                cartrowid = 0;

                $('.table tbody').on( 'click', 'button', function () {
                    $(this).prop('disabled', true);
                    var data = table.row( $(this).parents('tr') ).data();
                    data[3] = parseFloat(data[3]);

                    var product_id = $(this).closest('tr').find("td:eq(0)").attr('id');
                    var delete_id = data[0];

                    $('.app').append('<div class="form-group"><div class="row"><input type="text" class="form-control col-md-2 mr-1" name="cart['+cartrowid+']['+'brand_name'+']" value="'+data[1]+'" readonly><input type="text" class="form-control col-md-2 mr-1" name="cart['+cartrowid+']['+'model_name'+']" value="'+data[2]+'" readonly><input type="text" class="form-control col-md-2 mr-1 min_price" name="cart['+cartrowid+']['+'min_price'+']" value="'+data[3]+'" readonly><input type="text" min="1"  class="form-control col-md-2 mr-1 price_sold" name="cart['+cartrowid+']['+'price_sold'+']" value="'+data[3]+'" readonly>    <input type="number" min="1"  class="form-control col-md-2 mr-1 quantity" name="cart['+cartrowid+']['+'quantity'+']" ><input type="hidden" class="form-control col-md-2 mr-1 available" value="'+data[4]+'" readonly><input type="hidden" class="form-control col-md-2 mr-1 product_id" name="cart['+cartrowid+']['+'product_id'+']" value="'+product_id+'"><a href="javascript:void(0)" style="color:red" class="delete" id="_'+delete_id+'"><i class="fa fa-trash"></i>  Delete </a></div></div>'
                    );


                    cartrowid++;

                } );

            } );
        </script>
    @endif


</div>

<div class="content">
    <div class="tab-pane" id="cartinfo">
        <div class="row">
            <div class="col-md-8">
                <div class="card-box">
                    <h4 class="card-title">Cart</h4>
                    <form id="cartform" action="javascript:void(0);">
                        <div class="app">
                            <div class="form-group">
                                <div class="row">
                                    <span class="col-md-2">Brand Name</span>
                                    <span class="col-md-2">Model Name</span>
                                    <span class="col-md-2">Min Price</span>
                                    <span class="col-md-2">Price Sold</span>
                                    <span class="col-md-2">Quantity To buy</span>
                                    <span class="col-md-2">Action</span>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <h2 class="mr-5 pt-3 m-0">Total : <span class="total"></span></h2>
                            <button type="button" class="btn btn-primary submit">Save Purchase</button>
                        </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box">
                    <h4 class="card-title">Customer Details</h4>

                    <div class="customer">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Customer Name:</label>
                                <input type="text" class="form-control customer_name" name="cart[0][customer_name]" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Location:</label>
                                <input type="text" class="form-control phone" name="cart[0][customer_location]" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    </form>

        </div>
    </div>
</div>

<div id="your_div_id">

</div>

<script>
    $(document).ready(function () {

        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            $(this).closest('.row').remove();
            del_id = ($(this).attr('id')).split('_');

            $('.productstable').find('tr:eq('+del_id[1]+')').find('button').prop('disabled', false);

            $(this).closest('tr').find("td:eq(0)").attr('id');
        });

        //calculat total
        var total = 0;

        //quantity keyup
        $(document).on('keyup', '.quantity', function(e){
            this.value = this.value.replace(/\D/g,'');

            calculate_total();
            total = 0;
        });


        //price sold keyup
        $(document).on('keyup', '.price_sold', function(e){
            this.value = this.value.replace(/\D/g,'');
            calculate_total();

            total = 0;
        });


        function calculate_total(){
            $('.quantity').each(function(){
                var q = parseFloat($(this).val());
                var p = parseFloat($(this).closest('.row').find('.price_sold').val());
                total = total + (q * p);
            });

            $('.total').html(total + ' GHS');
        }





        $('.submit').click(function() {
            continuerequest = true;

            if( $('.quantity').length < 1){
                continuerequest = false;
                message('warning', ' Please add product(s) to cart');
            }

            if($('.customer_name').val() == ''){
                message('warning', 'Customer Details is Required');
                return false;
            }




            var quantity_update = {};
            quantity_update.quantity=[]


            $('.quantity').each(function(){
                if($(this).val() == '' || $(this).val() < 1){
                    message('warning', 'Please Enter Quantity to buy for all products');
                    continuerequest = false;
                    return false;
                }


                //check quantity available against to be sold
                var av = parseInt($(this).closest('.row').find('.available').val());

                if($(this).val() > av){
                    message('warning', 'Quantity to buy is greater than available in stock');
                    continuerequest = false;
                    return false;
                }


                //check price to be sold against min price
                var price_sold = parseInt($(this).closest('.row').find('.price_sold').val());
                var min_price = parseInt($(this).closest('.row').find('.min_price').val());

                if((price_sold < min_price) || isNaN(price_sold)){
                    message('warning', 'Price to be Sold cannot be less than Min Price');
                    continuerequest = false;
                    return false;
                }


                // //get
                // var product_id = parseInt($(this).closest('.row').find('.product_id').val());
                // quantity_update.quantity.push({product_id : $(this).val()});

            });

            //proceed purchase form submit
            if(continuerequest){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
                    }
                });
                // console.log(data);
                // return false;
                var data = $("#cartform").serializeArray();

                $.ajax({
                    type: 'POST',
                    url: location.protocol+'//'+location.hostname+':'+location.port+'/inventory/public/order',
                    data: data,
                    success: function (res) {

                        //intentinally made it !== successful
                        if(res == 'success'){
                            $('#your_div_id').html(JSON.stringify(quantity_update));
                            $('.add').prop('disabled', false);
                            message(res, 'Order Successfully saved');

                            $('.app').html(
                            '<div class="form-group"><div class="row"><span class="col-md-2">Brand Name</span><span class="col-md-2">Model Name</span><span class="col-md-2">Min Price</span><span class="col-md-2">Price Sold</span><span class="col-md-2">Quantity to Buy</span><span class="col-md-2">Action</span></div></div>');

                            $('.total').html('');
                            $('.customer_name').html('');
                            $('.phone').html('');

                            print_receipt();

                            setTimeout(function(){
                                location.reload();
                            }, 1000);

                        }else{
                            $('#your_div_id').html(res);

                        }
                    },
                    error: function (res) {

                        $('#your_div_id').html(JSON.stringify(res));

                        message('warning', JSON.stringify(res));
                    }

                });

                //reset cartrow index at the top
                cartrowid = 0;

            }

            function print_receipt(){
                //open receipt page
                setTimeout(function(){
                    window.open(location.protocol+'//'+location.hostname+':'+location.port+'/inventory/public/print_receipt', '_blank');
                }, 1000);
            }


        });
    });

</script>

{{-- <script>
    Echo.channel('paymentReceived')
        .listen('PaymentReceivedEvent', (data) =>{
            $.each( data.updatedDrugQuantity, function(key, value) {
                $('#'+this.id+'q').html(this.quantity + ' Pieces');
            });

            //refresh datatable
            table.destroy();

            table = $('.drugstable').DataTable();
        });


</script> --}}

@endsection
