<?php

namespace App\Http\Controllers;

use App\Models\URL;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class URLController extends Controller
{
    public function index()
    {
        return view('url_list');
    }

    public function generate_short(Request $request, URL $url)
    {
        $original_url = filter_var($request->long_url, FILTER_VALIDATE_URL);
        $url_exist = $url->url_exists($request->long_url);
        if($url_exist) {
            return response("This URL <b>$original_url</b> had already been saved", 409);
        }
        if($original_url && !$url_exist) {
            $url->save_short($request->long_url);
            return response('Short url was generated and saved successfully!', 201);
        } else {
            return response("Invalid URL <b>$request->long_url</b>. Please check it", 400);
        }
    }

    public function redirect_to_original(Request $request, URL $url)
    {
        $short_url = $request->short_url;
        $short_exist = $url->url_exists($short_url, 'short_url');
        if($short_exist) {
            $redirectUrl = $url->searchByHash($short_url);
            return redirect($redirectUrl);
        } else {
            return response("Invalid hash <b>$short_url</b>. Please check it", 400);
        }
    }

    public function getUrls() : JsonResponse
    {
        URL::all();
        return response()->json(URL::all());
    }
}
