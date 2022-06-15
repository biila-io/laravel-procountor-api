<?php

namespace BiilaIo\Procountor\Endpoints;

use Illuminate\Http\Client\Response;

trait Invoices
{
    /**
     * Get a list of invoices.
     *
     * @param array $query
     * @return \Illuminate\Http\Client\Response
     */
    public function getInvoices(array $query = []): Response
    {
        return $this->http()->get('invoices', $query);
    }

    /**
     * Get the details for given invoice id.
     *
     * @param int $invoiceId
     * @return \Illuminate\Http\Client\Response
     */
    public function getInvoice($invoiceId): Response
    {
        return $this->http()->get("invoices/{$invoiceId}");
    }

    /**
     * Store invoice to Procountor with given data.
     *
     * @param array $data
     * @return \Illuminate\Http\Client\Response
     */
    public function storeInvoice(array $data): Response
    {
        return $this->http()->post('invoices', $data);
    }

    /**
     * Verify a stored invoice in Procountor.
     *
     * @param int $invoiceId
     * @param string|null $comment
     * @return \Illuminate\Http\Client\Response
     */
    public function verifyInvoice($invoiceId, string $comment = null): Response
    {
        return $this->http()->put("invoices/{$invoiceId}/verify", [
            'comment' => $comment ?: 'Verified by the system'
        ]);
    }

    /**
     * Approve a stored invoice in Procountor.
     *
     * @param int $invoiceId
     * @param string|null $comment
     * @return \Illuminate\Http\Client\Response
     */
    public function approveInvoice($invoiceId, string $comment = null): Response
    {
        return $this->http()->put("invoices/{$invoiceId}/approve", [
            'comment' => $comment ?: 'Approved by the system'
        ]);
    }

    /**
     * Invalidate a stored invoice in Procountor.
     *
     * @param int $invoiceId
     * @return \Illuminate\Http\Client\Response
     */
    public function invalidateInvoice($invoiceId): Response
    {
        return $this->http()->put("invoices/{$invoiceId}/invalidate");
    }
}
