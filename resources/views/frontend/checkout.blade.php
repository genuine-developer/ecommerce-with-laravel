@extends('frontend.master')
@section('checkout')
    active
@endsection
@section('content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form action="{{ route('Payment') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <p>First Name *</p>
                                    <input type="text" name="first_name">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Last Name *</p>
                                    <input type="text" name="last_name">
                                </div>
                                <div class="col-12">
                                    <p>Company Name</p>
                                    <input type="text" name="company">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="phone">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country *</p>
                                    <select name="country_id" id="country_id">
                                        <option value="">Select One</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>State *</p>
                                    <select name="state_id" id="state_id"></select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <select name="city_id" id="city_id"></select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="text" name="zipcode">
                                </div>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address">
                                </div>
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            @php
                                $grand_total = 0;
                            @endphp
                            @foreach ($carts as $cart)
                                @php
                                    $grand_total += $cart->product->price * $cart->quantity;
                                @endphp
                                <li>{{ $cart->product->title }} <span class="pull-right">${{ $cart->product->price }} x {{ $cart->quantity }}</span></li>
                            @endforeach
                                <li>Subtotal <span class="pull-right"><strong>$380.00</strong></span></li>
                                <li>Shipping <span class="pull-right">Free</span></li>
                                <li>Total<span class="pull-right">$ {{ $grand_total }}</span></li>
                            
                            
                        </ul>
                        <ul class="payment-method">
                            <li>
                                <input id="bank" value="bank" type="radio" name="payment">
                                <label for="bank">Direct Bank Transfer</label>
                            </li>
                            <li>
                                <input id="paypal" value="paypal" type="radio" name="payment">
                                <label for="paypal">Paypal</label>
                            </li>
                            <li>
                                <input id="card" value="card" type="radio" name="payment">
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" value="cash" type="radio" name="payment">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button type="submit">Place Order</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection

@section('footer_js')
    <script>
        $('#country_id').change(function(){
            var countryID = $(this).val();    
            if(countryID){
                $.ajax({
                type:"GET",
                url:"{{url('api/get-state-list')}}/"+countryID,
                success:function(res){               
                    if(res){
                        $("#state_id").empty();
                        $("#state_id").append('<option>Select State</option>');
                        $.each(res,function(key,value){
                            $("#state_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                
                    }else{
                    $("#state_id").empty();
                    }
                }
                });
            }else{
                $("#state_id").empty();
                $("#city_id").empty();
            }      
        });

        $('#state_id').on('change',function(){
            var stateID = $(this).val();    
            if(stateID){
                $.ajax({
                type:"GET",
                url:"{{url('api/get-city-list')}}/"+stateID,
                success:function(res){               
                    if(res){
                        $("#city_id").empty();
                        $.each(res,function(key,value){
                            $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                
                    }else{
                    $("#city_id").empty();
                    }
                }
                });
            }else{
                $("#city_id").empty();
            }
                
        });
    </script>
@endsection