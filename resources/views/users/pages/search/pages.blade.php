@extends('users.master')

@section('content')
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang Chủ</a>
                    <span>Tìm Kiếm</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<div class="row">
            <div class="col-lg-12">
            <div class="col-lg-12">
                
            </div>
            </div>
        </div>
<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
            <div class="shop__sidebar">
            <div class="sidebar__categories">
    <div class="section-title">
        <h4>Sort</h4>
    </div>
    <form class="search-form" action="{{ route('search') }}" method="GET">
        @csrf
        <input type="hidden" name="search" placeholder="Nhập từ khóa..." value="{{ $search }}">
        <select name="sort" id="sortSelect">
            <option value="">Sắp xếp</option>
            <option value="asc" {{ $sort === 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
            <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
        </select>
    </form>
</div>

<script>
    document.getElementById('sortSelect').addEventListener('change', function() {
        document.querySelector('.search-form').submit();
    });
</script>
</div>
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Categories</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                @foreach($category as $cate)
                                <div class="card">
                                    <div class="card-heading">
                                        <a href="{{ route('category', ['id_category'=>$cate->id]) }}">{{ $cate->name }}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row" id="productItemsContainer">
                    @if($pro->isEmpty())
                    <div class="col-lg-4 col-md-4 col-sm-6 mix women">
                        <p>Không tìm thấy kết quả!</p>
                    </div>
                    @else
                    @foreach($pro as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 mix women">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <a href="{{ route('home.product', $item->id) }}">
                                    <img src="{{ $item->image }}" alt="Girl in a jacket">
                                </a>
                                <ul class="product__hover">
                                    <li><a href="{{ route('home.product', $item->id) }}"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="{{ route('home.product', $item->id) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('home.product', $item->id) }}">{{ $item->name }}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">${{ number_format($item->price, 2) }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function search() {
        var searchValue = document.getElementById('searchInput').value;
        var sortValue = document.getElementById('sortSelect').value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '{{ route("search") }}?search=' + searchValue + '&sort=' + sortValue);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var products = response.pro;
                var productItemsContainer = document.getElementById('productItemsContainer');
                productItemsContainer.innerHTML = '';

                if (products.length === 0) {
                    productItemsContainer.innerHTML = '<div class="col-lg-4 col-md-4 col-sm-6 mix women"><p>Không tìm thấy kết quả!</p></div>';
                } else {
                    products.forEach(function(item) {
                        var productItem = document.createElement('div');
                        productItem.className = 'col-lg-4 col-md-4 col-sm-6 mix women';

                        var productItemContent = `
                            <div class="product__item">
                                <div class="product__item__pic set-bg">
                                    <a href="{{ route('home.product', '') }}/${item.id}">
                                        <img src="${item.image}" alt="Girl in a jacket">
                                    </a>
                                    <ul class="product__hover">
                                        <li><a href="{{ route('home.product', '') }}/${item.id}"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="{{ route('home.product', '') }}/${item.id}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('home.product', '') }}/${item.id}">${item.name}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">$${item.price}</div>
                                </div>
                            </div>
                        `;

                        productItem.innerHTML = productItemContent;
                        productItemsContainer.appendChild(productItem);
                    });
                }
            }
        };
        xhr.send();
    }

    document.getElementById('searchInput').addEventListener('input', function() {
        search();
    });

    document.getElementById('sortSelect').addEventListener('change', function() {
        search();
    });
</script>
@endsection
