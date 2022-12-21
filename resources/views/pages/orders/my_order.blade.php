@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Đơn hàng</li>
                </ol>
            </div>
            <div class="panel-heading">
                <h2 style="text-align: center">Đơn hàng của tôi</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tình trạng</th>
                            <th>Ngày đặt</th>
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

                                {{-- Order Status --}}
                                <td>
                                    <?php
                                    switch ($od->order_status) {
                                        case 1:
                                            echo '<a href="' . url::to('/my-order-detail/' . $od->order_code) . '">Đang chờ xác nhận</a>';
                                            break;
                                        case 2:
                                            echo '<a href="' . url::to('/payment') . '">Đang chờ thanh toán</a>';
                                            break;
                                        case 3:
                                            echo '<a href="' . url::to('/payment') . '">Đang chờ thanh toán</a>';
                                            break;
                                        case 4:
                                            echo 'Đã xác nhận, đang gói hàng';
                                            break;
                                        case 5:
                                            echo 'Đã thanh toán, đang gói hàng';
                                            break;
                                        case 6:
                                            echo 'Đang vận chuyển';
                                            break;
                                        case 7:
                                            echo 'Đã nhận hàng';
                                            break;
                                        default:
                                            echo 'Lỗi tình trạng';
                                    }
                                    ?>
                                </td>
                                <td>{{ date('H:i:s d-m-Y', strtotime($od->created_at)) }}</td>

                                <td>

                                    <a href="{{ URL::to('#') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!--/#cart_items-->
@endsection
