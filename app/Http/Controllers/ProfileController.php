<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\City;
use App\Models\Expert;
use App\Models\ExpertDocument;
use App\Models\ExpertProfile;
use App\Models\ExpertService;
use App\Models\Skill;
use Auth;
use Illuminate\Http\Request;
use App\Models\Request as CarRequest;
use App\Traits\UploadTrait;


class ProfileController extends Controller
{

    use UploadTrait;

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:expert');
    }

    public function index()
    {
        $skills = Skill::all();
        $userSkills = Auth::user()->skill;
        $diffSkills = array_udiff($this->convertArray($skills), $this->convertArray($userSkills), function ($e1, $e2) {
            return $e1['id'] <=> $e2['id'];
        });
        $count_all = $requests = CarRequest::whereNull('expert_id')->where('status', '=', CarRequest::STATUS_NO)->count();
        $count_active = $requests = CarRequest::where('expert_id', '=', Auth::id())->where('status', '!=', CarRequest::STATUS_DONE)->count();
        $count_done = $requests = CarRequest::where('expert_id', '=', Auth::id())->where('status', '=', CarRequest::STATUS_DONE)->count();
        return view('profile.index', [
            'skills' => $skills,
            'diffSkills' => $diffSkills,
            'count_all' => $count_all,
            'count_active' => $count_active,
            'count_done' => $count_done,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {

        $cities = City::all();
        return view('profile.edit', [
            'cities' => $cities
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'city_id' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'experience' => 'int',
        ]);
        $profile = new ExpertProfile();
        $profile_id = ExpertProfile::where('expert_id', '=', Auth::id())->first();
        if ($profile_id == null) {
            $profile = new ExpertProfile();
        } else {
            $profile = ExpertProfile::find($profile_id->id);
        }
        $profile->expert_id = Auth::id();
        if (!empty($request['avatar'])) {
            $image = $request['avatar'];
            $name = str_slug('profile') . '_' . time();
            $folder = 'images/' . date('M') . date('Y') . '/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $profile->image = $filePath;
        }
        $profile->departure = $request['departure'];
        $profile->experience = $request['experience'];
        $profile->save();
        $expert = Auth::user();
        $expert->first_name = $request['first_name'];
        $expert->last_name = $request['last_name'];
        $expert->city_id = $request['city_id'];
        $expert->save();

        return redirect()->route('profile')->with('success', trans('profile.update-success'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function service_crud()
    {
        $services = ExpertService::where('expert_id', '=', Auth::id())->get();
        return view('profile.services.add', [
            'services' => $services,
        ]);
    }

    /**
     * @param StoreServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function service_add(StoreServiceRequest $request)
    {
        $service = new ExpertService();
        $service->title = $request['service_title'];
        $service->price = $request['service_price'];
        $service->expert_id = Auth::id();
        $service->save();
        return redirect()->back()->with('success', trans('profile.services.success.add'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function service_edit($id)
    {
        $service = ExpertService::find($id);
        return view('profile.services.edit', [
            'service' => $service,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function service_update(Request $request, $id)
    {
        $service = ExpertService::find($id);
        $service->expert_id = Auth::id();
        $service->title = $request['service_title'];
        $service->price = $request['service_price'];
        $service->save();
        return redirect()->route('service-crud')->with('success', trans('profile.services.success.update'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function service_delete($id)
    {
        $service = ExpertService::where('expert_id', '=', Auth::id())->where('id', '=', $id);
        $service->delete();
        return redirect()->back()->with('success', trans('profile.services.success.delete'));

    }


    public function documents()
    {
        $documents = ExpertDocument::where('expert_id', '=', Auth::id())->get();
        return view('profile.documents', [
            'documents' => $documents
        ]);
    }

    public function add_document(Request $request)
    {
        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $filepath_save = $file->store('public/expert-documents/' . date('MY'));
                $filepath = str_replace('public/', '', $filepath_save);
                $filename = $file->getClientOriginalName();
                $filepath_dict = [[
                    'download_link' => $filepath,
                    'original_name' => $filename
                ]];
                ExpertDocument::create([
                    'expert_id' => Auth::id(),
                    'filepath' => json_encode($filepath_dict),
                    'filename' => $filename
                ]);
            }
            return redirect()->back()->with('success', trans('profile.document.success'));
        }

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function skill_add(Request $request)
    {
        $skill = Expert::find(Auth::id());
        $skill->skill()->attach($request['skill_name']);
        return redirect()->back()->with('success', trans('profile.update-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    protected function skill_delete($id)
    {
        $skill = Expert::find(Auth::id());
        $skill->skill()->detach($id);
        return \Response::json('success', 200, array('Content-Type' => 'application/json;charset=utf8'), JSON_UNESCAPED_UNICODE);

    }

    /**
     * @param $objects
     * @return array
     */
    private function convertArray($objects)
    {
        $result = [];
        foreach ($objects as $object) {
            $array = [
                'id' => $object->id,
                'title' => $object->title
            ];
            array_push($result, $array);
        }
        return $result;
    }

}

