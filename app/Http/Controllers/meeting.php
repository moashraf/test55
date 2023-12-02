<?php

namespace App\Http\Controllers;

use App\Models\Basic\Video_tutorial;
use App\Models\Branch\Slider;
use App\Models\School\Meetings\meetings;
use App\Models\School\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class meeting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $current_school = Auth::guard('school')->user()->current_working_school_id;

        $school = School::find($current_school);


        $sliders = Slider::where('type', 1)->get();

        // video tutorial
        $video_tutorial = Video_tutorial::where('type', 2)->first();

        return view('website.school.new_meeting',
            compact('current_school', 'school', 'sliders', 'video_tutorial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'committees_and_teams_id' => 'required',
            'title' => 'required',
        ]);

        $form = meetings::create([
            'committees_and_teams_id'=>$request->input('committees_and_teams_id'),
            'Number_of_attendees' => $request->input('number_of_attendees'),
            'title' => $request->input('title'),
            'Target_group' => $request->input('Target_group'),
            'status' => $request->input('status'),
            'location' => $request->input('location'),
            'start_date' => $request->input('start_date'),
            'start_time' => $request->input('start_time'),
            'type' => $request->input('type'),
            'end_date' => $request->input('end_date'),
            'end_time' => $request->input('end_time'),
        ]);

        return redirect()->back()->with('success', 'Your form has been sent successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $current_school = Auth::guard('school')->user()->current_working_school_id;

        $school = School::find($current_school);


        $sliders = Slider::where('type', 1)->get();
        $item_val = meetings::find($id);

        // video tutorial
        $video_tutorial = Video_tutorial::where('type', 2)->first();

        return view('website.school.new_meeting',
            compact('current_school', 'school','item_val', 'sliders', 'video_tutorial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'committees_and_teams_id' => 'committees_and_teams_id',
        ]);
        $meetings = meetings::find($id);
        $meetings->committees_and_teams_id = $request->input('committees_and_teams_id');
        $meetings->number_of_attendees = $request->input('number_of_attendees');
        $meetings->Target_group = $request->input('Target_group');
        $meetings->title = $request->input('title');
        $meetings->status = $request->input('status');
        $meetings->location = $request->input('location');
        $meetings->start_date = $request->input('start_date');
        $meetings->start_time = $request->input('start_time');
        $meetings->type = $request->input('type');
        $meetings->end_date = $request->input('end_date');
        $meetings->end_time = $request->input('end_time');
        $meetings->save();
        return redirect()->back()->with('success', 'Your form has been sent successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $meetings = meetings::find($id);

        if ($meetings) {
            $meetings->delete();
            return redirect()->back()->with('success', 'Record has been deleted successfully');
        }

        return redirect()->back()->with('error', 'Record not found');
    }
}