<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Expert;
use App\Models\Request as CarRequest;
use Illuminate\Http\Request;
use Session;
use TCG\Voyager\Models\Page;

class HomeController extends Controller {

    public function index()
    {
        $about = Page::where('slug', '=', 'about')->first();
        $experts = Expert::count();
        $comments = Comment::all();
        return view('home.index', [
            'about'  => $about,
            'experts' => $experts,
            'comments' => $comments
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function selectCity(Request $request)
    {
        Session::put('user-city', $request['select_city']);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function selectExpert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'type' => 'required',
            'expert_id' => 'required',
        ]);
        $saveRequest = new CarRequest();
        if($request['type'] == CarRequest::TYPE_CHECK) {
            $saveRequest->order = json_encode($request['order']);
        }
        $saveRequest->name = $request['name'];
        $saveRequest->phone = $request['phone'];
        $saveRequest->type = $request['type'];
        $saveRequest->expert_id = $request['expert_id'];
        $saveRequest->save();
        return redirect()->route('home')->with('success', trans('car.check.success.save'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'type' => 'required',
        ]);
        $saveRequest = new CarRequest();
        if($request['type'] == CarRequest::TYPE_CHECK) {
            $saveRequest->order = json_encode($request['order']);
        }
        $saveRequest->name = $request['name'];
        $saveRequest->phone = $request['phone'];
        $saveRequest->type = $request['type'];
        $saveRequest->comment = $request['comment'];
        $saveRequest->save();
        return redirect()->route('home')->with('success', trans('car.check.success.save'));
    }

}
