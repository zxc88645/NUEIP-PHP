@extends('adminlte::page')
 
@section('title', 'Account list')

@section('content_header')
    <h1>{{ __('Account list') }}</h1>    
@stop

@section('plugins.Datatables', true)


@section('content')
    {{-- Card組件 --}}
    <div class="card">
        <div class="car-body">
            <form id="delete-form" method="POST">
                {{-- adminlte.DataTables 組件  --}}
                <x-adminlte-datatable id="table1" with-buttons :heads="[
                    'ids',
                    'id',
                    'account',
                    'name',
                    'gender',
                    'birthday',
                    'email',
                    'note',
                    ['label' => 'Actions',  'orderable' => false]
                    ]">
                    <x-adminlte-button type="button" class="bg-danger" id="batchDestroy-btn" label="Batch Destroy User" data-toggle="modal" data-target="#modalbatchDestroyUser"/>
                    <x-slot name="action-column">
                        <th style="width: 80px">Actions</th>
                    </x-slot>
                    {{-- 循環輸出數據 --}}
                    @foreach($accounts as $account)
                    <tr>
                        <td><input type="checkbox" name="ids[]" class="iCheck-helper" value="{{ $account->id }}"></td>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->account }}</td>
                        <td>{{ $account->name }}</td>
                        {{-- 16. 資料處理 性別：顯示時為 男/女 ，資料庫儲存為 1/0 --}}
                        <td>{{ $account->gender ? '男生' : '女生' }}</td>
                        {{-- 16. 資料處理 生日：顯示時格式 2019年2月15日 ，資料庫儲存格式為 2019-02-15 --}}
                        <td>{{ Carbon\Carbon::parse($account->birthday)->format('Y年m月d日') }}</td>
                        <td>{{ $account->email }}</td>
                        <td>{{ $account->note }}</td>
                        <td>
                            {{-- 查看詳細 --}}
                            <x-adminlte-button type="button" class="bg-teal" id="show-btn" data-id="{{ $account->id }}"  label="Show User" data-toggle="modal" data-target="#modalShowUser"/>
                            {{-- 編輯用戶 --}}
                            <button type="button" class="btn btn-warning" id="edit-btn" data-id="{{ $account->id }}">{{ __('Edit') }}</button>
                            {{-- 删除用戶 --}}
                            <button type="button" class="btn btn-danger" id="delete-btn" data-id="{{ $account->id }}">{{ __('Delete') }}</button>
                        </td>
                    </tr>
                    @endforeach
                </x-adminlte-datatable>
            </form>
        </div>
    </div>

    {{-- Add User Button --}}
    <x-adminlte-button label="Add User" data-toggle="modal" data-target="#modalAddUser" class="bg-teal"/>



    
    {{-- show User modal --}}
    <x-adminlte-modal id="modalShowUser" title="show User" size="lg" theme="teal" icon="fas fa-user" v-centered static-backdrop scrollable>
        <div id="alertContainer"></div> {{-- error alert --}}
            <form id="formShowUser">
                <div class="form-group">
                    <label for="account">帳號：</label>
                    <input type="text" name="account" id="account" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="name">姓名：</label>
                    <input type="text" name="name" id="name" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="gender">性別：</label>
                    <input type="text" name="gender" id="gender" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="birthday">生日：</label>
                    <input type="text" name="birthday" id="birthday" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="email">信箱：</label>
                    <input type="email" name="email" id="email" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="note">備註：</label>
                    <textarea name="note" id="note" class="form-control" readonly></textarea>
                </div>
                <!-- 其他表單元素 -->
            </form>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Close" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>

    {{-- Edit user modal   12. 使用 Bootstrap --}}
    <div class="modal fade" id="user-edit-modal" tabindex="-1" role="dialog" aria-labelledby="user-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="user-edit-form" method="POST">
                    <div id="alertContainer"></div> {{-- error alert --}}
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="user-modal-label"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="account">帳號：</label>
                            <input type="hidden" name="id" id="id" class="form-control" required>
                            <input type="text" name="account" id="account" class="form-control" required readonly>
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
                            <input type="email" name="email" id="email" class="form-control" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="note">備註：</label>
                            <textarea name="note" id="note" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="button-edit-confirm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    {{-- Add User modal --}}
    <x-adminlte-modal id="modalAddUser" title="Add User" size="lg" theme="teal"
    icon="fas fa-user-plus" v-centered static-backdrop scrollable>
        <div id="alertContainer"></div> {{-- error alert --}}
        <form id="formAddUser">
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
                <label for="note">備註：</label>
                <textarea name="note" id="note" class="form-control"></textarea>
            </div>
            <!-- 其他表單元素 -->
        </form>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Add" onclick="addUser()"/>
            <x-adminlte-button theme="danger" label="Close" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>


    {{-- delete button Confirm modal  --}}
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-modal-label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Confirmation message -->
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-danger delete-confirm">{{ __('Confirm') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- batch Destroy button Confirm modal  --}}
    <x-adminlte-modal id="modalbatchDestroyUser" title="batch Destroy User" size="lg" theme="teal"
    icon="fas fa-user-times" v-centered static-backdrop scrollable>
        <div id="alertContainer"></div> {{-- error alert --}}
        <div class="form-group">
                <label for="account">{{ __('確定要刪除嗎') }}</label>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('Confirm') }}" onclick="batchDestroyUser()"/>
            <x-adminlte-button theme="danger" label="Close" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>




@endsection 




@push('js')
<script>


    {{-- 顯示特定使用者的詳細資訊 --}}
    $(document).on('click', '#show-btn', function(event) {
        var $button = $(this);
        var title = '{{ __('Show') }}'; // 修改標題
        var id = $button.data('id');
        var url = '{{ route("accountAPI.show", ":id") }}';
        url = url.replace(':id', id);

        var message = '2'; // 修改消息

        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                var account = response;

                dateString = account.gender;
                date = new Date(dateString);
                year = date.getFullYear().toString().padStart(4, '0');
                month = (date.getMonth() + 1).toString().padStart(2, '0');
                day = date.getDate().toString().padStart(2, '0');
                formattedDate = `${year}年${month}月${day}日`;

                var form = $('#formShowUser');
                form.find('#account').val(account.account);
                form.find('#name').val(account.name)
                form.find('#gender').val( formattedDate  )
                form.find('#birthday').val(account.birthday)
                form.find('#email').val(account.email)
                form.find('#note').val(account.note)


            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

    });
   

    
    {{-- 編輯用戶 --}}
    $(document).on('click', '#edit-btn', function(event) {
        var buttonId = $(this).attr('data-id');
        console.log(buttonId);
        var button = this;
        var title = '{{ __('Edit') }}'; // 修改標題
        $('#user-edit-modal .modal-title').text(title);
        $('#user-edit-modal').modal('show');

        var id = buttonId
        var url = '{{ route("accountAPI.show", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                // Reload page after successful delete

                var account = response;
                var form = $('#user-edit-form');
                form.find('#id').val(account.id);
                form.find('#account').val(account.account);
                form.find('#name').val(account.name)
                form.find('#gender').val(account.gender)
                form.find('#birthday').val(account.birthday)
                form.find('#email').val(account.email)
                form.find('#note').val(account.note)


            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

    });
    
    $('#user-edit-modal #button-edit-confirm').on('click', function() {
        id = $('#user-edit-modal #id').val();
        var apiUrl = '{{ route("accountAPI.update" , ":id") }}';
        apiUrl = apiUrl.replace(':id', id);
        $.ajax({
            url: apiUrl,
            type: 'PUT',
            data: $('#user-edit-form').serialize(),
            success: function(response) {
                // 在此處處理 AJAX 回應
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // 在此處處理 AJAX 錯誤
                var message = '編輯用戶失敗：' + jqXHR.responseJSON['message'];
                var alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + message +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>';
                $('#user-edit-modal #alertContainer').empty().append(alert);
                }
        });
    });

    {{-- addUser Ajax --}}
    function addUser() {
        var apiUrl = '{{ route("accountAPI.store") }}';
        $.ajax({
            url: apiUrl,
            type: 'POST',
            data: $('#formAddUser').serialize(),
            success: function(response) {
                // 在此處處理 AJAX 回應
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // 在此處處理 AJAX 錯誤
                var message = '新增用戶失敗：' + jqXHR.responseJSON['message'];
                var alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + message +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>';
                $('#modalAddUser #alertContainer').empty().append(alert);
                }
        });
    }

    {{-- Delete Ajax --}}
    $(document).on('click', '#delete-btn', function(event) {
        var button = $(this);
        var title = '{{ __('Delete') }}'; // 修改標題
        var message = 'Are you sure you want to delete this account?'; // 修改消息

        $('#confirm-modal .modal-title').text(title);
        $('#confirm-modal .modal-body').html(message);

        $('#confirm-modal').modal('show');

        $('#confirm-modal button.delete-confirm').on('click', function() {

        var id = button.data('id');
        var url = '{{ route("accountAPI.destroy", ":id") }}';
        url = url.replace(':id', id);
        
        // 15. AJAX使用 RESTful style傳送資料，並且回傳支援 HTTP Status Code
        $.ajax({
            url: url,
            method: 'DELETE',
            success: function (response) {
                // Reload page after successful delete
                location.reload();
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        });
    });


    {{-- addUser Ajax --}}
    function batchDestroyUser() {
        var apiUrl = '{{ route("accountAPI.batchDestroy") }}';

        var ids = $('input[name="ids[]"]:checked').map(function() {
            return $(this).val();
       }).get();


        $.ajax({
            url: apiUrl,
            type: 'DELETE',
            data: {ids: ids},
            success: function(response) {
                // 在此處處理 AJAX 回應
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // 在此處處理 AJAX 錯誤
                var message = '批次刪除失敗';
                var alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + message +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>';
                $('#modalbatchDestroyUser #alertContainer').empty().append(alert);
                }
        });
    }

</script>

@endpush

