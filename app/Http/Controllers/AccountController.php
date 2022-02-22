<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateAccount;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function __construct(protected AccountService $service)
    {
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = $this->service->index();

        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateAccount;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAccount $request)
    {
        $this->service->store($request->all());

        return response()->json(['message' => 'Cadastrado com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $account = $this->service->show($account->uuid);

        return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateAccount;  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateAccount $request, Account $account)
    {
        $this->service->update($account, $request->all());

        return response()->json(['message' => 'Conta atualizada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $this->service->destroy($account->uuid);

        return response()->json(['message' => 'Deletada com sucesso'], 204);
    }
}
