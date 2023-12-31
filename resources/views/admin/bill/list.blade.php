@extends('admin.index')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

<!-- MAIN CONTENT-->
<div style="display: flex; justify-content: space-between;">
    <h2 class="title-5 m-b-35 bg-primary">Danh sách các đơn </h2>
 </div>
<table class="table table-data2">
    <thead>
        <tr>
            <th>...</th>
            <th>Người đặt</th>
            <th>Email</th>
            <th>Tổng tiền</th>
            <th>Địa chỉ</th>
            <th>Số Điện thoại</th>

           
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $book)
        <tr class="tr-shadow">
            <td>{{$book->id}}</td>
            <td><b>{{$book->name}}</b></td>
            <td><b class="text-danger">{{$book->email}}</b></td>
            <td><b class="text-warning">{{ number_format($book->price)}}</b> VNĐ</td>
            <td>{{$book->address}}</td>
            <td>{{$book->numberPhone}}</td>
            <td>{{$book->xa}}</td>
            <td>
                <div class="table-data-feature">
                    <a  href="{{route('admin.editBill',$book->id)}}" class="item btnEdit" data-toggle="tooltip" data-placement="top" title="Sửa">
                        <i class="zmdi zmdi-edit"></i>
                    </a>

                    <form action="{{route('admin.deleteBill',$book->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">   <i  class="zmdi zmdi-delete text-danger"></i></button>
                                    </form>


                    @if (!empty($book->idUser))
                    <a  href="{{route('admin.sanpham',[$book->id,$book->idUser] )}}" class="item btnView" data-toggle="tooltip" data-placement="top" title="Xem sản phẩm">
                        <i class="zmdi zmdi-shopping-cart text-warning"></i>
                    </a>
                    @endif
                    @if ($genaral == 0)
                    <a href="{{route('admin.changeBill',['id'=>$book->id, 'status'=>1])}}" class="item btnchage "  data-toggle="tooltip" data-placement="top" title="Xác nhận đơn và giao hàng">
                        <i class="zmdi zmdi-badge-check text-success"></i>
                    </a>
                    @endIf
                    @if ($genaral == 1)
                    <a href="{{route('admin.changeBill',['id'=>$book->id, 'status'=>2])}}" class="item btnchage "  data-toggle="tooltip" data-placement="top" title="Xác nhận đơn đã giao hàng">
                        <i class="zmdi zmdi-badge-check text-success"></i>
                    </a>
                    @endIf
                    @if ($genaral == 2)
                    <a href="{{route('admin.changeBill',['id'=>$book->id, 'status'=>3])}}" class="item btnchage "  data-toggle="tooltip" data-placement="top" title="Ẩn đơn hàng">
                        <i class="zmdi zmdi-badge-check text-success"></i>
                    </a>
                    @endIf
                    
                </div>
            </td>
        </tr>
        <tr class="spacer"></tr>
        @endforeach
    </tbody>
</table>

<form method="POST" action="" id="formDelete">
    @csrf @method('DELETE')
</form>
<div>
    {{$data->appends(request()->all())->links()}}
</div>
@stop()

