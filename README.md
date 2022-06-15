<p>
  <img src="https://biila.io/images/biila.svg" width="150">
</p>

# Laravel Wrapper for Procountor API

<p>
  <a href="https://packagist.org/packages/biila-io/laravel-procountor-api">
    <img src="https://img.shields.io/packagist/dt/biila-io/laravel-procountor-api" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/biila-io/laravel-procountor-api">
    <img src="https://img.shields.io/packagist/v/biila-io/laravel-procountor-api" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/biila-io/laravel-procountor-api">
    <img src="https://img.shields.io/packagist/l/biila-io/laravel-procountor-api" alt="License">
  </a>
</p>

## Installation

Install the package with Composer:

    composer require biila-io/laravel-procountor-api

The package will automatically register itself.

## Methods

- `Procountor::getConfig()`
  - Get the Procountor config instance.
- `Procountor::accessToken()`
  - Get the access token.
- `Procountor::accessTokenExpiresAt()`
  - Get the access token expiration time.
- `Procountor::refreshAccessToken()`
  - Refresh the access token.
- `Procountor::getInvoices($query)`
  - Get a list of invoices.
- `Procountor::getInvoice($invoiceId)`
  - Get the details for given invoice id.
- `Procountor::storeInvoice($data)`
  - Store invoice to Procountor with given data.
- `Procountor::verifyInvoice($invoiceId)`
  - Verify a stored invoice in Procountor.
- `Procountor::approveInvoice($invoiceId)`
  - Approve a stored invoice in Procountor.
- `Procountor::invalidateInvoice($invoiceId)`
  - Invalidate a stored invoice in Procountor.
- `Procountor::getAttachments($query)`
  - Get a list of attachments.
- `Procountor::getAttachment($attachmentId)`
  - Get details of given attachment id.
- `Procountor::uploadAttachment($filePath, $referenceId, $disk, $filename)`
  - Upload an attachment to Procountor.

## License

Convenient Laravel Commands is open-sourced software licensed under the [MIT license](LICENSE.md).
