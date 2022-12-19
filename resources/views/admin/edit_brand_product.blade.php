@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa thương hiệu
                </header>
                <div class="panel-body">
                    @foreach ($edit_brand_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" method="post"
                                action="{{ URL::to('/update-brand-product/' . $edit_value->brand_id) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="brand_product_name">Tên danh mục</label>
                                    <input type="text" name="brand_product_name" class="form-control"
                                        id="brand_product_name" value="{{ $edit_value->brand_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="brand_product_desc">Mô tả danh mục</label>
                                    <textarea class="form-control" style="resize: none" name="brand_product_desc" rows="8" id="brand_product_desc"> {{ $edit_value->brand_desc }}</textarea>
                                </div>
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật thương
                                    hiệu</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

    </div>
@endsection
