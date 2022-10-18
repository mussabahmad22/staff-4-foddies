<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurnats = Restaurant::where('status', 1)->orderBy('created_at','asc')->get();
        //dd($restaurnats);
        return view('restaurants', compact('restaurnats'));
    }
    public function dashboard(){
        $rest_count = Restaurant::all()->count();
        $rest_count_users = User::all()->count();

        return view('dashboard',compact('rest_count', 'rest_count_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       // dd($request);
        $r = '';
        foreach(json_decode($request->cuisines) as $ojk){
            $r .= $ojk->value.",";
        }
        $r = rtrim($r, ",");
        if ($request->hasFile('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $imgh = time() . '.' . $image->getClientOriginalExtension();
//            dd($imgh);

            $img = Image::make($image->getRealPath());
            $img->resize(480, 480, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('public/images/'.'/'.$fileName, $img, 'public');
            $request['image']= asset('storage/images/'.$imgh);
        }
        $restu = new Restaurant;
        $data = $request->except('_token');
        $data['cuisines'] = $r;
        $data['status'] = 1;
        $restu->create($data);
        return redirect('/restaurants');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retu = Restaurant::whereId($id)->first();
        return $retu;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->hasFile('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $imgh = time() . '.' . $image->getClientOriginalExtension();
//            dd($imgh);

            $img = Image::make($image->getRealPath());
            $img->resize(480, 480, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('public/images/'.'/'.$fileName, $img, 'public');
            $request['image']= asset('storage/images/'.$imgh);
        }
        $restu = Restaurant::whereId($request->id)->first();
        $data = $request->except('_token');
        $restu->update($data);
        return redirect('/restaurants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $restu = Restaurant::whereId($request->id)->first();
        if ($restu){
            $restu->delete();
            return response()->json(['message'=>'successfully deleted'],200);
        }else{
            return response()->json(['message'=>'Something went wrong'],400);
        }
    }
}
