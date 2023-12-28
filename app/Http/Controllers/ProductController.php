<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {   $this->middleware('auth');
       
    }
    public function List()
    {
        $cate = Category::all();
        $product = Product::all();
        return view('admin.product.list', compact('product', 'cate'));
    }
    public function Delete(Product $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm');
    }
    public function Create()
    {
        $cate = Category::all();
        return view('admin.product.create', compact(['cate']));
    }
    public function CreatePost(Request $request)
    {
        $product = new Product();
        // imageGet
        $arrayImgae = '';
        if ($request->has('image')) {
            if (!empty($request->image)) {
                foreach ($request->image as $key => $image) {
                    $arrayImgae =  $this->imageGet($key, $image) . '|' . $arrayImgae;
                }
            }
        }
        $product->name = $request->name;
        $product->id_category = $request->id_category;
        $product->amount = 0;
        $product->description = $request->description1;
        $product->price = $request->price;
        $product->size = implode(',', $request->input('size', [])); // Assuming 'size' is an array in your form
        $product->color = implode(',', $request->input('color', [])); // Assuming 'color' is an array in your form
        if ($request->hasFile('image1')) {
            $uploadedImages = [];

            foreach ($request->file('image1') as $index => $image) {
                $extension = $image->getClientOriginalExtension();
                $uploadname = 'image1_' . md5(uniqid()) . '_' . $index . '.' . $extension;
                $image->move(public_path() . '/uploads/', $uploadname);
                $uploadedImages[] = 'uploads/' . $uploadname;
            }

            $product->image1 = implode(',', $uploadedImages);
        }

        if ($request->hasFile('image2')) {
            $uploadedImagess = [];

            foreach ($request->file('image2') as $index => $image) {
                $extension = $image->getClientOriginalExtension();
                $uploadname = 'image2_' . md5(uniqid()) . '_' . $index . '.' . $extension;
                $image->move(public_path() . '/uploads/', $uploadname);
                $uploadedImagess[] = 'uploads/' . $uploadname;
            }

            $product->image2 = implode(',', $uploadedImagess);
        }

        if ($request->hasFile('image3')) {
            $uploadedImagesss = [];

            foreach ($request->file('image3') as $index => $image) {
                $extension = $image->getClientOriginalExtension();
                $uploadname = 'image3_' . md5(uniqid()) . '_' . $index . '.' . $extension;
                $image->move(public_path() . '/uploads/', $uploadname);
                $uploadedImagesss[] = 'uploads/' . $uploadname;
            }

            $product->image3 = implode(',', $uploadedImagesss);
        }


        if (!empty($arrayImgae)) {
            $product->image = substr_replace($arrayImgae, "", -1);
        }
        $product->save();
        return redirect()->route('Product.list')->with('success', 'thêm thành công');
    }
    public function Edit($id)
    {
        $cate = Category::all();
        $product = Product::findOrFail($id);

        return view('admin.product.edit', compact(['cate', 'product']));
    }
    public function EditPost($id, Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->id_category = $request->id_category;
        $product->amount = $request->amount;
        $product->description = $request->description1;
        $product->price = $request->price;
        $product->showsp = $request->showsp;
        // Handle selected sizes and colors as comma-separated strings
        $product->size = implode(',', $request->input('size', [])); // Assuming 'size' is an array in your form
        $product->color = implode(',', $request->input('color', [])); // Assuming 'color' is an array in your form
        if ($request->has('image')) {
            if (!empty($request->image)) {
                $countImageOld = count(explode('|', $product->image));
                $countImageNew = count($request->image);
                // dd($countImageOld, $countImageNew);
                $imageRequest = '';
                if ($countImageNew > $countImageOld) {
                    foreach ($request->image as $key => $ima) {
                        $imageRequest =  $this->imageGet($key, $ima) . '|' . $imageRequest;
                    }
                    $product->image = substr_replace($imageRequest, "", -1);
                } else {
                    foreach ($request->image as $key => $ima) {
                        $imageRequest =  $this->imageGet($key, $ima) . '|' . $imageRequest;
                    }
                    foreach (explode('|', $product->image) as $key => $ima) {
                        if (($key + 1) > $countImageNew) {
                            $imageRequest =   $ima . '|' . $imageRequest;
                        }
                    }
                    $product->image = substr_replace($imageRequest, "", -1);
                }
            }
        }
        if ($request->hasFile('image1')) {
            $uploadedImages = [];

            foreach ($request->file('image1') as $index => $image) {
                $extension = $image->getClientOriginalExtension();
                $uploadname = 'image1_' . md5(uniqid()) . '_' . $index . '.' . $extension;
                $image->move(public_path() . '/uploads/', $uploadname);
                $uploadedImages[] = 'uploads/' . $uploadname;
            }

            $product->image1 = implode(',', $uploadedImages);
        }

        if ($request->hasFile('image2')) {
            $uploadedImagess = [];

            foreach ($request->file('image2') as $index => $image) {
                $extension = $image->getClientOriginalExtension();
                $uploadname = 'image2_' . md5(uniqid()) . '_' . $index . '.' . $extension;
                $image->move(public_path() . '/uploads/', $uploadname);
                $uploadedImagess[] = 'uploads/' . $uploadname;
            }

            $product->image2 = implode(',', $uploadedImagess);
        }

        if ($request->hasFile('image3')) {
            $uploadedImagesss = [];

            foreach ($request->file('image3') as $index => $image) {
                $extension = $image->getClientOriginalExtension();
                $uploadname = 'image3_' . md5(uniqid()) . '_' . $index . '.' . $extension;
                $image->move(public_path() . '/uploads/', $uploadname);
                $uploadedImagesss[] = 'uploads/' . $uploadname;
            }

            $product->image3 = implode(',', $uploadedImagesss);
        }

        $product->save();
        return redirect()->route('Product.list')->with('success', 'Sửa thành công');
    }
    public function imageGet($index, $file)
    {
        $image = $file;
        $extension = $image->getClientOriginalExtension(); //Extension 'jpg'
        $uploadname = $index . '-product-' . time() . '.' . $extension;
        $image->move(public_path() . '/uploads/', $uploadname);

        return 'uploads/' . $uploadname;
    }
    public function storeImage($file)
    {
        $extension = $file->getClientOriginalExtension(); // Lấy phần mở rộng của tệp

        // Tạo tên tệp mới dựa trên thời gian và phần mở rộng của tệp
        $fileName = time() . '_' . uniqid() . '.' . $extension;

        // Di chuyển tệp vào thư mục cụ thể (ví dụ: public/image)
        $file->move(public_path('image'), $fileName);

        // Tạo đường dẫn URL hoàn chỉnh và trả về
        return asset('image/' . $fileName);
    }
}