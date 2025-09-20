<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadDocumentController extends Controller
{
    public function input(Document $document): BinaryFileResponse
    {
        $file = Storage::get($document->input_path);

        return response()->download($file, $document->input_name);
    }

    public function output(Document $document): BinaryFileResponse
    {
        $file = Storage::get($document->output_path);

        return response()->download($file);
    }
}
