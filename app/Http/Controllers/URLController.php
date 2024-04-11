<?php

namespace App\Http\Controllers;

use App\Models\URL;
use Illuminate\Http\Request;

class URLController extends Controller
{
    public function index()
    {
        $url_list = URL::all();
        return view('url_list', compact('url_list'));
    }

    public function generate_short(Request $request, \App\Models\URL $url)
    {
        $original_url = filter_var($request->long_url, FILTER_VALIDATE_URL);
        $url_exist = $url->url_exists($request->long_url);
        if($url_exist){
            return response('This URL had already been saved', 409);
        }
        if($original_url && !$url_exist){
            $url->save_short($request->long_url);
            return response('Short url was generated and saved successfully!', 201);
        } else {
            return response('Invalid URL. Please check it', 400);
         }
   }

    public function redirect_to_original(Request $request)
    {
        //TODO check if exists and not null url
        //Replace the function to URL model
        $short_url = $request->short_url;
        try{
            $url = URL::where('short_url', $short_url)->first();
            $url->update(['times' => $url->times + 1]);
            return redirect($url->long_url);
        } catch(\Exception $e) {
            return response('Invalid hash. Please check it', 400);
        }

   }
}
