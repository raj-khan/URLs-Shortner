<?php

namespace App\Http\Controllers;

use App\Models\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlsController extends Controller
{
    public function shortUrl(Request $request)
    {
        $this->validate($request, [
            'url'=>'required'
        ]);

        //create hash
        $letter = array_merge(range('a', 'z'), range('A', 'Z'));
        $randomInteger = rand(0, 9);
        $hash = $letter[rand(0, 51)]. $randomInteger. Str::random(4);

        $created = Urls::create([
            'url' => $request->url,
            'hash' => $hash,
        ]);

        if($created)
        {
            return response()->json(['success' => true, 'message' => 'URL shorted successfully.!', 'data' =>
                $created ]);
        }

        return response()->json(['success' => false, 'message' => 'URL not shorted!', 'data' => null]);
    }

    public function redirectUrl($hash)
    {
        $url = Urls::where('hash', $hash)->first();
        if($url)
        {
            return redirect()->to($url->url);
        }
        return redirect()->back();
    }
}
