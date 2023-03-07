@extends('adminlte::page')

@section('title', 'Edit Account')

@section('content_header')
    <h1>{{ __('Edit Account') }}</h1>
@stop

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>编辑資料</h2>
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

                <form id="edit-form" method="POST" action="{{ route('account.update', $account->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="account">帳號：</label>
                        <input type="text" name="account" id="account" class="form-control" value="{{ $account->account }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">姓名：</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $account->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">性別：</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">請選擇</option>
                            <option value="1" {{ $account->gender === 1 ? 'selected' : '' }}>男</option>
                            <option value="0" {{ $account->gender === 0 ? 'selected' : '' }}>女</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="birthday">生日：</label>
                        <input type="date" name="birthday" id="birthday" class="form-control" value="{{ $account->birthday }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">信箱：</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $account->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="note">備註：</label>
                        <textarea name="note" id="note" class="form-control">{{ $account->note }}</textarea>
                    </div>

                    <button type="button" id="update-btn" class="btn btn-primary">更新</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#update-btn').click(function() {
            $.ajax({
                //url: url ,
                url: '{{ route('account.update', $account->id) }}',
                method: "PUT",
                data: $('#edit-form').serialize(),
                success: function(response) {
                    alert('更新成功');
                },
                error: function(xhr, status, error) {
                    alert('更新失敗');
                }
            });
        });
    });
</script>
@endpush