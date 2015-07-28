<?php

namespace App\Http\Controllers;

use App\Bucket;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function listen(Request $request, $bucket)
    {
        if ($bucket = Bucket::where('hash', $bucket)->first())
        {
            if ($file = $request->file('file'))
            {
                $bucket->assets()->create([
                    'content' => file_get_contents($request->file('file')->getRealPath())
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
                $output = [];

                foreach ($bucket->assets()->get() as $asset)
                {
                    $output[] = str_replace(["\t", "\n"], ["&nbsp;&nbsp;&nbsp;&nbsp;", "<br>"], $asset->content);
                }

                return "Results:<br><br>".implode("<br><br>", $output).PHP_EOL;
            }
        }

        return redirect('/');
    }

    public function create(Request $request)
    {
        $bucket = Bucket::generate();

        return "\nExample Usage:\n   curl -F file=@/filename.txt {$bucket->hashPath}\n\n".
               "Retrieve results by:\n   {$bucket->adminPath}\n".PHP_EOL;
    }
}
