<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Faktur Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
        }

        .header p {
            margin: 2px 0;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
            text-decoration: underline;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            vertical-align: top;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .items-table th {
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
        }

        .footer-table {
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(255, 0, 0, 0.2);
            border: 5px solid rgba(255, 0, 0, 0.2);
            padding: 20px;
            z-index: -1000;
            pointer-events: none;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    @if($record->status === 'draft')
        <div class="watermark">DRAFT</div>
    @elseif($record->status === 'cancelled')
        <div class="watermark">DIBATALKAN</div>
    @endif

    <div class="header">
        <h1>BI-OBSES</h1>
        <p>Pasar Buku Palasari No. 82 Bandung 40264 Telp. (022) 7510770, Fax. (022) 754470</p>
        <p>website : http://www.biobses.com email : pemasaran@bioses.com</p>
    </div>

    <div class="title">FAKTUR PENJUALAN</div>

    <table class="info-table">
        <tr>
            <td width="100px">Kepada Yth:</td>
            <td width="300px">
                {{ $record->customer_name }}<br>
                <!-- Address placeholder if available -->
            </td>
            <td width="100px"></td>
            <td width="100px">Kode Cust</td>
            <td>: -</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Nomor Faktur</td>
            <td>: {{ substr($record->id, 0, 8) }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Tanggal</td>
            <td>: {{ $record->sale_date ? \Carbon\Carbon::parse($record->sale_date)->format('d/m/Y') : '-' }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Nomor SP</td>
            <td>: -</td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th width="40" class="text-right">qty</th>
                <th width="80" class="text-right">HARGA</th>
                <th width="40" class="text-right">%</th>
                <th width="80" class="text-right">Brutto</th>
                <th width="80" class="text-right">Netto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($record->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->book->title ?? '-' }}</td>
                    <td>
                        {{ $item->book->authors->pluck('name')->join(', ') }}
                    </td>
                    <td class="text-right">{{ $item->qty }}</td>
                    <td class="text-right">{{ number_format($item->consumer_price, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $item->discount }}</td>
                    <td class="text-right">
                        {{ number_format($item->consumer_price * $item->qty, 0, ',', '.') }}
                    </td>
                    <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <table class="footer-table">
            <tr>
                <td width="60%" style="vertical-align: top;">
                    Mohon untuk di transfer ke Rekening:<br>
                    Atas Nama : Benie Ilman<br>
                    Bank Central Asia, KCP Burangrang Bandung<br>
                    Rekening No : <b>438 6000 301</b>
                </td>
                <td width="40%" style="vertical-align: top;">
                    <table width="100%">
                        <tr>
                            <td class="text-right">Brutto :</td>
                            <td class="text-right">
                                {{ number_format($record->items->sum(fn($i) => $i->consumer_price * $i->qty), 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">Diskon :</td>
                            <td class="text-right">
                                {{ number_format($record->items->sum(fn($i) => ($i->consumer_price * $i->qty) - $i->subtotal), 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right" style="border-top: 1px solid black; padding-top: 5px;"><b>Total Netto
                                    Penjualan :</b></td>
                            <td class="text-right"
                                style="border-top: 1px solid black; padding-top: 5px; border-bottom: 3px double black; padding-bottom: 2px;">
                                <b>{{ number_format($record->total, 0, ',', '.') }}</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br><br>

        <table width="100%">
            <tr>
                <td width="50%" align="center">
                    Diterima Oleh,<br><br><br><br><br>
                    ( {{ $record->customer_name ?? '..............................' }} )
                </td>
                <td width="50%" align="center">
                    Hormat Kami,<br><br><br><br><br>
                    ( {{ $record->seller->name ?? '..............................' }} )
                </td>
            </tr>
        </table>
    </div>
</body>

</html>