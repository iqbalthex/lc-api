<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $data['documents'] = Document::paginate();

        return view('admin.documents.index', $data);
    }

    public function show(Document $document)
    {
        $data['document'] = $document;

        return view('admin.documents.view', $data);
    }
}
