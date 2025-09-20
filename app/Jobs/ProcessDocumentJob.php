<?php

namespace App\Jobs;

use App\Models\Document;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class ProcessDocumentJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private int $documentId)
    {
        //
    }

    public function handle(): void
    {
        $document = Document::find($this->documentId, ['id', 'input_path']);

        $data = [];
        // Excel::import();

        Http::asJson()
            ->acceptJson()
            ->withHeader('x-secret-key', config('services.cf_worker.jht_checker.secret_key'))
            ->post('/process-document', $data);

        $file = null;

        $document->update([
            'output_path' => $file,
        ]);
    }
}
