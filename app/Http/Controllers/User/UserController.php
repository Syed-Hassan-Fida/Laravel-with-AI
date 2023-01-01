<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\textGenerator;
use App\Models\imageGenerator;

class UserController extends Controller
{
    public function index(){
        return view('user_view.index');
    }

    public function blogGeneratorIndex(){
        $data['text'] = '';
        return view('user_view.generate_blog', $data);
    }

    public function blogGenerator(Request $request){
        // return gettype((int)$request->tokens);
        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        $complete = $open_ai->completion([
            // 'model' => 'davinci-instruct-beta-v3',
            "model" => "text-davinci-003",
            'prompt' => $request->prompt,
            // 'prompt' => "Expand the blog section in to a detailed professional , witty and clever explanation."." web development",
            'temperature' => 0.9,
            "max_tokens" => (int)$request->tokens,
            "frequency_penalty" => 0.6,
            "presence_penalty" => 0.6,
        ]);

        textGenerator::create([
            'user_id' => Auth::user()->id,
            'vote' => 1
        ]);

        $result  = json_decode($complete);
        $data['text'] = $result->choices[0]->text;
        return view('user_view.generate_blog', $data);
    }

    public function imageView(){
        $org_url = '';
        return view("user_view.generate_image", compact('org_url'));
    }

    public function imageGenerator(Request $request){
        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        $complete = $open_ai->image([

            "prompt" => $request->prompt,
            "n" => 1,
            "size" => $request->type,
            "response_format" => "url",
        ]);
        $result  = json_decode($complete);
        $url = $result->data[0]->url;
        $org_url = $result->data[0]->url;
        if (strpos($url, '?') !== false) {
            $t = explode('?',$url);
            $url = $t[0];
        }
        $pathinfo = pathinfo($url);
        Storage::disk('local')->put('images/'.$pathinfo['basename'], @file_get_contents($org_url));
        $created = imageGenerator::create([
            'user_id' => Auth::user()->id,
            'url' => $url,
            'image' => $pathinfo['basename'],
        ]);

        $id = $created->id;
        return view('user_view.generate_image', compact('org_url', 'id'));

    }

    public function imageDownload(Request $request){

        $image = imageGenerator::where("id", $request->id)->pluck("image");

        $path = Storage::path('images/'.$image[0]);

        return response()->download($path);
    }
}
