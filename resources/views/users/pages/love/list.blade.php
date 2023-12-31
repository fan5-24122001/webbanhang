@extends('users.master')
@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                <a href="{{ route('home')}}"><i class="fa fa-home"></i> Trang Chủ</a>
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
                                <th>Sản Phẩm</th>
                                <th>Gía</th>
                                <th>Trạng Thái</th>
                              
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                       
                    </tr>
                    @if($data->isEmpty())
                        <tr>
                        <td colspan="8" class="text-center">Hiện Tại Bạn Chưa Thêm  Sản Phẩm  Yêu Thích Nào</td>
                    </tr>
                    @else
                            @foreach ($data as $item)
                            @foreach ($product as $pro)
                            @if ($item->id_product == $pro->id)
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
                                <td class="cart__price">{{ number_format($pro->price, 0) }}VND </td>
                               
                                <td class="shoping__cart__item__close">
                                    <form action="{{ route('home.deletelove', $item->id) }}" method="POST">
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
     
    </div>
</section>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->

@endsection