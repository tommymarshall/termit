<?php

namespace App\Http\Controllers;

use App\Bucket;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function listen(Request $request, $bucket, $name = 'Anonymous')
    {
        if ($bucket = Bucket::where('hash', $bucket)->first())
        {
            if ($file = $request->file('file'))
            {
                $bucket->assets()->create([
                    'by'      => $name,
                    'content' => serialize(file_get_contents($request->file('file')->getRealPath())),
                ]);

                return "\nWe saved the contents of the file to this bucket. Thanks Brah!\n".PHP_EOL;
            }
        }
    }

    public function view($bucket, $password)
    {
        if ($bucket = Bucket::where('hash', $bucket)->first())
        {
            if ($bucket->password == $password)
            {
                $assets = $bucket->assets()->get();

                return view('bucket', compact('bucket', 'assets'));
            }
        }

        return redirect('/');
    }

    public function create(Request $request)
    {
        $bucket = Bucket::generate();

        return "\nExample Usage:\n   curl -F file=@/filename.txt {$bucket->hashPath}\n\n".
               "Retrieve results by visiting (in your browser)\n   {$bucket->adminPath}\n\n".
               "Or just run this command:\n   open -a /Applications/Google\ Chrome.app {$bucket->adminPath}\n\n".PHP_EOL;
    }
}
