<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessDocumentJob;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DocumentController extends Controller
{
    public function index(): View
    {
        $data['documents'] = Document::paginate();

        return view('admin.documents.index', $data);
    }

    public function create(): View
    {
        return view('admin.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeCreate(Document::class);

        $validated = $request->validate([
            'document' => ['bail', 'required', 'file', 'mimes:xlsx', 'max:2048'],
        ]);

        $document = new Document($validated);
        $document->save();

        dispatch(new ProcessDocumentJob($document->id));

        return back()->with('alert', ['message' => 'Document created', 'type' => 'success']);
    }
}
