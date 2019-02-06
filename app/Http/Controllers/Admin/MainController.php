<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodImage;
use App\Models\FoodLocation;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    const IS_CREATE = 'Create';
    const IS_UPDATE = 'Update';
    const IS_DELETE = 'Delete';

    /**
     * MainController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return redirect()->route('get.food');
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
        foreach ($results as $key => $value) {
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
        if ($result) {
            return $result->toArray();
        } else {
            return [];
        }
    }

    public function menuCreate(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $result = FoodMenu::insert($data);
            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }
            $this->setMessage($result, self::IS_CREATE);
            return redirect()->route('get.menu');
        } catch (Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Create error');
        }
    }

    public function menuUpdate(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $result = FoodMenu::where('id', $id)->update($data);
            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }
            $this->setMessage($result, self::IS_UPDATE);
            return redirect()->route('get.menu');
        } catch (Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Update error');
        }
    }

    public function menuDelete($id)
    {
        try {
            DB::beginTransaction();
            $result = FoodMenu::where('id', $id)->delete();
            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }
            $this->setMessage($result, self::IS_DELETE);
            return redirect()->route('get.menu');
        } catch (Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Delete error');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function food(Request $request)
    {
        $data = $request->all();
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
        $query = Food::select(
                'food.id',
                'food.name',
                'food.description',
                'food_image.name as image_name',
                'food_image.alt',
                'food_menu.name as menu_name',
                'food_location.address'
            )
            ->leftJoin('food_image', 'food.id', '=', 'food_image.food_id')
            ->join('food_menu', 'food.menu_id', '=', 'food_menu.id')
            ->leftJoin('food_location', 'food.id', '=', 'food_location.food_id');

        if(isset($data['search'])) {
            if(isset($data['name'])) {
                $query->where('food.name', 'like', "%".$data['name']."%");
            }

            if(isset($data['menu_id'])) {
                $query->where('food.menu_id', $data['menu_id']);
            }
        }

        $foods = $query->orderBy('food_menu.id')
            ->orderBy('food.id')
            ->paginate(50);
        return view('admin.pages.food', compact('listMenu', 'foods'));
    }

    public function foodDetail($id)
    {
        $result = Food::select(
            'food.id',
            'food.name',
            'food.description',
            'food_image.name as image_name',
            'food_image.alt',
            'food_menu.name as menu_name',
            'food_menu.id as menu_id',
            'food_location.address'
        )
            ->leftJoin('food_image', 'food.id', '=', 'food_image.food_id')
            ->join('food_menu', 'food.menu_id', '=', 'food_menu.id')
            ->leftJoin('food_location', 'food.id', '=', 'food_location.food_id')
            ->where('food.id', $id)
            ->first();

        if ($result) {
            return $result->toArray();
        } else {
            return [];
        }
    }

    public function foodCreate(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            if (isset($data['image'])) {
                $file = $data['image'];
                unset($data['image']);
                $allowed = array('png', 'jpg', 'jpeg');
                $ext = strtolower($file->getClientOriginalExtension());
                if (!in_array($ext, $allowed)) {
                    return redirect()->back()->with('error', 'File upload must be jpg or png file!');
                }
                if ($file->getSize() > 20000000) {
                    return redirect()->back()->with('error', 'File upload must lower than 200000B!');
                }

            }

            if (isset($data['location'])) {
                $location = $data['location'];
                unset($data['location']);
            }

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['author'] = auth()->user()->username;
            $result = Food::insertGetId($data);
            $foodId = $result;
            // Update image to base food
            if ($result && isset($file)) {
                $newName = uploadImage($result, $file, 'food');
                $dataImage['food_id'] = $foodId;
                $dataImage['alt'] = $data['name'];
                $dataImage['name'] = $newName;
                $dataImage['created_at'] = date('Y-m-d H:i:s');
                $dataImage['updated_at'] = date('Y-m-d H:i:s');
                $result = FoodImage::insert($dataImage);
            }

            // Update location to base food
            if($result && isset($location)) {
                $dataLocation['food_id'] = $foodId;
                $dataLocation['address'] = $location;
                $dataLocation['description'] = $data['description'];
                $dataLocation['created_at'] = date('Y-m-d H:i:s');
                $dataLocation['updated_at'] = date('Y-m-d H:i:s');
                $result = FoodLocation::insert($dataLocation);
            }

            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }

            $this->setMessage($result, self::IS_CREATE);
            return redirect()->route('get.food');
        } catch (Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Create error');
        }
    }

    public function foodUpdate(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            if (isset($data['image'])) {
                $file = $data['image'];
                unset($data['image']);
                $allowed = array('png', 'jpg', 'jpeg');
                $ext = strtolower($file->getClientOriginalExtension());
                if (!in_array($ext, $allowed)) {
                    return redirect()->back()->with('error', 'File upload must be jpg or png file!');
                }
                if ($file->getSize() > 20000000) {
                    return redirect()->back()->with('error', 'File upload must lower than 200000B!');
                }

            }

            if (isset($data['location'])) {
                $location = $data['location'];
                unset($data['location']);
            }

            $data['updated_at'] = date('Y-m-d H:i:s');
            $result = Food::where('id', $id)->update($data);

            // Update image to base food
            if ($result && isset($file)) {
                $newName = uploadImage($id, $file, 'food');
                $dataImage['food_id'] = $id;
                $dataImage['alt'] = $data['name'];
                $dataImage['name'] = $newName;
                $dataImage['updated_at'] = date('Y-m-d H:i:s');
                $check = FoodImage::where('food_id', $id)->first();
                if($check) {
                    FoodImage::where('food_id', $id)->update($dataImage);
                } else {
                    $dataImage['created_at'] = date('Y-m-d H:i:s');
                    $result = FoodImage::insert($dataImage);
                }
            }

            // Update location to base food
            if($result && isset($location)) {
                $dataLocation['food_id'] = $id;
                $dataLocation['address'] = $location;
                $dataLocation['description'] = $data['description'];
                $dataLocation['updated_at'] = date('Y-m-d H:i:s');
                $check = FoodLocation::where('food_id', $id)->first();
                if($check) {
                    FoodLocation::where('food_id', $id)->update($dataLocation);
                } else {
                    $dataLocation['created_at'] = date('Y-m-d H:i:s');
                    $result = FoodLocation::insert($dataLocation);
                }
            }

            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }

            $this->setMessage($result, self::IS_UPDATE);
            return redirect()->route('get.food');
        } catch (Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Update error');
        }
    }

    public function foodDelete($id)
    {
        try {
            DB::beginTransaction();
            $result = Food::where('id', $id)->delete();
            if ($result) {
                $check = FoodImage::where('food_id', $id)->first();
                if ($check) {
                    $result = $check->delete();
                }

                if ($result) {
                    $check = FoodLocation::where('food_id', $id)->first();
                    if ($check) {
                        $result = $check->delete();
                    }
                }
            }
            if ($result) {
                DB::commit();
            } else {
                DB::rollBack();
            }
            $this->setMessage($result, self::IS_DELETE);
            return redirect()->route('get.food');
        } catch (Exception $e) {
            DB::rollBack();
            logger(__METHOD__ . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Delete error');
        }
    }

    /**
     * @param $result
     * @param $type
     */
    private function setMessage($result, $type)
    {
        if ($result) {
            session()->flash('success', $type . ' success');
        } else {
            session()->flash('error', $type . ' error');
        }
    }
}
