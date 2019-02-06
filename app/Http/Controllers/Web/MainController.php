<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Food;
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
        $menus = FoodMenu::select('id', 'name', 'parent_id')->get()->toArray();
        $listMenu = [];
        foreach ($menus as $key => $value) {
            if ($value['parent_id'] == 0) {
                $listMenu[$value['id']] = $value;
            } elseif (array_key_exists($value['parent_id'], $listMenu)) {
                $listMenu[$value['parent_id']]['child'][$value['id']] = $value;
            } else {
                $keyP = $menus[$value['parent_id']]['parent_id'];
                if ($keyP != 0) {
                    $listMenu[$keyP]['child'][$value['parent_id']]['child'][$value['id']] = $value;
                }
            }
        }

        $foods = Food::select(
            'food.id',
            'food.menu_id',
            'food.name',
//            'food.description',
//            'food_image.name as image_name',
//            'food_image.alt',
//            'food_menu.name as menu_name',
            'food_location.address'
        )
            ->leftJoin('food_image', 'food.id', '=', 'food_image.food_id')
            ->join('food_menu', 'food.menu_id', '=', 'food_menu.id')
            ->leftJoin('food_location', 'food.id', '=', 'food_location.food_id')
            ->orderBy('food_menu.id')
            ->orderBy('food.id')
            ->get()
            ->toArray();

        $eating = json_encode($foods);
        return view('web.home', compact('eating', 'listMenu'));
    }
}
