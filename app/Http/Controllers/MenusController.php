<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopsRequest;
use App\Models\Shops;

class MenusController extends Controller
{
    // 메뉴 리스트를 보여주는 로직
    public function index(Shops $shop)
    {
        $menus = $shop->menus;
        return view('menus.index', compact('menus', 'shop'));
    }

    // 메뉴를 추가하는 폼을 표시하는 로직
    public function create(Shops $shop)
    {
        return view('menus.create', compact('shop'));
    }

    // 메뉴를 추가하는 로직
    public function store(Shops $shop, Request $request)
    {
        \Log::info('메뉴를 추가합니다.');
        \Log::info('request: ' . $request);

        $shop->menus()->create([
            'menu_name' => $request->menu_name,
            'menu_price' => $request->menu_price,
            'menu_description' => $request->menu_description ?? '',
        ]);

        return redirect()->route('shops.menus.index', $shop)->with('success', '메뉴가 추가되었습니다.');

    }

    // 메뉴를 조회하는
    public function show(Shops $shop, $menu_idx)
    {
        $menu = $shop->menus()->where('menu_idx', $menu_idx)->first();
        return view('menus.show', compact('menu', 'shop'));
    }

    // 메뉴 수정 폼을 표시하는 로직
    public function edit(Shops $shop, $menu_idx)
    {
        $menu = $shop->menus()->where('menu_idx', $menu_idx)->first();
        return view('menus.edit', compact('menu', 'shop'));
    }

    // 메뉴를 수정하는 로직
    public function update(Shops $shop, Request $request, $menu_idx)
    {
        \Log::info('메뉴를 수정합니다.');
        \Log::info('request: ' . $request);

        $menu = $shop->menus()->where('menu_idx', $menu_idx)->first();
        $menu->update([
            'menu_name' => $request->menu_name,
            'menu_price' => $request->menu_price,
            'menu_description' => $request->menu_description ?? '',
        ]);

        return redirect()->route('shops.menus.index', $shop)->with('success', '메뉴가 수정되었습니다.');
    }

    // 메뉴를 삭제하는 로직
    public function destroy(Shops $shop, $menu_idx)
    {
        \Log::info('메뉴를 삭제합니다.');

        $menu = $shop->menus()->where('menu_idx', $menu_idx)->first();
        $menu->delete();

        return redirect()->route('shops.menus.index', $shop)->with('success', '메뉴가 삭제되었습니다.');
    }
}
