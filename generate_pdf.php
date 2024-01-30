<?php
require 'vendor/autoload.php'; // Include Dompdf autoloader

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /**
     * Handling title and date
     * from the form data
     */
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';

    /**
     * Handling image upload and
     * converting the image to base64
     */
    $image = $_FILES['image']['tmp_name'];
    $imageContent = file_get_contents($image);
    $base64Image = base64_encode($imageContent);

    /**
     * Generating PDF
     */
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    $html = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
            </style>
        </head>
        <body>
            <h1>Form Data</h1>
            <p><strong>Title:</strong> $title</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Image:</strong> <img src='data:image/png;base64,$base64Image' alt='Uploaded Image'></p>
        </body>
        </html>
    ";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Output PDF
    $dompdf->stream('form_data.pdf', array('Attachment' => 0));
}
