@extends('layouts.frontend')

@section('title', 'Guide Page')

@section('body_class', 'guide-page')

@section('content')

<div class="col-sm-10 col-sm-offset-1">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h1 class="text-center">Guide</h1>
        </div>
        <div class="ibox-content">
            <h3>Lưu ý: Các bạn phải đăng nhập trước khi thực hiện các bước theo hướng dẫn bên dưới.</h3>
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Lesson</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Word</a></li>
                    <li><a data-toggle="tab" href="#tab-3">Phrase</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <p>
                            	<strong>Bước 1: </strong>Chọn bài học
                            	<img class="m-t img-responsive" src="/public/assets/images/A1.png" />
                            </p>
                            <p>
                                <strong>Bước 2: </strong>Ở Tab write, các bạn lắng nghe cuộc hội thoại sau đó điền vào theo đúng thứ tự.
                                <img class="m-t img-responsive" src="/public/assets/images/A2.png" />
                            </p>
                            <p>
                                <strong>Bước 3: </strong>Sau khi hoàn tất, click “check” để kiểm tra và “show result” để xem đáp án.
                                <img class="m-t img-responsive" src="/public/assets/images/A3.png" />
                            </p>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <strong>Tips:</strong>
                            <p>
                                Ở Show 10 Entries, các bạn có thể chọn 10, 25, 50, 100 từ để hiển thị 1 lần trong bảng.
                                <img class="m-t img-responsive" src="/public/assets/images/B1.png" />
                            </p>
                            <p>
                                Ở ô Search, các bạn có thể tra từ vựng nhanh.
                                <img class="m-t img-responsive" src="/public/assets/images/B2.png" />
                            </p>
                            <p>
                                Click vào nút play (hình tam giác) trong Audio để nghe.
                                <img class="m-t img-responsive" src="/public/assets/images/B3.png" />
                            </p>
                            <p>
                                Click vào On/Off bên mục Select để chọn từ, sau đó click vào “Add to Storage” để lưu trữ các từ. Các bạn có thể xem lại những  từ đã chọn bằng cách click vào “Go to Storage”.
                                <img class="m-t img-responsive" src="/public/assets/images/B4.png" />
                                <br>
                                <img class="m-t img-responsive" src="/public/assets/images/B5.png" />
                                <br>
                                <img class="m-t img-responsive" src="/public/assets/images/B6.png" />
                            </p>
                            <p>
                                Trong Storage, Click nút "LEARN WORD" để học tất cả các từ có trong kho của bạn .Sau khi học xong các từ, các bạn có thể click On/Off và “Remove Word” để loại bỏ các từ ra khỏi Storage. 
                                <img class="m-t img-responsive" src="/public/assets/images/B7.png" />
                            </p>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
	                	<div class="panel-body">
	                		<strong>Tips:</strong>
                            <p>
                                Ở Show 10 Entries, các bạn có thể chọn 10, 25, 50, 100 câu để hiển thị 1 lần trong bảng.
                                <img class="m-t img-responsive" src="/public/assets/images/C1.png" />
                            </p>
                            <p>
                                Ở ô Search, các bạn có thể tra câu nhanh.
                                <img class="m-t img-responsive" src="/public/assets/images/C2.png" />
                            </p>
                            <p>
                                Ngoài ra, các bạn có thêm lựa chọn lọc câu (Filter by), để tra câu trong lĩnh vực bạn đang cần quan tâm.
                                <img class="m-t img-responsive" src="/public/assets/images/C3.png" />
                            </p>
                            <p>
                               Click vào nút play (hình tam giác) trong Audio để nghe.
                                <img class="m-t img-responsive" src="/public/assets/images/C4.png" />
                            </p>
                            <p>
                                Click vào On/Off bên mục Select để chọn câu, sau đó click vào “Add to Storage” để lưu trữ các câu. Các bạn có thể xem lại những  câu đã chọn bằng cách click vào “Go to Storage”.
                                <br>
                                <img class="m-t img-responsive" src="/public/assets/images/C5.png" />
                                <br>
                                <img class="m-t img-responsive" src="/public/assets/images/C6.png" />
                            </p>
                            <p>
                                Trong Storage, Click nút "LEARN PHRASE" để học tất cả các câu có trong kho của bạn .Sau khi học xong các câu, các bạn có thể click On/Off và “Remove Word” để loại bỏ các từ ra khỏi Storage. 
                                <img class="m-t img-responsive" src="/public/assets/images/C7.png" />
                            </p>
	                	</div>
	                </div>
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection