@extends('users.master')
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản Phẩm </th>
                                <th>Gía</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Số Lượng</th>
                                <th>Tổng Tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data->isEmpty())
                        <tr>
                        <td colspan="8" class="text-center">Hiện Tại Bạn Chưa Thêm Sản Phẩm Nào</td>
                    </tr>
                    @else
                            @foreach ($data as $item)
                            @foreach ($products as $pro)
                            @if ($pro->id == $item->idProduct)
                            <tr>
                                <td class="cart__product__item">
                                    <img src="img/shop-cart/cp-1.jpg" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>{{$pro->name}}</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">{{ number_format($pro->price)}} VND</td>
                                <td class="cart__price">{{ $item->color}} </td>
                                <td class="cart__price">{{ $item->size}}</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <a href="{{ route('home.themcart1', [Auth::user()->id,$pro->id,$item->size,$item->color]) }}">+</a>
                                        <input type="text" value="{{$item->amount}}">
                                        <a href="{{ route('home.trucart', [Auth::user()->id,$pro->id]) }}">-</a>
                                    </div>
                                </td>
                                <td class="cart__total">{{ number_format($item->amount*$pro->price)}}VNĐ</td>
                                <td class="shoping__cart__item__close">
                                    <form action="{{ route('home.deleteProduct', $item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                 
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{ route('home') }}">Tiếp Tục Mua Hàng</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                   
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Tổng Tiền Giỏ Hàng</h6>
                    <ul>

                        <li>Tổng Tiền <span>{{ number_format($total)}} VNĐ</span></li>
                    </ul>
                    @if($total > 0)
                    
                        <a href="{{ route('home.pay') }}" class="primary-btn">Thanh Toán Ngay</a>
                    
                    @else
                        <a href="{{ route('home') }}" class="primary-btn">Tiếp Tục Mua Hàng</a>
                    
                    @endif
                 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->

@endsection