@extends('info')
@section('content')
    <div id="contact-page" class="container">
        <div>
            <div class="column">
                <h2 class="title text-center">Liên hệ</h2>

                <img class="col-sm-6" style="border-radius: 5%;margin:30px 0;max-width:600px; height:auto;"
                    src="{{ asset('/public/frontend/images/contactus.jpg') }}" alt="bg-contactus">
                <div class="col-sm-6">
                    <div class="contact-info">
                        <h2 class="title text-center">Thông tin liên hệ</h2>
                        <address>
                            <p>Cửa hàng đồng hồ <strong>TheWatcher</strong></p>
                            <p><strong>Địa chỉ:</strong> 113 Ktx Khu A, ĐHQG Tp.HCM,</p>
                            <p>Khu phố 6, phường Linh Trung, Tp Thủ Đức, Tp. HCM</p>
                            <p><strong>Hotline:</strong> +19000000</p>
                            <p><strong>Fax:</strong> 1-205-205-8484</p>
                            <p><strong>Email:</strong> info@TheWatchers.com</p>
                        </address>
                        <div class="social-networks">
                            <br>
                            <h2 class="title text-center">Mạng xã hội</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <div class="row">


                <div class="col-sm-10" style="margin: 0 10%">
                    <div class="contact-form">
                        <h2 class="title text-center">Phản hồi</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required"
                                    placeholder="Nhập họ tên">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required"
                                    placeholder="Nhập email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required"
                                    placeholder="Tiêu đề">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8"
                                    placeholder="Để lại phản hồi"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right"
                                    value="Gửi phản hồi">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--/#contact-page-->
@endsection
