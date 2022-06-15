<?php

namespace BiilaIo\Procountor\Facades;

use BiilaIo\Procountor\Procountor as BaseProcountor;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \BiilaIo\Procountor\ProcountorConfig getConfig()
 * @method static string|null accessTokenExpiresAt()
 * @method static string accessToken()
 * @method static bool refreshAccessToken()
 * @method static \Illuminate\Http\Client\Response getInvoices(array $query = [])
 * @method static \Illuminate\Http\Client\Response getInvoice($invoiceId)
 * @method static \Illuminate\Http\Client\Response storeInvoice(array $data)
 * @method static \Illuminate\Http\Client\Response verifyInvoice($invoiceId, string $comment = null)
 * @method static \Illuminate\Http\Client\Response approveInvoice($invoiceId, string $comment = null)
 * @method static \Illuminate\Http\Client\Response invalidateInvoice($invoiceId)
 * @method static \Illuminate\Http\Client\Response getAttachments(array $query = [])
 * @method static \Illuminate\Http\Client\Response getAttachment($attachmentId)
 * @method static \Illuminate\Http\Client\Response uploadAttachment(string $filePath, $referenceId, ?string $disk = null, ?string $filename = null)
 *
 * @see \BiilaIo\Procountor\Procountor
 */
class Procountor extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BaseProcountor::class;
    }
}
