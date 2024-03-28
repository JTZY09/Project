<?php
// Include the QR code library
require "phpqrcode/qrlib.php";

// Function to generate QR code
function generateQRCode($data) {
    // QR code options
    $options = [
        'version' => 5, // QR code version
        'ecc' => 'H',   // Error correction level (High)
    ];

    // Generate QR code
    ob_start();
    QRcode::png($data, false, $options);
    $qrCode = ob_get_contents();
    ob_end_clean();

    return $qrCode;
}

// Generate QR code with the random 4-digit code
$randomCode = isset($_SESSION['randomCode']) ? $_SESSION['randomCode'] : "";
$qrCodeData = "https://example.com/verify_code.php?code=$randomCode"; // Change the URL to your verify_code.php
$qrCodeImage = generateQRCode($qrCodeData);

// Output the QR code image
header("Content-type: image/png");
echo $qrCodeImage;
