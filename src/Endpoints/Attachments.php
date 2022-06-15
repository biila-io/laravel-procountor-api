<?php

namespace BiilaIo\Procountor\Endpoints;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

/**
 * @mixin \BiilaIo\Procountor\Procountor
 */
trait Attachments
{
    /**
     * Get a list of attachments.
     *
     * @param array $query
     * @return \Illuminate\Http\Client\Response
     */
    public function getAttachments(array $query = []): Response
    {
        return $this->http()->get('attachments', $query);
    }

    /**
     * Get details of given attachment id.
     *
     * @param int $attachmentId
     * @return \Illuminate\Http\Client\Response
     */
    public function getAttachment($attachmentId): Response
    {
        return $this->http()->get("attachments/{$attachmentId}");
    }

    /**
     * Upload an attachment to Procountor.
     *
     * @param string $filePath
     * @param mixed $referenceId
     * @param string|null $disk
     * @param string|null $filename
     * @return \Illuminate\Http\Client\Response
     */
    public function uploadAttachment(
        string $filePath,
        $referenceId,
        string $disk = null,
        string $filename = null
    ): Response {
        /** @var \BiilaIo\Procountor\Procountor $this */

        $storage = Storage::disk($disk);

        if (!$storage->exists($filePath)) {
            throw new RuntimeException("Invalid file given!");
        }

        $file = $storage->readStream($filePath);
        $filename = $filename ?: basename($filePath);

        return $this->http()
            ->attach('file', $file, $filename)
            ->attach('meta', json_encode([
                'name' => $filename,
                'referenceType' => 'INVOICE',
                'referenceId' => $referenceId
            ]), 'meta.json')
            ->post('attachments');
    }
}
