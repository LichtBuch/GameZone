<?php

use GameZone\PDF;

require_once __DIR__ . '/vendor/autoload.php';

$pdf = new PDF();
$pdf->writeTemplate(__DIR__ . '/src/tpl/print.tpl.php');
$pdf->Output('wishlist.pdf', PDF::INLINE);