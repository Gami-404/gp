<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

class UploaderController extends Controller
{


    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (fauth()->check()) {
                return $next($request);
            } else {
                return redirect("/login");
            }

        });
    }

    /**
     * @route cvs.upload
     * @param Request $request
     * @return mixed
     */
    public function uploads(Request $request)
    {

        $file = $request->file('file');
        $media = Media::where("hash", sha1_file($file->getRealPath()))->first();

        if (count($media)) {
            $media->touch();
            return $media->id;
        }

        // uploading

        $size = $file->getSize();
        $parts = explode(".", $file->getClientOriginalName());
        $extension = end($parts);
        $filename = time() * rand() . "." . strtolower($extension);
        $mime_parts = explode("/", $file->getMimeType());
        $mime_type = $mime_parts[0];
        $file_directory = UPLOADS_PATH . date("/Y/m");
        \File::makeDirectory($file_directory, 0777, true, true);
        try {
            $file->move($file_directory, $filename);

        } catch (Exception $exception) {

            $error = array(
                'name' => $file->getClientOriginalName(),
                'size' => $size,
                'error' => $exception->getMessage(),
            );

            return Response::json($error, 400);
        }
        $media = new Media();
        $media->provider = "";
        $media->path = date("Y/m") . "/" . $filename;
        $media->type = $mime_type;
        $media->title = basename(strtolower($file->getClientOriginalName()), "." . $extension);
        $media->user_id = fauth()->id();
        $media->created_at = date("Y-m-d H:i:s");
        $media->updated_at = date("Y-m-d H:i:s");
        $media->hash = sha1_file($file_directory . "/" . $filename);
        $media->parser = ($this->getParseJson(uploads_path($media->path)));
        $media->save();
        return $media->id;
    }

    /**
     * File path
     * @param $path
     * @return bool|string
     */
    protected function getParseJson($path)
    {
        $return = null;
        return (system("node " . getParserPath() . ' "' . $path . '"', $return));
    }
}
