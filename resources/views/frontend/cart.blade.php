@extends('frontend.master')

@section('content')
    

     <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>{{ __('Shopping Cart')}}</h2>
                        <ul>
                            <li><a href="{{ route('Front') }}">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('CartUpdate') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="color">Color</th>
                                    <th class="size">Size</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grand_total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="images"><img src="assets/images/cart/1.jpg" alt=""></td>
                                        <td class="product"><a target="_blank" href="{{ route('SingleProduct', ['slug' => $cart->product->slug]) }}">{{ $cart->product->title }}</a></td>
                                        <td class="ptice">$ {{ $cart->product->price }}</td>
                                        <td class="color">{{ $cart->color->color_name }}</td>
                                        <td class="size">{{ $cart->size->size_name }}</td>
                                        <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                        <td name="quantity[]" class="quantity cart-plus-minus">
                                            <input type="text" value="{{ $cart->quantity }}" />
                                        </td>

                                        @php
                                            $grand_total += ($cart->quantity * $cart->product->price);
                                        @endphp

                                        <td class="total">$ {{ $cart->quantity * $cart->product->price }}</td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="shop.html">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code">
                                        <button>Apply Cupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>$380.00</li>
                                        <li><span class="pull-left"> Total </span> ${{ $grand_total }}</li>
                                    </ul>
                                    <a href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->


@endsection