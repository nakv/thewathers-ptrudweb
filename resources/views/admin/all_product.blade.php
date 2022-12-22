@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tất cả sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>
                                STT
                            </th>
                            <th>QTY</th>
                            <th nowrap>Tên sản phẩm</th>
                            <th nowrap>Giá</th>
                            <th nowrap>Hình ảnh</th>
                            <th nowrap>Danh mục</th>
                            <th nowrap>Thương hiệu</th>
                            <th nowrap>Nội dung</th>
                            <th nowrap>Mô tả</th>
                            <th nowrap>Hiển thị</th>
                            <th style="width:30px;">Sửa/Xóa</th>
                        </tr>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        $i = 0;
                        ?>
                    </thead>
                    <tbody>
                        @foreach ($all_product as $key => $product)
                            <?php
                            $i++;
                            ?>
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>{{ $product->product_quantity }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ number_format($product->product_price, 0, ',', '.') }}</td>
                                <td><img src="public/uploads/product/{{ $product->product_image }}"
                                        alt="{{ 'Thumbnail sản phẩm' . ' ' . $product->product_name }}" height="100"
                                        width="100"></td>
                                <td>
                                    <p
                                        style="
                        overflow: hidden;
                        text-overflow: ellipsis;
                        max-height: 60px;
                        ">
                                        {{ $product->category_name }}
                                    </p>
                                </td>
                                <td>{{ $product->brand_name }}

                                </td>
                                <td>
                                    <p
                                        style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            max-height: 60px;
                            ">
                                        {{ $product->product_content }}
                                    </p>
                                </td>
                                <td>
                                    <p
                                        style="
                        overflow: hidden;
                        text-overflow: ellipsis;
                        max-height: 60px;
                        ">
                                        {{ $product->product_desc }}
                                    </p>
                                </td>
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

                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{ $all_product->links() }}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
