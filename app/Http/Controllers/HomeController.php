<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Bill;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Love;
use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\NhapXuatKho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Bill\createRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //trang index
    public function index()
    {
        if (!empty(Auth::user()->id)) {
            $amount = 0;
            $total = 0;
            $category = Category::all();
            $idUser = Auth::user()->id;
            $cart = Cart::where('idUser', '=', $idUser)->get();
            $data = Product::all();

            $data1 = DB::table('product')->where('showsp', '1')->get();

            foreach ($cart as $car) {
                if ($car->idUser == $idUser) {
                    $product = Product::find($car->idProduct);
                    if (!empty($product)) {
                        $total = $total + ($product->price * $car->amount);
                        $amount++;
                    } else {
                        $total = 0;
                        $amount = 0;
                    }
                }
            }
            //return view('page.content.home', compact(['products']));
            return view('users.home', compact(['data', 'total', 'amount', 'data1']));
        } else {
            $cate = Category::all();
            $data = Product::all();
            $data1 = DB::table('product')->where('showsp', '1')->get();
            ;
            return view('users.home', compact(['data', 'data1']));
        }
    }
//chi tiết sp
    public function viewpro($id)
    {

        $pro1 = Product::find($id);

        return view('users.pages.product.detail', compact('pro1'));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //trang admin
        public function adminHome()
        {
            $this->middleware('auth');
            $pro = Product::all()->count();
            ;
            $cate = Category::all()->count();
            ;
            $user = User::where('is_admin', '=', 0)->count();
            $nv = User::where('is_admin', '=', 2)->count();
            ;
            $qln = NhapXuatKho::where('type', '=', 1)->count();
            ;
            $qlx = NhapXuatKho::where('type', '=', 2)->count();
            ;
            $bill1 = Bill::where('genaral', '=', 0)->count();
            $bill2 = Bill::where('genaral', '=', 1)->count();
            $bill3 = Bill::where('genaral', '=', 2)->count();
            $billtt = Bill::where('genaral', '=', 2)->sum('price');
            
            return view('admin.home', compact(['pro', 'cate', 'user', 'nv', 'qln', 'qlx', 'bill1', 'bill2', 'bill3','billtt']));
        }

    public function addcart($idUser, $idProduct)
    {
        $cardData = Cart::all();
        //dd($cardData);
        foreach ($cardData as $key => $card) {
            $empryData = ($card->idProduct == $idProduct) && ($card->idUser == $idUser) && ($card->amount >= 1);
            //dd($k);
            if ($empryData == true) {
                $cardRowUpdate = Cart::find($card->id);
                $cardRowUpdate->amount = $card->amount + 1;
                $cardRowUpdate->save();
                return redirect()->route('home')->with('success', 'Successfully add card ');
            }
        }
        if (
            Cart::create([
                'idUser' => $idUser,
                'idProduct' => $idProduct,
                'genaral' => 1,
                'amount' => 1
            ])
        ) {
            return redirect()->route('home')->with('success', 'Successfully add card ');
        } else {
            return redirect()->route('home')->with('error', 'error add card ');
        }
    }
    public function themcart($idUser, $idProduct, Request $request)
    {
        // dd(123);
        $cart = Cart::where('idProduct', $idProduct)
        ->where('genaral', 1)
        ->where('size', $request->input('size'))
        ->where('color', $request->input('color'))
        ->first();

        // dd($cart);
        if (!empty($cart)) {

            $cart->amount = $cart->amount + 1;
            $cart->save();
            return redirect()->route('home')->with('success', 'Successfully add card ');
        } else {
            if (
                Cart::create([
                    'idUser' => $idUser,
                    'idProduct' => $idProduct,
                    'genaral' => 1,
                    'amount' => 1,
                    'size' => $request->input('size'),
                    'color' => $request->input('color'),
                ])
            ) {
                return redirect()->route('home')->with('success', 'Successfully add card ');
            } else {
                return redirect()->route('home')->with('error', 'error add card ');
            }
        }
    }
    public function themcart1($idUser, $idProduct,$size, $color,Request $request)
    {
        // dd(123);
        $cart = Cart::where('idProduct', $idProduct)->where('size', $size)
        ->where('color', $color)
        ->where('genaral', 1)
        ->first();
        // dd($cart);
        if (!empty($cart)) {

            $cart->amount = $cart->amount + 1;
            $cart->save();
            return redirect()->route('home')->with('success', 'Successfully add card ');
        } else {
            if (
                Cart::create([
                    'idUser' => $idUser,
                    'idProduct' => $idProduct,
                    'genaral' => 1,
                    'amount' => 1
                ])
            ) {
                return redirect()->route('home')->with('success', 'Successfully add card ');
            } else {
                return redirect()->route('home')->with('error', 'error add card ');
            }
        }


    }
    public function trucart($idUser, $idProduct)
    {
        $cardData = Cart::all();
        //dd($cardData);
        foreach ($cardData as $key => $card) {
            $empryData = ($card->idProduct == $idProduct) && ($card->idUser == $idUser);
            //dd($k);
            if ($empryData == true && ($card->amount >= 2)) {
                $cardRowUpdate = Cart::find($card->id);
                $cardRowUpdate->amount = $card->amount - 1;
                $cardRowUpdate->save();
                return redirect()->route('home.cartUser', Auth::user()->id)->with('success', 'Đã trừ thành công ');
            }
            if ($empryData == true && ($card->amount = 1)) {
                $card->delete();
                return redirect()->route('home.cartUser', Auth::user()->id)->with('error', 'Sản phẩm đã được xóa của bạn');
            }
        }
        if (
            Cart::create([
                'idUser' => $idUser,
                'idProduct' => $idProduct,
                'genaral' => 1,
                'amount' => 1
            ])
        ) {
            return redirect()->route('home')->with('success', 'Successfully add card ');
        } else {
            return redirect()->route('home')->with('error', 'error add card ');
        }
    }

    public function viewProduct($idProduct)
    {
        $data = Product::find($idProduct);

        $comment = Comment::all();
        $category1 = Category::all();
        $cateliequan = Product::where("id_category", '=', $data->id_category)->where('id', '!=', $data->id)->get();



        // $data1 = DB::table('product')
        // ->join('category', 'product.id_category', '=', 'category.id')->where('product.id',$idProduct )
        // ->select('category.name', 'product.id')
        // ->get();
        $category = DB::table('category')
            ->where('id', $data->id_category)
            ->value('name');


        return view("users.pages.product.detail", compact('category', 'data', 'category1', 'comment', 'cateliequan'));
    }
    public function delete(Cart $id)
    {
        $id->delete();
        return redirect()->route('home.cartUser', Auth::user()->id)->with('success', 'Đã xóa sản phẩm');
    }
    public function pay()
    {
        $amount = 0;
        $total = 0;
        $idUser = Auth::user()->id;
        $cart = Cart::where('idUser', '=', $idUser)->where('genaral', '=', 1)->get();
        $products = Product::all();
        foreach ($cart as $car) {
            if ($car->idUser == $idUser) {
                $product = Product::find($car->idProduct);
                if (!empty($product)) {
                    $total = $total + ($product->price * $car->amount);
                    $amount++;
                } else {
                    $total = 0;
                    $amount = 0;
                }
            }
        }
        $data = Cart::where('idUser', '=', $idUser)->where('genaral',1)->get();
        return view("users.pages.order.checkout", compact('data', 'total', 'amount', 'products'));
    }
    public function cartUser($idUser)
    {
        $amount = 0;
        $total = 0;
        $category = Category::all();
        $idUser = Auth::user()->id;
        $cart = Cart::where('idUser', '=', $idUser)->where('genaral', '=', 1)->get();
        $products = Product::all();
        foreach ($cart as $car) {
            if ($car->idUser == $idUser) {
                $product = Product::find($car->idProduct);
                if (!empty($product)) {
                    $total = $total + ($product->price * $car->amount);
                    $amount++;
                } else {
                    $total = 0;
                    $amount = 0;
                }
            }
        }
        $data = Cart::where('idUser', '=', $idUser)->where('genaral', '=', 1)->get();
        return view('users.pages.cart.cart', compact('products', 'data', 'total', 'amount'));
    }
    public function postthanhtoan(createRequest $request)
    {
        $cartUser = Cart::where('idUser', '=', Auth::user()->id)->where('genaral', '=', 1)->get();
        $id_cart = '';
        foreach ($cartUser as $key => $item) {
            $id_cart = $item->id . ',' . $id_cart;
        }
        $id_cart = substr($id_cart, 0, -1);

        $bill = new Bill();
        $bill->idUser = Auth::user()->id;
        $bill->name = $request->name;
        $bill->email = $request->email;
        // genaral status 0 là hiển thị dưới dạng người dùng mới tạo và chưa có contract
        // genaral 1 mua nhưng k tạo contract
        // 3 là có tạo contract
        $bill->genaral = 0;
        $bill->price = $request->price;
        $bill->numberPhone = $request->numberPhone;
        $bill->address = "Số-Đường :" . $request->sonha . "/Xã :" . $request->xa . "/Huyện-Quận :" . $request->huyen . "/Tỉnh :" . $request->tinh;
        $bill->idCart = $id_cart;
        $bill->save();
        if ($bill) {
            foreach ($cartUser as $car) {
                $pro = Product::find($car->idProduct);
                $car->genaral = 2;
                $car->save();
                $prott = $pro->amount - $car->amount;
                // Update the 'amount' attribute of the Product model
                $pro->amount = $prott;
                $pro->save();
                

            }
            return redirect()->route('home')->with('success', 'Đặt thành công.');
        }

    }
    //trang danh mục
    public function category($id_category)
    {
        if (!empty(Auth::user()->id)) {
            $amount = 0;
            $total = 0;
            $category = Category::all();
            $pro = Product::where('id_category', '=', $id_category)->get();
            $idUser = Auth::user()->id;
            $cart = Cart::where('idUser', '=', $idUser)->where('genaral', '=', 1)->get();


            foreach ($cart as $car) {
                if ($car->idUser == $idUser && $car->genaral == 1) {
                    $product = Product::find($car->idProduct);
                    if (!empty($product)) {
                        $total = $total + ($product->price * $car->amount);
                        $amount++;
                    } else {
                        $total = 0;
                        $amount = 0;
                    }
                }
            }
            //return view('page.content.home', compact(['products']));
            return view('users.pages.category.list', compact(['category', 'pro', 'total', 'amount']));
        } else {
            $category = Category::all();
            $pro = Product::where('id_category', '=', $id_category)->get();
            return view('users.pages.category.list', compact(['category', 'pro',]));
        }
    }
//trang shop
    public function shop()
    {
        $category = Category::all();
        $pro = Product::paginate(6);

        return view('users.pages.shop.shop', compact('pro', 'category'));
    }

    public function search(Request $request)
    {
        // Lấy giá trị từ ô tìm kiếm
        $search = $request->input('search');
        $category = Category::all();

        // Lấy giá trị sắp xếp từ request, mặc định là null
        $sort = $request->input('sort', null);

        // Tìm kiếm sản phẩm có tên chứa chuỗi ký tự tìm kiếm
        $query = Product::where('name', 'like', '%' . $search . '%')->orWhere('price', 'like', '%' . $search . '%');

        // Sắp xếp sản phẩm nếu có giá trị sắp xếp được cung cấp
        if ($sort) {
            if ($sort === 'asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'desc') {
                $query->orderBy('price', 'desc');
            }
        }

        // Lấy danh sách sản phẩm
        $pro = $query->get();

        // Trả về kết quả tìm kiếm đã sắp xếp
        return view('users.pages.search.pages', compact('pro', 'category','search', 'sort'));
    }

    public function addlove(Request $request, $id_product)
    {

        $category = Category::all();
        $love = new Love();

        $love->id_user = $request->id_user;
        $love->id_product = $request->id_product;
        $love->save(); {
            return redirect()->back()->with('success', 'Thêm thành công.');
        }
    }


    public function listlove()
    {

        $category = Category::all();
        $id_user = Auth::user()->id;
        $data = Love::where('id_user', '=', $id_user)->get();
        $product = Product::all();
        return view('users.pages.love.list', compact('data', 'product', 'category'));

    }
    public function deletelove(Love $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm');
    }

    //trang gioi thiue
    public function contact()
    {


        return view('users.pages.contact');

    }
    public function blog()
    {

        $data = Blog::orderBy('id','DESC')->search()->paginate(10);
        return view('users.pages.blog.home', compact('data'));

    }
    public function blog1($idBlog){
        $data =Blog::find($idBlog);
        return view("users.pages.blog.detail", compact('data'));
    }

    public function mycart()
    {
        $amount = 0;
        $total = 0;
        $idUser = Auth::user()->id;
        $bill1 = Bill::where('idUser', '=', $idUser)->where('genaral', 0)->get();
        $bill2 = Bill::where('idUser', '=', $idUser)->where('genaral', 1)->get();
        $bill3 = Bill::where('idUser', '=', $idUser)->where('genaral', 2)->get();
        $carts1 = [];
        $carts2 = [];
        $carts3 = [];
        foreach ($bill1 as $key => $bil) {
            $cart = DB::table('cart')->whereIn('cart.id', explode(',', $bil->idCart))
                ->join('product', 'product.id', '=', 'cart.idProduct')->
                select('cart.*', 'product.name', 'product.price', 'product.image', 'product.description')->get();
            array_push($carts1, [$bil->id, $cart]);
        }

        $carts2 = [];
        foreach ($bill2 as $key => $bil) {
            $cart = DB::table('cart')->whereIn('cart.id', explode(',', $bil->idCart))
                ->join('product', 'product.id', '=', 'cart.idProduct')->
                select('cart.*', 'product.name', 'product.price', 'product.image', 'product.description')->get();
            array_push($carts2, $cart);
        }
        $carts3 = [];
        foreach ($bill3 as $key => $bil) {
            $cart = DB::table('cart')->whereIn('cart.id', explode(',', $bil->idCart))
                ->join('product', 'product.id', '=', 'cart.idProduct')->
                select('cart.*', 'product.name', 'product.price', 'product.image', 'product.description')->get();
            array_push($carts3, $cart);
        }
        return view('users.pages.order.checkoder', compact('total', 'carts1', 'carts2', 'carts3'));
    }

    public function deleteProduct($id)
    {
        $bill = Bill::find($id);
        foreach (explode(',', $bill->idCart) as $key => $cart) {
            $carrttt = Cart::find($cart);
            if (!empty($carrttt)) {
                $carrttt->delete();
            }
        }
        $bill->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm');
    }

    public function changePassword()
    {
        return view('users.pages.user.change-password');
    }
    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function edituser($id)
    {
        $user = User::find($id);
        return view('users.pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->address = $request['address'];
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
}