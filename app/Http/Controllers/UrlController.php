<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function shortUrl(Request $request): JsonResponse
    {
        # Validation regular expression for url validation
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        # Validation rules for request validation
        $this->validate($request, [
            'url'=> 'required|regex:'.$regex,
        ]);
        try{
            $isExists = Url::where('url',  $request->url)->first();
            if ($isExists) {
                $message = 'URL already shorted!';
            }else{
                #create hash
                $hash = $this->generateHash();
                # create new url
                $created = Url::create([
                    'url'  => $request->url,
                    'hash' => $hash,
                ]);
                $message = 'URL shorted successfully.!';
            }
            $data = $isExists?? $created;
        }catch (\Exception $exception){
            $data = false;
            $message = 'URL not shorted!';
        }

        return response()->json(['success' => (bool) $data, 'message' => $message, 'data' => $data??null]);
    }

    /**
     * @param $hash
     */
    public function redirectUrl($hash)
    {

        $url = Url::where('hash', $hash)->first();
        return $url ? redirect()->to($url->url) :  redirect()->back();
    }

    /**
     * @return string
     */
    protected function generateHash(): string
    {
        $letter = array_merge(range('a', 'z'), range('A', 'Z'));

        return $letter[rand(0, 51)].  rand(0, 9). Str::random(4);
    }

}
