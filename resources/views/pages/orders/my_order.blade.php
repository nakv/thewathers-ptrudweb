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
                <h3> Đơn hàng của tôi</h3>
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
                                <td>{{ $stt }}
                                </td>
                                <td>{{ $od->order_code }}</td>
                                <td>{{ $od->order_status }}</td>
                                <td>{{ date('H:i:s d-m-Y', strtotime($od->created_at)) }}</td>
                                <td>

                                    <a href="{{ URL::to('#') }}">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!--/#cart_items-->
@endsection
