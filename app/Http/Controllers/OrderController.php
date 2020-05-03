<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as InputRequest;
use Auth;

class OrderController extends Controller
{

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:expert');
    }

    public function all()
    {
        $requests = Request::whereNull('expert_id')->where('status', '=', Request::STATUS_NO)->paginate(10);
        return view('profile.order.all', [
            'requests' => $requests,
        ]);
    }
    public function show($id)
    {

        $request = Request::whereNull('expert_id')->where('id', '=', $id)->firstOrFail();
        return view('profile.order.show', [
            'request' => $request,
        ]);
    }
    public function personal()
    {
        $title = trans('profile.orders-personal');
        $requests = Request::where('expert_id', '=', Auth::id())->where('status', '!=', Request::STATUS_DONE)->paginate(10);
        return view('profile.order.personal', [
            'requests' => $requests,
            'title' => $title
        ]);
    }
    public function completed()
    {
        $title = trans('profile.completed');
        $requests = Request::where('expert_id', '=', Auth::id())->where('status', '=', Request::STATUS_DONE)->paginate(10);
        return view('profile.order.personal', [
            'requests' => $requests,
            'title' => $title
        ]);
    }

    public function personal_show($id)
    {
        $request = Request::where('expert_id', '=', Auth::id())->where('id', '=', $id)->firstOrFail();
        return view('profile.order.personal-show', [
            'request' => $request,
        ]);
    }

    public function update_status(InputRequest $request)
    {
        $checkOrder = Request::find($request['request_id']);
        if($checkOrder == null) {
            return redirect()->back();
        }
        if($checkOrder->expert_id != null and $checkOrder->expert_id != Auth::id()) {

            return redirect()->back();
        }
        if($checkOrder->expert_id == null) {
            Request::where('id', '=', $request['request_id'])->update(['status' => $request['status'], 'expert_id' => Auth::id()]);

        } else {
            Request::where('expert_id', '=', Auth::id())->where('id', '=', $request['request_id'])->update(['status' => $request['status']]);
        }
        return redirect()->route('order-personal')->with('success', trans('profile.order.status.updated'));
    }

}
