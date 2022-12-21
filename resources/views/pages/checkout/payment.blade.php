@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Thanh toán đơn hàng</li>
                </ol>
            </div>
            <div class="panel-heading">
                <h2 style="text-align: center">Đơn hàng đang chờ thanh toán: </h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng</th>
                            <th>Thời gian</th>
                            <th>Mua lại</th>
                        </tr>

                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        $stt = 0;
                        ?>
                    </thead>
                    <tbody>

                        @foreach ($order as $key => $od)
                            <?php $stt++; ?>

                            <tr>

                                <td> <a href="{{ URL::to('/my-order-detail/' . $od->order_code) }}">{{ $stt }} </a>

                                </td>
                                <td><a href="{{ URL::to('/my-order-detail/' . $od->order_code) }}">{{ $od->order_code }}</a>
                                </td>
                                <td>
                                    <?php
                                    switch ($od->order_status) {
                                        case 2:
                                            echo '<p>Đang chờ thanh toán</p>';
                                            break;
                                        case 3:
                                            echo '<p>Đang chờ thanh toán</p>';
                                            break;
                                        default:
                                            echo 'Lỗi tình trạng';
                                    } ?>
                                </td>
                                <td>{{ date('H:i:s d-m-Y', strtotime($od->created_at)) }}</td>

                                <td>

                                    <a href="{{ URL::to('#') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </td>
                            </tr>

                            <?php
                            
                            if ($od->order_status != 2) {
                                echo ' <tr>';
                                echo '<td colspan="5">';
                                echo ' <h5 align="center">THÔNG TIN CHUYỂN KHOẢN</h5>';
                                echo '</td>';
                                echo ' </tr>';
                                echo ' <tr>';
                                echo '<td colspan="5">';
                                echo '<p> <strong>Tên người thụ hưởng:</strong> NGUYỄN ANH KHOA</p>';
                                echo '<p><strong>Ngân hàng:</strong> BIDV CN Tp HCM </p>';
                                echo ' <p><strong>Số tài khoản:</strong> 72110001228165</p>';
                                echo ' <h5>LƯU Ý: Nội dung chuyển khoản gồm: SĐT - Mã đơn hàng</h5>';
                                echo ' <h5>Mọi phản hồi xin liên hệ hotline CSKH: 19000000</h5>';
                                echo '</td>';
                                echo ' </tr>';
                            } elseif ($od->order_status == 2) {
                                echo ' <tr>';
                                echo '<td colspan="5">';
                                echo ' <h5 align="center">THÔNG TIN THẺ TÍN DỤNG</h5>';
                                echo '</td>';
                                echo ' </tr>';
                            
                                echo ' <tr>';
                                echo '<td colspan="2">';
                                echo '    <label for="user_name">Tên chủ thẻ: </label>';
                                echo '</td>';
                                echo '<td colspan="3">';
                                echo ' <input type="text" name="user_name" placeholder="Họ và tên">';
                                echo '</td>';
                                echo ' </tr>';
                                echo ' <tr>';
                                echo '<td colspan="2">';
                                echo '<label for="card_id">Mã thẻ: </label>';
                                echo '</td>';
                                echo '<td colspan="3">';
                                echo '  <input type="text" name="card_id" placeholder="Nhập mã thẻ"> ';
                                echo '</td>';
                                echo ' </tr>';
                                echo ' <tr>';
                                echo '<td colspan="2">';
                                echo ' <label for="cv_code">Mã CV: </label>';
                                echo '</td>';
                                echo '<td colspan="3">';
                                echo '  <input type="text" name="cv_code" placeholder="CV">';
                                echo '</td>';
                                echo ' </tr>';
                                echo ' <tr>';
                                echo '<td colspan="2">';
                                echo ' <label for="date_st">Ngày mở thẻ: </label>';
                                echo ' <input type="date" name="date_st" placeholder="Ngày mở thẻ">';
                                echo '</td>';
                                echo '<td colspan="2">';
                                echo '<label for="date_ex">Ngày hết hạn: </label> <input type="date" name="date_ex" placeholder="Ngày hết hạn">';
                                echo '</td>';
                                echo '<td><button>Thanh toán</button></td>';
                                echo ' </tr>';
                            }
                            ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <!--/#cart_items-->
@endsection
