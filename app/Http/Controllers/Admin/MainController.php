<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodMenu;

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
        return view('admin.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function food()
    {
        return view('admin.dashboard');
    }
}
