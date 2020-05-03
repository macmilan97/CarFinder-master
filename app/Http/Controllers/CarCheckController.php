<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckCarRequest;
use App\Models\Expert;
use App\Models\Request as CarRequest;
use Illuminate\Http\Request;
use Session;
use DB;

class CarCheckController extends Controller
{

    public function stepOne()
    {
        return view('car.check.step-1', [
        ]);
    }

    public function stepOneForm(Request $request)
    {
        $inputs = $request['check_input'];
        if (!$inputs) {
            return redirect()->back()->with('error', trans('car.check.error.select-one'));
        }
        Session::put('check-input', $inputs);
        return redirect()->route('check-step-two');
    }

    public function stepTwo()
    {
        $stepOneVal = Session::get('check-input');
        if ($stepOneVal == null) {
            return redirect()->route('check-step-one');
        }
        return view('car.check.step-2');
    }

    public function stepTwoForm(StoreCheckCarRequest $request)
    {
        $user_info = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'link' => $request['link'],
        ];
        Session::put('user-info', $user_info);
        return redirect()->route('check-step-three');
    }

    public function stepThree()
    {
        $stepTwoVal = Session::get('user-info');
        if ($stepTwoVal == null) {
            return redirect()->route('check-step-two');
        }
        $city = Session::get('user-city');
        $sort_id = request()->request->get('sort_id');
        if ($sort_id) {
            $sort_type = (($sort_id) == 1) ? 'min' : 'max';
            if ($city) {
                $experts = Expert::select('experts.*')
                    ->join('expert_skill', 'experts.id', '=', 'expert_skill.expert_id')
                    ->join('skills', 'skills.id', '=', 'expert_skill.skill_id')
                    ->leftJoin('expert_services', function ($q) use ($sort_type) {
                        $q->on('expert_services.expert_id', '=', 'experts.id')
                            ->on('expert_services.price', '=',
                                DB::raw('(select ' . $sort_type . '(price) from expert_services where expert_id = experts.id)'
                                ));
                    })
                    ->whereIn('skills.code', Session::get('check-input'))
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
                    ->whereIn('skills.code', Session::get('check-input'))
                    ->join('expert_skill', 'experts.id', '=', 'expert_skill.expert_id')
                    ->join('skills', 'skills.id', '=', 'expert_skill.skill_id')
                    ->where('experts.status', '=', 'ACTIVE')
                    ->paginate(8);

            }
        } else {
            if ($city) {
                $experts = Expert::select('experts.*')
                    ->join('expert_skill', 'experts.id', '=', 'expert_skill.expert_id')
                    ->join('skills', 'skills.id', '=', 'expert_skill.skill_id')
                    ->whereIn('skills.code', Session::get('check-input'))
                    ->where('experts.city_id', '=', $city)
                    ->where('experts.status', '=', 'ACTIVE')
                    ->paginate(8);
            } else {
                $experts = Expert::select('experts.*')
                    ->join('expert_skill', 'experts.id', '=', 'expert_skill.expert_id')
                    ->join('skills', 'skills.id', '=', 'expert_skill.skill_id')
                    ->whereIn('skills.code', Session::get('check-input'))
                    ->where('experts.status', '=', 'ACTIVE')
                    ->paginate(8);
            }
        }

        return view('car.check.step-3', [
            'experts' => $experts,
            'sort_id' => $sort_id
        ]);
    }

    public function expert_info($id)
    {
        $expert = Expert::where('id', '=', $id)
            ->where('status', '=', 'ACTIVE')
            ->firstOrFail();
        $route = route('select-expert');
        return view('car.expert-info', [
            'expert' => $expert,
            'route' => $route
        ]);
    }

    public function expert_select(Request $request)
    {
        $user_info = Session::get('user-info');
        $expert_name = Expert::find($request['expert_id']);

        return view('car.check.step-final', [
            'expert_name' => $expert_name->first_name,
            'user_info' => $user_info,
            'expert_id' => $request['expert_id'],
        ]);
    }

    public function check_save(Request $request)
    {
        $user_info = Session::get('user-info');
        $expert_id = $request['expert_id'];
        $order = Session::get('check-input');
        $order = json_encode($order);
        $saveRequest = new CarRequest();
        $saveRequest->type = CarRequest::TYPE_CHECK;
        $saveRequest->name = $request['name'];
        $saveRequest->phone = $request['phone'];
        $saveRequest->expert_id = $expert_id;
        $saveRequest->link = $user_info['link'];
        $saveRequest->order = $order;
        $saveRequest->save();
        Session::forget('user-info');
        Session::forget('check-input');
        return redirect()->route('home')->with('success', trans('car.check.success.save'));
    }

}
