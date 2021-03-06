@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('ThongBao'))
                        <div class="alert alert-success">
                            {{session('ThongBao')}}
                        </div>
                    @elseif(session('Loi'))
                        <div class="alert alert-danger">
                            {{session('Loi')}}
                        </div>
                    @endif
                    <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên slide</label>
                            <input class="form-control" name="Ten" placeholder="Nhập tên slide" />
                        </div>
                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input type="file" name="Hinh" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control ckeditor" rows="5" id="demo" name="NoiDung"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link slide</label>
                            <input class="form-control" name="link" placeholder="Nhập đường dẫn của slide" />
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @endsection
