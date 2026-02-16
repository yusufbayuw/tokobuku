<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan {{ $title }}</title>
    <style>
        @page {
            margin: 0.5cm;
            size: A4;
        }

        body {
            font-family: sans-serif;
            font-size: 10pt;
            line-height: normal;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-left {
            width: 70%;
            float: left;
        }

        .header-right {
            width: 30%;
            float: right;
            text-align: right;
        }

        .company-name {
            font-size: 16pt;
            font-weight: bold;
            color: #1a56db;
        }

        .report-title {
            font-size: 14pt;
            font-weight: bold;
            margin-top: 10px;
            text-transform: uppercase;
        }

        .meta-info {
            font-size: 9pt;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
            font-weight: bold;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            font-size: 8pt;
            text-align: right;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }

        .summary-box {
            margin-top: 20px;
            border: 1px solid #000;
            padding: 10px;
            width: 40%;
            float: right;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <div class="header clearfix">
        <div class="header-left">
            <div class="company-name">{{ config('app.name', 'Toko Buku') }}</div>
            <div class="meta-info">
                @if($location)
                    Lokasi: <strong>{{ $location }}</strong><br>
                @else
                    Lokasi: <strong>Semua Lokasi</strong><br>
                @endif

                @if($startDate && $endDate)
                    Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
                    {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
                @else
                    Per Tanggal: {{ now()->format('d/m/Y H:i') }}
                @endif
            </div>
        </div>
        <div class="header-right">
            <div class="report-title">{{ $title }}</div>
            <div class="meta-info">Cetak: {{ now()->format('d/m/Y H:i') }}</div>
        </div>
    </div>

    <!-- Dynamic Content Table -->
    <table>
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($columns as $col)
                        <td class="{{ isset($col['align']) ? 'text-' . $col['align'] : '' }}">
                            @if(isset($col['format']) && $col['format'] === 'currency')
                                Rp {{ number_format($row->{$col['key']}, 0, ',', '.') }}
                            @elseif(isset($col['format']) && $col['format'] === 'number')
                                {{ number_format($row->{$col['key']}, 0, ',', '.') }}
                            @elseif(isset($col['callback']))
                                {{ $col['callback']($row) }}
                            @else
                                {{ $row->{$col['key']} ?? '-' }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        @if(isset($totals))
            <tfoot>
                <tr style="background-color: #f9fafb; font-weight: bold;">
                    @foreach($columns as $index => $col)
                        @if($index === 0)
                            <td class="text-center">TOTAL</td>
                        @elseif(isset($totals[$col['key']]))
                            <td class="text-right">
                                @if(isset($col['format']) && $col['format'] === 'currency')
                                    Rp {{ number_format($totals[$col['key']], 0, ',', '.') }}
                                @else
                                    {{ number_format($totals[$col['key']], 0, ',', '.') }}
                                @endif
                            </td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="footer">
        Halaman <span class="page-number"></span>
    </div>
</body>

</html>