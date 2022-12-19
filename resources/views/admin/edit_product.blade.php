@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                            <form role="form" method="post" action="{{ URL::to('/update-product/' . $pro->product_id) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="product_name">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control"
                                        value="{{ $pro->product_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control"
                                        value="{{ $pro->product_price }}">
                                </div>
                                <div class="form-group">
                                    <label for="product_image">Hình ảnh sản phẩm</label>
                                    <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}"
                                        alt="{{ 'Ảnh sản phẩm ' . $pro->product_name }}" width="300" height="auto">
                                    <input type="file" name="product_image" class="form-control"
                                        accept="image/png, image/jpeg">

                                </div>
                                <div class="form-group">
                                    <label for="product_desc">Mô tả sản phẩm</label>
                                    <textarea class="form-control" style="resize: none" name="product_desc" rows="8">{{ $pro->product_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product_content">Nội dung sản phẩm</label>
                                    <textarea class="form-control" style="resize: none" name="product_content" rows="4">{{ $pro->product_content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product_cate">Sản phẩm thuộc danh mục</label>
                                    <select class="form-control input-sm m-bot15" name="product_cate">
                                        @foreach ($cate_product as $key => $cate)
                                            @if ($cate->category_id == $pro->category_id)
                                                <option selected value="{{ $cate->category_id }}">
                                                    {{ $cate->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="product_brand">Thương hiệu sản phẩm</label>
                                    <select class="form-control input-sm m-bot15" name="product_brand">
                                        @foreach ($brand_product as $key => $brand)
                                            @if ($brand->brand_id == $pro->brand_id)
                                                <option selected value="{{ $pro->brand_id }}">
                                                    {{ $brand->brand_name }}</option>
                                            @else
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="product_status">Hiển thị</label>
                                    <select class="form-control input-sm m-bot15" name="product_status">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                        @endforeach
                    </div>

                </div>
            </section>
        </div>

    </div>
@endsection
