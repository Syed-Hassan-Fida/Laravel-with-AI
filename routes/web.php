<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware(['auth'])->group(function(){

    Route::get('/home-page', [UserController::class, 'index'])->name('home.page');

    Route::get('/blog-generator-view', [UserController::class, 'blogGeneratorIndex'])->name('blog-generator-view');
    Route::post('/blog-generator', [UserController::class, 'blogGenerator'])->name('blog-generator');

    Route::get('/image-view', [UserController::class, 'imageView'])->name('image-view');
    Route::post('/image-generator', [UserController::class, 'imageGenerator'])->name('image-generator');

    Route::get("download-image", [UserController::class, 'imageDownload'])->name("download-image");
    Route::get("example", [UserController::class, 'example1'])->name("example");
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('signin', function(){
    return view('pages.sign-in');
});
require __DIR__.'/auth.php';


// Route::get('/run-script', function(){
//     exec("python C:/Users/MAQS/Desktop/files/ai/l.py");
//     return "Script executed";
// });

Route::get('/run-script', function(){
    $process = new Process(['python', 'public/pythonScript/file.py']);
    $process->run();
    echo $process->getOutput();
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }
    return "Script executed";
});


Route::post('scale', [UserController::class, 'upscale'])->name("scale");
