@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tất cả sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Nội dung</th>
                            <th>Mô tả</th>
                            <th>Hiển thị</th>
                            <th style="width:30px;">Sửa/Xóa</th>
                        </tr>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>
                    </thead>
                    <tbody>
                        @foreach ($all_product as $key => $product)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ number_format($product->product_price, 0, ',', '.') }}</td>
                                <td><img src="public/uploads/product/{{ $product->product_image }}"
                                        alt="{{ 'Thumbnail sản phẩm' . ' ' . $product->product_name }}" height="100"
                                        width="100"></td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->brand_name }}</td>
                                <td>{{ $product->product_content }}</td>
                                <td>{{ $product->product_desc }}</td>
                                <td><span class="text-ellipsis">
                                        <?php
                                        if ($product->product_status == 1) {
                                            ?>
                                        <a href="{{ URL::to('/unactive-product/' . $product->product_id) }}"><span
                                                class="fa-eye-styling fa fa-eye"></span></a>
                                        <?php
                                        } else {
                                            ?>
                                        <a href="{{ URL::to('/active-product/' . $product->product_id) }}"><span
                                                class="fa-eye-styling fa fa-eye-slash"></span></a>
                                        <?php } ?>
                                    </span></td>
                                <td>
                                    <div class="edit-delete-button"> <a
                                            href="{{ URL::to('/edit-product/' . $product->product_id) }}"
                                            class="active styling-edit" class="edit-admin-button" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-info text-active">
                                            </i>
                                        </a>
                                        <a class="delete-admin-button"
                                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
                                            href="{{ URL::to('/delete-product/' . $product->product_id) }}"><i
                                                class="fa fa-times text-danger text styling-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection