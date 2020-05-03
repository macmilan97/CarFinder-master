<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePickUpRequest;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\Expert;
use App\Models\Request as CarRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCheckCarRequest;
use Session;
use DB;
class CarPickUpController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $carTypes = CarType::orderBy('title', 'ASC')->get();
        $carMakes = CarMake::orderBy('title', 'ASC')->get();
        return view('car.pick-up.index', [
            'carTypes' => $carTypes,
            'carMakes' => $carMakes,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCarModels($id)
    {
        $cars = CarModel::where('car_make_id', '=', $id)->get();
        $models = [];
        foreach ($cars as $car)
        {
            $array = [
                'id' => $car->id,
                'title' => $car->title,
            ];
            array_push($models,$array );

        }
        return \Response::json($models, 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param StorePickUpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_inputs(StorePickUpRequest $request)
    {
        $carModel = CarModel::where('id', '=', $request['car_model'])->firstOrFail();
        $carMake = CarMake::where('id', '=', $request['car_make'])->firstOrFail();
        $carType = CarType::where('id', '=', $request['car_type'])->firstOrFail();
        $car_info = [
            'car-type' => $carType->title,
            'car-make' => $carMake->title,
            'car-model' => $carModel->title,
            'status-label' => $request['status'],
            'body' => $carType->title,
            'kpp' => $request['kpp'],
            'mileage' => $request['mileage'],
            'drive'  => $request['drive'],
            'engine'  => $request['engine'],
            'rudders'  => $request['rudder'],
            'colors'  => $request['color'],
            'volume' => $request['volume'],
            'before' => $request['before'],
            'after' => $request['after'],
            'comment' => $request['comment'],
            'price' => $request['amount'],
        ];

        Session::put('pick-up-info', $car_info);
        return redirect()->route('pick-up-user-info');
    }

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function get_user_info()
    {
        $checkInputInfo = Session::get('pick-up-info');
        if ($checkInputInfo == null) {
            return redirect()->route('pick-up');
        }
        return view('car.pick-up.user-info');
    }

    public function save_user_info(StoreCheckCarRequest $request)
    {
        $user_info = [
            'name' => $request['name'],
            'phone' => $request['phone'],
        ];
        Session::put('pick-up-user', $user_info);
        return redirect()->route('pick-up-experts');
    }

    public function experts()
    {
        $city = Session::get('user-city');
        $sort_id = request()->request->get('sort_id');
        $checkUserInfo = Session::get('pick-up-user');
        if ($checkUserInfo == null) {
            return redirect()->route('pick-up-user-info');
        }
        if ($sort_id) {
            $sort_type = (($sort_id) == 1) ? 'min' : 'max';
            if ($city) {
                $experts = Expert::select('experts.*')
                    ->leftJoin('expert_services', function ($q) use ($sort_type) {
                        $q->on('expert_services.expert_id', '=', 'experts.id')
                            ->on('expert_services.price', '=',
                                DB::raw('(select ' . $sort_type . '(price) from expert_services where expert_id = experts.id)'
                                ));
                    })
                    ->where('experts.city_id', '=', $city)
                    ->where('experts.status', '=', 'ACTIVE')
                    ->paginate(8);
            } else {
                $experts = Expert::select('experts.*')
                    ->leftJoin('expert_services', function ($q) use ($sort_type) {
                        $q->on('expert_services.expert_id', '=', 'experts.id')
                            ->on('expert_services.price', '=',
                                DB::raw('(select ' . $sort_type . '(price) from expert_services where expert_id = experts.id)'
                                ));
                    })
                    ->where('experts.status', '=', 'ACTIVE')
                    ->paginate(8);
            }
        } else {
            if ($city) {
                $experts = Expert::where('city_id', '=', $city)
                    ->where('status', '=', 'ACTIVE')
                    ->paginate(8);
            } else {
                $experts = Expert::where('status', '=', 'ACTIVE')->paginate(8);
            }
        }
        return view('car.pick-up.experts', [
            'experts' => $experts,
            'sort_id'   => $sort_id
        ]);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function expert_show ($id)
    {
        $route  = route('pick-up-expert-select');
        $expert = Expert::where('id', '=',$id)
            ->where('status', '=', 'ACTIVE')
            ->firstOrFail();
        return view('car.expert-info', [
            'expert' => $expert,
            'route'  => $route
        ]);
    }

    public function expert_select(Request $request)
    {
        $user_info = Session::get('pick-up-user');
        $expert_id = $request['expert_id'];
        $order = Session::get('pick-up-info');
        $order = json_encode($order);
        $request = new CarRequest();
        $request->type = CarRequest::TYPE_PICK_UP;
        $request->name = $user_info['name'];
        $request->phone = $user_info['phone'];
        $request->expert_id = $expert_id;
        $request->order = $order;
        $request->save();
        Session::forget('user-info');
        Session::forget('check-input');
        return redirect()->route('home')->with('success', trans('car.check.success.save'));
    }



}
