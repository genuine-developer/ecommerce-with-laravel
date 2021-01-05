@extends('frontend.master')
@section('shop')
    active
@endsection
@section('content')
        <!-- .breadcumb-area start -->
        <div class="breadcumb-area bg-img-4 ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-wrap text-center">
                            <h2>Shop Page</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><span>Shop</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .breadcumb-area end -->
        <!-- product-area start -->
        <div class="product-area pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="product-menu">
                            <ul class="nav justify-content-center">
                                <li>
                                    <a class="active" data-toggle="tab" href="#all">All product</a>
                                </li>
                                @foreach ($category as $cat)
                                    <li>
                                        <a data-toggle="tab" href="#chair{{ $cat->id }}">{{ $cat->category_name }}</a>
                                    </li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="all">
                        <ul class="row">
                            @foreach ($products as $key => $product)
                                <li class="col-xl-3 col-lg-4 col-sm-6 col-12 @if($key+1 > 4 ) moreload @endif">
                                    <div class="product-wrap">
                                        <div class="product-img">
                                            <span>Sale</span>
                                            <img src="{{ asset('thumbnail/'.$product->created_at->format('Y/m/').'/'.$product->thumbnail) }}" alt="{{ $product->title }}">
                                            <div class="product-icon flex-style">
                                                <ul>
                                                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="{{ route('Cart') }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{ route('SingleProduct', ['slug'=>$product->slug]) }}">{{ $product->title }}</a></h3>
                                            <p class="pull-left">$ {{ $product->price }}
        
                                            </p>
                                            <ul class="pull-right d-flex">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-half-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            <li class="col-12 text-center">
                                <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                            </li>
                        </ul>
                    </div>
                    @foreach ($category as $cat)
                        <div class="tab-pane" id="chair{{ $cat->id }}">
                            <ul class="row">
                                @foreach ($products->where('category_id', $cat->id) as $prod)
                                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                        <div class="product-wrap">
                                            <div class="product-img">
                                                <span>Sale</span>
                                                <img src="{{ asset('thumbnail/'.$prod->created_at->format('Y/m/').'/'.$prod->thumbnail) }}" alt="{{ $prod->title }}">
                                                <div class="product-icon flex-style">
                                                    <ul>
                                                        <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="{{ route('Cart') }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="{{ route('SingleProduct', ['slug'=>$prod->slug]) }}">{{ $prod->title }}</a></h3>
                                                <p class="pull-left">{{ $prod->price }}
            
                                                </p>
                                                <ul class="pull-right d-flex">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-half-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li> 
                                @endforeach  
                            </ul>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!-- product-area end -->

            <!-- Modal area start -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body d-flex">
                    <div class="product-single-img w-50">
                        <img src="assets/images/product/product-details.jpg" alt="">
                    </div>
                    <div class="product-single-content w-50">
                        <h3>Pure Nature Product</h3>
                        <div class="rating-wrap fix">
                            <span class="pull-left">$219.56</span>
                            <ul class="rating pull-right">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li>(05 Customar Review)</li>
                            </ul>
                        </div>
                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs</p>
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input type="text" value="1" />
                            </li>
                            <li><a href="cart.html">Add to Cart</a></li>
                        </ul>
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li><a href="#">Honey,</a></li>
                            <li><a href="#">Olive</a></li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal area start -->
        
@endsection