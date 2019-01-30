<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodMenu;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * MainController constructor.
     */
    public function __construct() {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = FoodMenu::all()->toArray();
        $menus = [];
        foreach($results as $key => $value) {
            if ($value['parent_id'] == 0) {
                $menus[$value['id']] = $value;
            } elseif (array_key_exists($value['parent_id'], $menus)) {
                $menus[$value['parent_id']]['child'][$value['id']] = $value;
            } else {
                $keyP = $results[$value['parent_id']]['parent_id'];
                if ($keyP != 0) {
                    $menus[$keyP]['child'][$value['parent_id']]['child'][$value['id']] = $value;
                }
            }
        }
        return view('admin.dashboard', compact('menus'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu()
    {
        $results = FoodMenu::all()->toArray();
        $menus = [];
        foreach($results as $key => $value) {
            if ($value['parent_id'] == 0) {
                $menus[$value['id']] = $value;
            } elseif (array_key_exists($value['parent_id'], $menus)) {
                $menus[$value['parent_id']]['child'][$value['id']] = $value;
            } else {
                $keyP = $results[$value['parent_id']]['parent_id'];
                if ($keyP != 0) {
                    $menus[$keyP]['child'][$value['parent_id']]['child'][$value['id']] = $value;
                }
            }
        }
        $listMenu = [0 => 'Menu cha'];
        $existMenu = FoodMenu::where('parent_id', 0)->pluck('name', 'id')->toArray();
        $listMenu = array_merge($listMenu, $existMenu);
        return view('admin.pages.menu', compact('menus', 'listMenu'));
    }

    public function menuDetail($id)
    {
        $result = FoodMenu::findOrFail($id);
        if($result) {
            return $result->toArray();
        } else {
            return [];
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function food()
    {
        $results = FoodMenu::all()->toArray();
        $menus = [];
        foreach($results as $key => $value) {
            if ($value['parent_id'] == 0) {
                $menus[$value['id']] = $value;
            } elseif (array_key_exists($value['parent_id'], $menus)) {
                $menus[$value['parent_id']]['child'][$value['id']] = $value;
            } else {
                $keyP = $results[$value['parent_id']]['parent_id'];
                if ($keyP != 0) {
                    $menus[$keyP]['child'][$value['parent_id']]['child'][$value['id']] = $value;
                }
            }
        }
        return view('admin.pages.food', compact('menus'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function location()
    {
        $results = FoodMenu::all()->toArray();
        $menus = [];
        foreach($results as $key => $value) {
            if ($value['parent_id'] == 0) {
                $menus[$value['id']] = $value;
            } elseif (array_key_exists($value['parent_id'], $menus)) {
                $menus[$value['parent_id']]['child'][$value['id']] = $value;
            } else {
                $keyP = $results[$value['parent_id']]['parent_id'];
                if ($keyP != 0) {
                    $menus[$keyP]['child'][$value['parent_id']]['child'][$value['id']] = $value;
                }
            }
        }
        return view('admin.pages.location', compact('menus'));
    }
}
