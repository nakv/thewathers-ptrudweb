@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa danh mục sản phẩm
                </header>
                <div class="panel-body">
                    @foreach ($edit_category_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" method="post"
                                action="{{ URL::to('/update-category-product/' . $edit_value->category_id) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="category_product_name">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control"
                                        id="category_product_name" placeholder="Tên danh mục"
                                        value="{{ $edit_value->category_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="category_product_desc">Mô tả danh mục</label>
                                    <textarea class="form-control" style="resize: none" name="category_product_desc" rows="8"
                                        id="category_product_desc"> {{ $edit_value->category_desc }}</textarea>
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh
                                    mục</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

    </div>
@endsection
