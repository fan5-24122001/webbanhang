@extends('users.master')
@section('content')

<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang Chủ</a>
                 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
        </div>
        <form action="{{ route('home.postthanhtoan') }}" method="POST" enctype="multipart/form-data" class="checkout__form">
        @csrf
            <div class="row">
                <div class="col-lg-6">
                    <h5>Thông Tin Thanh Toán Sản Phẩm</h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Tên  <span>*</span></p>
                                <input type="text" name="name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Số Nhà/Tên Đường <span>*</span></p>
                                <input type="text" name="sonha" placeholder="Số nhà - Tên đường">
                                @error('sonha')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout__form__input">
                                <p> Thôn/Xã/Thị Trấn<span>*</span></p>
                                <input type="text" name="xa" placeholder="Thôn - xã - thị trấn">
                                @error('xa')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout__form__input">
                                <p>Huyện/Thành Phố <span>*</span></p>
                                <input type="text" name="huyen">
                                @error('huyen')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout__form__input">
                                <p>Tỉnh <span>*</span></p>
                                <input type="text" name="tinh">
                                @error('tinh')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="checkout__form__input">
                                <p>Số Điện Thoại <span>*</span></p>
                                <input type="text" name="numberPhone">
                                @error('numberPhone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Email <span>*</span></p>
                                <input type="text" name="email" value="{{Auth::user()->email}}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__checkbox">


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout__order">
                        <h5>Sản Phẩm Mua</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Sản Phẩm</span>
                                    <span class="top__text__right">Tổng Tiền</span>
                                </li>
                                @foreach ($data as $item)
                                @foreach ($products as $pro)
                                @if ($pro->id == $item->idProduct)
                                <li>{{$pro->name}} : Số lượng {{$item->amount}}<span>$ {{($item->amount*$pro->price)}} VND</span></li>
                                @endif
                                @endforeach
                                @endforeach

                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                
                                <input type="hidden" name="price" value="{{$total}}">
                                <li>Tổng Gía Tiền <span>{{ number_format($total)}} VNĐ</span></li>
                            </ul>
                        </div>
                        <div class="checkout__order__widget">
                           
                        </div>
                        <button type="submit" class="site-btn"> Thanh Toán</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Blog Section End -->


@endsection