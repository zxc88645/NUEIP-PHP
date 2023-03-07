<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index()
    {
        $accounts = $this->accountService->index();
        return $accounts;
    }

    public function create()
    {
        return $this->accountService->create();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'account' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
            'name' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email',
            'note' => 'nullable',
        ]);

        $account = $this->accountService->store($validatedData);

        return response()->json([
            'message' => 'Account created successfully.',
            'data' => $account
        ], 201);
    }

    public function show($id)
    {
        $account = $this->accountService->show($id);
        return $account;
    }

    public function edit($id)
    {
        $account = $this->accountService->edit($id);
        return $account;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'account' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
            'name' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email',
            'note' => 'nullable',
        ]);

        $account = $this->accountService->update($validatedData, $id);

        return response()->json([
            'message' => 'Account updated successfully.',
            'data' => $account
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $status = $this->accountService->destroy($id);

            if ($status) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Account deleted.'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete account.'
                ], 500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'ERROR'
            ], 404);
        }
    }

    public function batchDestroy(Request $request)
    {
        $validatedData = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer',
        ]);

        $status = $this->accountService->batchDestroy($validatedData['ids']);

        if ($status) {
            return response()->json([
                'status' => 'success',
                'message' => 'Accounts deleted.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete accounts.',
            ], 500);
        }
    }

}