<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopsRequest;
use App\Models\Shops;

class ShopsController extends Controller
{
    // 상점 리스트를 보여주는 로직
    public function index()
    {
        $shops = Shops::all();
        return view('shops.index', compact('shops'));
    }

    // 상점을 추가하는 폼을 표시하는 로직
    public function create()
    {
        return view('shops.create');
    }

    // 상점을 추가하는 로직
    public function store(ShopsRequest $request)
    {
        \Log::info('상점을 추가합니다.');
        \Log::info('request: ' . $request);

        $shops = Shops::create([
            'user_idx' => auth()->user()->idx,
            'name' => $request->name,
            'address' => $request->address,
            'is_all_day' => $request->is_all_day,
            'opened_at' => $request->opened_at,
            'closed_at' => $request->closed_at,
        ]);

        return redirect()->route('shops.index')->with('success', '상점이 추가되었습니다.');

    }

    // 상점을 조회하는
    public function show(Shops $shops)
    {
        return view('shops.show', compact('shops'));
    }

    // 상점 수정 폼을 표시하는 로직
    public function edit(Shops $shops)
    {
        return view('shops.edit', compact('shops'));
    }

    // 상점을 수정하는 로직
    public function update(ShopsRequest $request, Shops $shops)
    {
        \Log::info('상점을 수정합니다.');
        \Log::info('request: ' . $request);

        $shops->update([
            'name' => $request->name,
            'is_all_day' => $request->is_all_day,
            'opened_at' => $request->opened_at,
            'closed_at' => $request->closed_at,
            'address' => $request->address,
        ]);

        return redirect()->route('shops.index')->with('success', '상점이 수정되었습니다.');
    }

    // 상점을 삭제하는 로직
    public function destroy(Shops $shops)
    {
        \Log::info('상점을 삭제합니다.');
        \Log::info('shops: ' . $shops);

        $shops->delete();

        return redirect()->route('shops.index')->with('success', '상점이 삭제되었습니다.');
    }

}
