<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }} - COY BILTONG</title>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; color: #171717; margin: 0; padding: 30px; font-size: 13px; line-height: 1.5; background: #fff; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #ECE2D2; border-radius: 12px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #171717; padding-bottom: 20px; }
        .brand { font-size: 24px; font-weight: 800; letter-spacing: -0.5px; }
        .brand span { color: #B77B3B; }
        .tagline { font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: #68734B; font-weight: 700; }
        .meta { text-align: right; font-size: 12px; color: #555; }
        .section { margin-top: 25px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; padding: 10px; background: #F6F0E6; font-size: 11px; text-transform: uppercase; font-weight: 700; border-bottom: 1px solid #ECE2D2; }
        td { padding: 12px 10px; border-bottom: 1px solid #ECE2D2; font-size: 12px; }
        .totals { margin-top: 20px; float: right; width: 300px; }
        .totals table td { border: none; padding: 4px 0; }
        .totals .grand-total { font-size: 16px; font-weight: 800; border-top: 2px solid #171717; padding-top: 8px; }
        .print-btn { background: #171717; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; cursor: pointer; margin-bottom: 20px; }
        @media print { .print-btn { display: none; } }
    </style>
</head>
<body>

<div class="invoice-box">
    <button class="print-btn" onclick="window.print()">🖨️ Print Invoice / Save as PDF</button>

    <div class="header">
        <div>
            <div class="brand">COY<span>.</span>BILTONG</div>
            <div class="tagline">Real Meat. Real Taste.</div>
            <div style="font-size: 11px; color: #666; margin-top: 5px;">
                COY BILTONG LIMITED<br>
                Dar es Salaam, Tanzania<br>
                Phone / WhatsApp: +255 768 123 456
            </div>
        </div>
        <div class="meta">
            <h2 style="margin: 0; font-size: 20px; color: #171717;">INVOICE</h2>
            <p style="margin: 4px 0;"><strong>#{{ $order->order_number }}</strong></p>
            <p style="margin: 4px 0;">Date: {{ $order->created_at->format('M d, Y') }}</p>
            <p style="margin: 4px 0;">Status: <strong>{{ strtoupper($order->payment_status) }}</strong></p>
        </div>
    </div>

    <div class="section grid-2">
        <div>
            <strong style="font-size: 11px; text-transform: uppercase; color: #888;">Billed & Delivered To:</strong>
            <p style="margin: 4px 0; font-weight: 700; font-size: 14px;">{{ $order->customer_name }}</p>
            <p style="margin: 2px 0;">Phone: {{ $order->customer_phone }}</p>
            @if($order->customer_email)<p style="margin: 2px 0;">Email: {{ $order->customer_email }}</p>@endif
            <p style="margin: 2px 0;">{{ $order->delivery_address }}</p>
            <p style="margin: 2px 0;">{{ $order->delivery_area }}, {{ $order->delivery_city }}</p>
        </div>
        <div>
            <strong style="font-size: 11px; text-transform: uppercase; color: #888;">Payment Information:</strong>
            <p style="margin: 4px 0;">Method: <strong>{{ strtoupper($order->payment_method) }}</strong></p>
            <p style="margin: 2px 0;">Payment Status: <strong>{{ ucfirst($order->payment_status) }}</strong></p>
            @if($order->payment_reference)<p style="margin: 2px 0;">Reference: <code>{{ $order->payment_reference }}</code></p>@endif
            <p style="margin: 2px 0;">Delivery Carrier: {{ $order->delivery?->carrier ?? $order->delivery_method }}</p>
        </div>
    </div>

    <table class="section">
        <thead>
            <tr>
                <th>Description</th>
                <th>Pack Size</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th style="text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td><strong>{{ $item->product_name }}</strong></td>
                    <td>{{ $item->pack_size }}</td>
                    <td>TZS {{ number_format($item->unit_price, 0) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td style="text-align: right;">TZS {{ number_format($item->subtotal, 0) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td>Subtotal:</td>
                <td style="text-align: right;">TZS {{ number_format($order->subtotal, 0) }}</td>
            </tr>
            @if($order->discount_amount > 0)
                <tr style="color: #047857;">
                    <td>Discount:</td>
                    <td style="text-align: right;">-TZS {{ number_format($order->discount_amount, 0) }}</td>
                </tr>
            @endif
            <tr>
                <td>Delivery Fee:</td>
                <td style="text-align: right;">{{ $order->delivery_fee == 0 ? 'FREE' : 'TZS ' . number_format($order->delivery_fee, 0) }}</td>
            </tr>
            <tr class="grand-total">
                <td>Total:</td>
                <td style="text-align: right; color: #171717;">TZS {{ number_format($order->total, 0) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ECE2D2; text-align: center; font-size: 11px; color: #888;">
        Thank you for choosing COY BILTONG! Handcrafted prime beef biltong. Questions? Contact info@coybiltong.co.tz.
    </div>
</div>

</body>
</html>
