@extends('admin.index')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <strong>Thêm Danh Sách Kho </strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('NhapXuatKho.EditPost', ['id'=>$NhapXuatKho->id]) }}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label"> Loại hình</label></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="type" id="brow" class=" form-control-label">
                                        <option {{ $NhapXuatKho->type == 1 ? 'selected' : '' }} value="1">Nhập kho</option>
                                        <option {{ $NhapXuatKho->type == 2 ? 'selected' : '' }} value="2">Xuất kho</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label"> Sản phẩm</label></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="id_product" id="brow" class=" form-control-label">
                                        @foreach ($product as $pro)
                                        @if ($pro->id == $NhapXuatKho->id_product)
                                            <option selected value="{{$pro->id}}">{{$pro->name}}</option>
                                        @else
                                            <option value="{{$pro->id}}">{{$pro->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Số lượng</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{$NhapXuatKho->amount}}" name="amount" placeholder="Nhập"
                                        class="form-control">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Giá thành</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" value="{{$NhapXuatKho->price}}" name="price" placeholder="Nhập"
                                        class="form-control">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Thông tin chi tiết</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea id="text-input" name="content" placeholder="Nhập"
                                        class="form-control">{{$NhapXuatKho->content}}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
@endsection
