<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class URLController extends Controller
{
    public function index()
    {
        return view('url_list');
    }

    public function generate_short(Request $request, \App\Models\URL $url)
    {
        $original_url = filter_var($request->long_url, FILTER_VALIDATE_URL);
        $url_exist = $url->url_exists($request->long_url);
        if($url_exist){
            return response('This URL is already saved', 409);
        }
        if($original_url && !$url_exist){
            $url->save_short($request->long_url);
            return response('Short url was generated and saved successfully!', 201);
        } else {
             return response('Invalid URL. Please check it', 400);
         }

   }
}