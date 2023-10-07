@extends('users.master')

@section('content')

<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home')}}"><i class="fa fa-home"></i> Trang Chủ</a>
                        <a href="{{route('home.blog')}}">Khuyến Mãi</a>
                        <span>{{$data->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="img/blog/details/blog-details.jpg" alt="">
                            <div class="blog__details__item__title">
                              
                                <h4>{{$data->name}}</h4>
                                <ul>

                                    <li>{{$data->created_at}}</li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            <p>{!!$data->content!!}</p>
                           
                        </div>
                      
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection