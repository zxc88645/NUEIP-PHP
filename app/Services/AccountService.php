<?php

namespace App\Services;

use App\Models\AccountInfo;

/**
 * AccountService 類別提供管理帳號的相關方法。
 */
class AccountService
{
    /**
     * 取得所有帳號資料。
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $accounts = AccountInfo::orderBy('id', 'asc')->get();
        return view('account.index', compact('accounts'));
    }
    /**
     * 取得新增帳號的表單頁面。
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('account.create');
    }
    /**
     * 新增帳號資料。
     *
     * @param  array  $validatedData  經過驗證的表單資料
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $validatedData)
    {
        $account = AccountInfo::create($validatedData);
        return $account;
    }
    /**
     * 取得指定帳號的資料。
     *
     * @param  int  $id  帳號 ID
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function show($id)
    {
        $account = AccountInfo::find($id);
        return $account;
    }
    /**
     * 取得編輯指定帳號的表單頁面。
     *
     * @param  int  $id  帳號 ID
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $account = AccountInfo::findOrFail($id);
        return view('account.edit', compact('account'));
    }
    /**
     * 更新指定帳號的資料。
     *
     * @param  array  $validatedData  經過驗證的表單資料
     * @param  int  $id  帳號 ID
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update(array $validatedData, $id)
    {
        $account = AccountInfo::findOrFail($id);
        $status = $account->update($validatedData);
        return $account;
    }

    /**
     * 刪除指定帳號的資料。
     *
     * @param  int  $id  帳號 ID
     * @return bool
     */
    public function destroy($id)
    {
        $status = AccountInfo::findOrFail($id)->delete();
        return $status;
    }

    /**
     * 批量刪除用戶資料
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDestroy(array $ids)
    {
        AccountInfo::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Selected accounts have been deleted.']);
    }
}