<!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

            <title>Invoice</title>

            <link rel='stylesheet' type='text/css' href='{{asset('public/assets/css/receiptStyle.css')}}' />
            <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>

            {{-- <link rel='stylesheet' type='text/css' href='css/print.css' media='print' /> --}}
            <!-- <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script> -->
            <!-- <script type='text/javascript' src='js/example.js'></script> -->

        </head>

        <body >

            <div id='page-wrap'>

                <textarea id='header'>INVOICE</textarea>

                <div id='identity'>

                    <span id='address' style="font-weight: bold">Zillion Realm and Logistics Company Limited
                        <br> Location: Alabar -  Tamale Station
                        <br>Phone: 020564444 / 0547576296 / 0549010177</span>
                </div>

                <div id='customer'>

                    <table id='meta'>
                        <tr>
                            <td class='meta-head'>Invoice #</td>
                            <td><textarea>{{$repair->id}}</textarea></td>
                        </tr>
                        <tr>

                            <td class='meta-head'>DateTime</td>
                            <td><textarea id='date'>{{$repair->created_at}}</textarea></td>
                        </tr>
                        <tr>
                            <td class='meta-head'>Customer Name</td>
                            <td><div class='due'>{{$repair->cust_name}}</div></td>
                        </tr>
                        <tr>
                            <td class='meta-head'>Customer Phone</td>
                            <td><div class='due'>{{$repair->cust_phone}}</div></td>
                        </tr>

                    </table>

                </div>

                <table id='items'>

                    <tr>
                        <th>Phone</th>
                        <th>Fault</th>
                        <th>Amount</th>
                    </tr>

                    <tr class='item-row'>
                        <td>{{$repair->brand_name . ' ' . $repair->model_name}}</td>
                        <td>{{$repair->fault}}</td>
                        <td><span class='price'>{{$repair->amount}} GHS</span></td>
                    </tr>

                  <tr>
                      <td colspan='2' class='blank'> </td>
                      <td colspan='2' class='total'>Total : {{$repair->amount}} GHS </div></td>
                      <!-- <td colspan='3' class='total-value'><div id='total'>$875.00</div></td> -->
                  </tr>
                </table>
                <br>
                <br><br>
                ...............................<br>
                Signature / Stamp
            </div>

            <script>
                $(document).ready(function(){
                    window.print();
                    window.onafterprint = function () {
                        window.close();
                    }
                })
            </script>
        </body>

        </html>
