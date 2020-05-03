<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Session;
use DB;

class ExpertController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $city = Session::get('user-city');
        $sort_id = request()->request->get('sort_id');
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
        return view('expert.index', [
            'experts' => $experts,
            'sort_id' => $sort_id,
        ]);
    }
    public function show($id)
    {
        $expert = Expert::find($id);
        return view('expert.show', [
            'expert' => $expert
        ]);
    }
}
