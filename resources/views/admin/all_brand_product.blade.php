@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tất cả thương hiệu
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">

                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
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
                            <th>Tên thương hiệu</th>
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
                        @foreach ($all_brand_product as $key => $brand_)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td>{{ $brand_->brand_name }}</td>
                                <td><span class="text-ellipsis">
                                        <?php
                                        if ($brand_->brand_status == 1) {
                                            ?>
                                        <a href="{{ URL::to('/unactive-brand-product/' . $brand_->brand_id) }}"><span
                                                class="fa-eye-styling fa fa-eye"></span></a>
                                        <?php
                                        } else {
                                            ?>
                                        <a href="{{ URL::to('/active-brand-product/' . $brand_->brand_id) }}"><span
                                                class="fa-eye-styling fa fa-eye-slash"></span></a>
                                        <?php } ?>
                                    </span></td>
                                <td>
                                    <div class="edit-delete-button"> <a
                                            href="{{ URL::to('/edit-brand-product/' . $brand_->brand_id) }}"
                                            class="active styling-edit" class="edit-admin-button" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-info text-active">
                                            </i>
                                        </a>
                                        <a class="delete-admin-button"
                                            onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')"
                                            href="{{ URL::to('/delete-brand-product/' . $brand_->brand_id) }}"><i
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
                            {{ $all_brand_product->links() }}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
