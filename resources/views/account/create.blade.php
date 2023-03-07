@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <h2>新增帳號</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('account.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="account">帳號：</label>
                        <input type="text" name="account" id="account" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="name">姓名：</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">性別：</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">請選擇</option>
                            <option value="1">男</option>
                            <option value="0">女</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="birthday">生日：</label>
                        <input type="date" name="birthday" id="birthday" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">信箱：</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="remark">備註：</label>
                        <textarea name="remark" id="remark" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">新增</button>
                </form>
            </div>
        </div>
    </div>
@endsection
