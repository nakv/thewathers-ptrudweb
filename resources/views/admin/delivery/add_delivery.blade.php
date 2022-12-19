@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm vận chuyển
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
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="city">Chọn thành phố</label>
                                <select class="form-control input-sm m-bot15 choose city" name="city" id="city"
                                    required>
                                    <option>-- Chọn tỉnh/thành phố --</option>
                                    @foreach ($city as $key => $ci)
                                        <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="province">Chọn quận huyện</label>
                                <select class="form-control input-sm m-bot15 choose province" name="province" id="province"
                                    required>
                                    <option>-- Chọn quận huyện --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="wards">Chọn xã phường</label>
                                <select id="wards" name="wards" class="form-control input-sm m-bot15 wards" required>
                                    <option>-- Chọn xã phường --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fee_ship">Phí vận chuyển</label>
                                <input type="number" name="fee_ship" class="form-control fee_ship"
                                    placeholder="Phí vận chuyển" required>
                            </div>
                            <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thiết lập phí vận
                                chuyển</button>
                        </form>
                        <div id="load_delivery" style="margin-top: 15px"></div>
                    </div>

                </div>
            </section>
        </div>

    </div>
@endsection
