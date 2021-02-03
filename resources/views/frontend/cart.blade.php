@extends('frontend.master')
@section('cart')
    active
@endsection
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
                                        <td class="images"><img src="{{ asset('thumbnail/'.$cart->product->created_at->format('Y/m/').'/'.$cart->product->thumbnail) }}" alt="{{ $cart->product->title }}"></td>
                                        <td class="product"><a target="_blank" href="{{ route('SingleProduct', ['slug' => $cart->product->slug]) }}">{{ $cart->product->title }}</a></td>
                                        <td class="ptice unit_price{{ $cart->id }}" data-unit{{ $cart->id }}="{{ $cart->product->price }}">$ {{ $cart->product->price }}</td>
                                        <td class="color">{{ $cart->color->color_name }}</td>
                                        <td class="size">{{ $cart->size->size_name }}</td>
                                        <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                        <td class="quantity cart-plus-minus">
                                            <input name="quantity[]" class="qty_quantity{{ $cart->id }}" type="text" value="{{ $cart->quantity }}" />
                                            <div class="dec qtybutton qtyminus{{ $cart->id }}">-</div>
                                            <div class="inc qtybutton qtyplus{{ $cart->id }}">+</div>
                                        </td>

                                        @php
                                            $grand_total += ($cart->quantity * $cart->product->price);
                                        @endphp

                                        <td class="total count_total total_unit{{ $cart->id }}">{{ $cart->quantity * $cart->product->price }}</td>
                                        <td class="remove"><a href="{{ route('SingleCartDelete', ['cart_id'=>$cart->id]) }}"><i class="fa fa-times"></i></a></td>
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
                                        <li><a href="{{ route('Shop') }}">Continue Shopping</a></li>
                                    </ul>
                    </form>

                                <form action="{{ route('Cart') }}" method="GET">
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input name="coupon_code" type="text" placeholder="Coupon Code" value="{{ $coup_code ?? '' }}">
                                        <button>Apply Coupon</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Sub Total $</span> {{ $grand_total ?? 0 }}</li>
                                        <li><span class="pull-left">Coupon Discount $ </span> {{ $coupon_discount ?? 0 }}</li>
                                        <li><span class="pull-left grand_total">Grand Total  $</span><span class="up_total" >{{ $grand_total - $coupon_discount }}</span></li>
                                    </ul>
                                    <a href="{{ route('Checkout') }}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->


@endsection

@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function(){

            @foreach($carts as $cart)
                $('.qtyminus{{ $cart->id }}').click(function(){
                    let qty_quantity = $('.qty_quantity{{ $cart->id }}').val()
                    let unit_price = $('.unit_price{{ $cart->id }}').attr('data-unit{{ $cart->id }}')
                    $('.total_unit{{ $cart->id }}').html(qty_quantity * unit_price)
                    let minus_sub_total = (qty_quantity * unit_price)

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ url('/quantity/update') }}",
                        method: "post",
                        data: {
                            id: "{{ $cart->id }}",
                            qty_quantity: qty_quantity,
                        },
                        success: function(result){
                            console.log(result)
                        }
                    })

                    let c_total = document.querySelectorAll('.count_total')
                    let arr = Array.from(c_total)
                    let sum = 0
                    arr.map(item=>{
                        sum += parseInt(item.innerHTML)
                        $('.up_total').html(sum)
                        console.log(sum)
                    })
                    
                })
        
                $('.qtyplus{{ $cart->id }}').click(function(){
                    let qty_quantity = $('.qty_quantity{{ $cart->id }}').val()
                    let unit_price = $('.unit_price{{ $cart->id }}').attr('data-unit{{ $cart->id }}')
                    $('.total_unit{{ $cart->id }}').html(qty_quantity * unit_price)
                    let plus_sub_total = (qty_quantity * unit_price)

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ url('/quantity/update') }}",
                        method: "post",
                        data: {
                            id: "{{ $cart->id }}",
                            qty_quantity: qty_quantity,
                        },
                        success: function(result){
                            console.log(result)
                        }
                    })

                    let c_total = document.querySelectorAll('.count_total')
                    let arr = Array.from(c_total)
                    let sum = 0
                    arr.map(item=>{
                        sum += parseInt(item.innerHTML)
                        $('.up_total').html(sum)
                        console.log(sum)
                    })
                })
            @endforeach

        })
    </script>

    {{-- For Alerts --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        @if (session('coupon_invalid'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('coupon_invalid') }}'
            })
        @endif
      
        @if (session('coupon_exist'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('coupon_exist') }}'
            })
        @endif
       
    </script>
@endsection