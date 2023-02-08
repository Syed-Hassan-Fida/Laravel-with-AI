<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\textGenerator;
use App\Models\imageGenerator;
use GuzzleHttp\Client;

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
            "top_p" => 1,
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
        $results = '';
        return view("user_view.generate_image", compact('results'));
    }

    public function imageGenerator(Request $request){
        $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        $complete = $open_ai->image([

            "prompt" => $request->prompt,
            "n" => (int)$request->numberofImages,
            "size" => $request->type,
            "response_format" => "url",
        ]);
        $data['results'] = [];
        $data['id'] = [];
        $data['results']  = json_decode($complete);
        foreach($data['results']->data as $item){

            $url = $item->url;
            $org_url = $item->url;
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

            array_push($data['id'], $created->id);
        }

        return view('user_view.generate_image', $data);

    }

    public function imageDownload(Request $request){

        $image = imageGenerator::where("id", $request->id)->pluck("image");

        $path = Storage::path('images/'.$image[0]);

        return response()->download($path);
    }


    public function upscale(Request $request){
        // $image = imageGenerator::where("id", 25)->pluck("image");

        $path = $request->file;
        // return $path;

        // $apiKey = env('7abc5a3b-86b2-414e-8c7d-9be9a5bfd67b');
        // return $path;
        // Set the API endpoint for Superresolution
        // $endpoint = "https://api.deepai.org/api/torch-srgan";
        
        // // Set the image data to send in the request
        // $imageData = curl_file_create($path);
        // $data = [
        //     'image' => $imageData,
        //     'scale' => 2,
        // ];

        $apiKey = '7abc5a3b-86b2-414e-8c7d-9be9a5bfd67b';
        $imageUrl = $path;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.deepai.org/api/torch-srgan');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Api-Key: ' . $apiKey,
            'Content-Type: multipart/form-data',
        ]);

        $post = [
            'image' => curl_file_create($imageUrl),
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);

        if (!curl_errno($ch)) {
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($statusCode === 200) {
                $result = json_decode($response);
                // The super resolved image URL can be found in the `output_url` field
                $superResolvedImageUrl = $result->output_url;
                // storing image
                $pathinfo = pathinfo($superResolvedImageUrl);
                Storage::disk('local')->put('Upscaleimages/'.$pathinfo['basename'], @file_get_contents($superResolvedImageUrl));
                $storagepath = Storage::path('Upscaleimages/'.$pathinfo['basename']);
                return response()->download($storagepath);
                // Do something with the super resolved image URL
            } else {
                // Handle error
                echo 'Error: ' . $response;
            }
        }

        curl_close($ch);
    }


    public function postRequest(Request $request){
        $image      = $request->file('file');
        $imageName  = time() . '.' . $image->getClientOriginalExtension();
        $path       = "apiImages/".$imageName;
        Storage::disk('local')->put($path, file_get_contents($image)); 

        return [
            'file' => $request->file,
            'status' => 200
        ];
    }
    
}
