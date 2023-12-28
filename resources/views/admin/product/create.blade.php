@extends('admin.index')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <strong>Thêm Sản phẩm</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{ route('Product.createPost') }}" method="POST" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Loại sản phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="id_category" id="">
                                    @foreach ($cate as $ca)
                                    <option value="{{$ca->id}}">{{$ca->name}}</option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="name" placeholder="Nhập" class="form-control">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class="form-control-label">color</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-check">
                                    <input type="checkbox" id="white" name="color[]" value="white"
                                        class="form-check-input">
                                    <label for="white" class="form-check-label">White</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="blue" name="color[]" value="blue"
                                        class="form-check-input">
                                    <label for="blue" class="form-check-label">Blue</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="red" name="color[]" value="red" class="form-check-input">
                                    <label for="red" class="form-check-label">Red</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="purple" name="color[]" value="purple"
                                        class="form-check-input">
                                    <label for="purple" class="form-check-label">Purple</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="yellow" name="color[]" value="yellow"
                                        class="form-check-input">
                                    <label for="yellow" class="form-check-label">Yellow</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="pink" name="color[]" value="pink"
                                        class="form-check-input">
                                    <label for="pink" class="form-check-label">Pink</label>
                                </div>
                                @error('color')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class="form-control-label">Size</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-check">
                                    <input type="checkbox" id="size-s" name="size[]" value="S" class="form-check-input"
                                        checked>
                                    <label for="size-s" class="form-check-label">S</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="size-m" name="size[]" value="M" class="form-check-input">
                                    <label for "size-m" class="form-check-label">M</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="size-l" name="size[]" value="L" class="form-check-input">
                                    <label for="size-l" class="form-check-label">L</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="size-xl" name="size[]" value="XL"
                                        class="form-check-input">
                                    <label for="size-xl" class="form-check-label">XL</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="size-xxl" name="size[]" value="XXL"
                                        class="form-check-input">
                                    <label for="size-xxl" class="form-check-label">XXL</label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Thông tin chi tiết</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea name="description1"></textarea>

                                <!-- <textarea id="text-input" name="description" placeholder="Nhập"
                                        class="form-control"></textarea> -->
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Giá / 1 sản phẩm</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="text-input" name="price" placeholder="Nhập"
                                    class="form-control">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="image_here">
                                <div class="row form-group image_count">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ảnh </label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="text-input" name="image[]" placeholder="Nhập"
                                            class="form-control">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                      
                        <div class="col">
                            <div class="image_here">
                                <div class="row form-group image_count">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ảnh 1</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="text-input" name="image1[]" multiple placeholder="Nhập"
                                            class="form-control">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <div class="image_here">
                                <div class="row form-group image_count">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ảnh 2</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="text-input" name="image2[]"  multiple placeholder="Nhập"
                                            class="form-control">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <div class="image_here">
                                <div class="row form-group image_count">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Ảnh 3</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="text-input" name="image3[]" multiple placeholder="Nhập"
                                            class="form-control">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Tạo
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
CKEDITOR.replace('description1');
</script>
@endsection