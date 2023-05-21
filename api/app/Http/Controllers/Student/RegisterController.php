<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Register;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    
    public function index()
    {
        $k = Redis::get('users_pagination_20');

        if ($k) {
            $k = unserialize($k);
        } else {
            $k = User::paginate(20);
            Redis::set('users_pagination_20', serialize($k));
            Redis::expire('users_pagination_20', 60); // Set an expiry time (e.g., 60 seconds) for the cached data
        }
        return $k;
        
    }
    public function store(Register $request)
    {
       
        $request->validated();
        return User::create($request->all());
		
		//return 'success';
    }
    public function show($id)
    {
        return User::findorfail($id);
    }
    
   
    public function update(Request $request, $id)
    {
        $product=Blog::findorFail($id);
        $product->update($request->all());
    }
    public function destroy()
    {
        try {
            $game =Blog::findorFail($id)->delete();
            return response(['Deletion Successful'],200) ->header('Content-Type', 'text/plain');
        } catch(Exception $e) {
             return response(['Deletion Not Successful'],401) ->header('Content-Type', 'text/plain');;
        }
    }

}
