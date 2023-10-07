<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="footer__widget">
                <div class="footer__logo">
                        <a href="./index.html"><img src="users/logo.png" alt=""></a>
                    </div>
                    <ul>
                        <li><a href="{{route('shop')}}">Danh Mục</a></li>
                        <li><a href="{{route('home.contact')}}"> Giới Thiệu</a></li>
                        <li><a href="{{route('home.contact')}}">Chính Sách Shop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5">
                <div class="footer__widget">
                    <h6>Tổng đài hỗ trợ (Miễn phí gọi)</h6>
                    <ul>
                        <li><a href="#">Liên hệ: 0386641908 (7:30 - 22:00)</a></li>
                        
                    </ul>
                </div>
            </div>
         
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>Tìm Kiếm</h6>
                    <form  <form action="{{ route('search') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" placeholder="" name="search" >
                        <button type="submit" class="site-btn">Tìm Kiếm</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>