<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Form Print QR Code Label' ?></title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('print-form') ?>">Form Print QR Code Label</a>
        <div>
            <a href="<?= base_url('print-form') ?>" class="btn btn-sm btn-outline-light me-2">Form Print</a>
            <a href="<?= base_url('master') ?>" class="btn btn-sm btn-outline-light">Master Data</a>
        </div>
    </div>
</nav>
<div class="container-fluid">
