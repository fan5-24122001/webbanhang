@extends('users.master')

@section('content')
 <!-- Breadcrumb Begin -->
 <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home')}}"><i class="fa fa-home"></i> Trang Chủ</a>
                        <span>Khuyến Mãi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                            @foreach ($data as $item1)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="blog__item">
                                        <div class="blog__item__pic set-bg" data-setbg="imgUploads/{{$item1->img}}"></div>
                                        <div class="blog__item__text">
                                            <h6><a href="{{ route('home.bg', $item1->id) }}">{{$item1->name}}</a></h6>
                                            <ul>
                                                <li>{{$item1->created_at}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                               @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

    @endsection