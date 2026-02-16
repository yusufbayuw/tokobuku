<x-filament-panels::page>
    <x-filament::section>
        {{ $this->form }}
    </x-filament::section>

    @if(($this->data['report_type'] ?? 'penjualan') === 'penjualan')
    <div x-data="{ activeTab: 'lokasi' }" wire:key="report-penjualan">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex gap-6" aria-label="Tabs">
                <button @click="activeTab = 'lokasi'"
                    :class="activeTab === 'lokasi' ? 'border-primary-500 text-primary-600 dark:text-primary-400 dark:border-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Per Lokasi
                </button>
                <button @click="activeTab = 'buku'"
                    :class="activeTab === 'buku' ? 'border-primary-500 text-primary-600 dark:text-primary-400 dark:border-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Per Buku
                </button>
                <button @click="activeTab = 'penerbit'"
                    :class="activeTab === 'penerbit' ? 'border-primary-500 text-primary-600 dark:text-primary-400 dark:border-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Per Penerbit
                </button>
                <button @click="activeTab = 'waktu'"
                    :class="activeTab === 'waktu' ? 'border-primary-500 text-primary-600 dark:text-primary-400 dark:border-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Per Waktu
                </button>
            </nav>
        </div>
        
        <div class="mt-4">
            <!-- Lokasi Tab -->
            <div x-show="activeTab === 'lokasi'" class="space-y-4">
                <h3 class="text-lg font-bold">Laporan Penjualan Per Lokasi</h3>
                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Lokasi</th>
                                <th class="px-6 py-3 text-right">Total Transaksi</th>
                                <th class="px-6 py-3 text-right">Pendapatan</th>
                                <th class="px-6 py-3 text-right">Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->getSalesByLocation() as $row)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $row->location->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">{{ number_format($row->total_sales, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">Rp {{ number_format($row->revenue, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right text-green-600">Rp
                                        {{ number_format($row->profit, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Buku Tab -->
            <div x-show="activeTab === 'buku'" class="space-y-4" style="display: none;">
                <h3 class="text-lg font-bold">Top 50 Penjualan Buku</h3>
                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Judul Buku</th>
                                <th class="px-6 py-3 text-right">Terjual (Qty)</th>
                                <th class="px-6 py-3 text-right">Pendapatan</th>
                                <th class="px-6 py-3 text-right">Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->getSalesByBook() as $row)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $row->book->title ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">{{ number_format($row->total_qty, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right">Rp {{ number_format($row->revenue, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right text-green-600">Rp
                                        {{ number_format($row->profit, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Penerbit Tab -->
            <div x-show="activeTab === 'penerbit'" class="space-y-4" style="display: none;">
                <h3 class="text-lg font-bold">Laporan Penjualan Per Penerbit</h3>
                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Penerbit</th>
                                <th class="px-6 py-3 text-right">Terjual (Qty)</th>
                                <th class="px-6 py-3 text-right">Pendapatan</th>
                                <th class="px-6 py-3 text-right">Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->getSalesByPublisher() as $row)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $row->publisher_name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">{{ number_format($row->total_qty, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right">Rp {{ number_format($row->revenue, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right text-green-600">Rp
                                        {{ number_format($row->profit, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Waktu Tab -->
            <div x-show="activeTab === 'waktu'" class="space-y-4" style="display: none;">
                <h3 class="text-lg font-bold">Laporan Penjualan Per Waktu (Harian)</h3>
                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3 text-right">Total Transaksi</th>
                                <th class="px-6 py-3 text-right">Pendapatan</th>
                                <th class="px-6 py-3 text-right">Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->getSalesByTime() as $row)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ \Carbon\Carbon::parse($row->date)->format('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">{{ number_format($row->total_sales, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">Rp {{ number_format($row->revenue, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right text-green-600">Rp
                                        {{ number_format($row->profit, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @elseif(($this->data['report_type'] ?? 'penjualan') === 'stok')
    <div x-data="{ activeTab: 'ringkasan' }" wire:key="report-stok">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex gap-6" aria-label="Tabs">
                <button @click="activeTab = 'ringkasan'"
                    :class="activeTab === 'ringkasan' ? 'border-primary-500 text-primary-600 dark:text-primary-400 dark:border-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Ringkasan Stok
                </button>
                <button @click="activeTab = 'buku'"
                    :class="activeTab === 'buku' ? 'border-primary-500 text-primary-600 dark:text-primary-400 dark:border-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Stok Per Buku
                </button>
                <button @click="activeTab = 'penerbit'"
                    :class="activeTab === 'penerbit' ? 'border-primary-500 text-primary-600 dark:text-primary-400 dark:border-primary-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Stok Per Penerbit
                </button>
            </nav>
        </div>

        <div class="mt-4">
            <!-- Ringkasan Tab -->
            <div x-show="activeTab === 'ringkasan'" class="space-y-4">
                    <h3 class="text-lg font-bold">Ringkasan Aset Stok Per Lokasi</h3>
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Lokasi</th>
                                    <th class="px-6 py-3 text-right">Total Stok (Qty)</th>
                                    <th class="px-6 py-3 text-right">Nilai Aset (Modal)</th>
                                    <th class="px-6 py-3 text-right">Potensi Omset (Retail)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($this->getStockSummary() as $row)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $row->location_name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-right">{{ number_format($row->total_qty, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-blue-600">Rp
                                            {{ number_format($row->total_asset_value, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-green-600">Rp
                                            {{ number_format($row->total_retail_potential, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Buku Tab -->
                <div x-show="activeTab === 'buku'" class="space-y-4" style="display: none;">
                    <h3 class="text-lg font-bold">Posisi Stok Per Buku</h3>
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Judul Buku</th>
                                    <th class="px-6 py-3 text-right">Harga Agen</th>
                                    <th class="px-6 py-3 text-right">Harga Eceran</th>
                                    <th class="px-6 py-3 text-right">Stok (Qty)</th>
                                    <th class="px-6 py-3 text-right">Nilai Aset</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($this->getStockByBook() as $row)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $row->title ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-right">Rp {{ number_format($row->agent_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-right">Rp {{ number_format($row->retail_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold">
                                            {{ number_format($row->total_qty, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-blue-600">Rp
                                            {{ number_format($row->asset_value, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Penerbit Tab -->
                <div x-show="activeTab === 'penerbit'" class="space-y-4" style="display: none;">
                    <h3 class="text-lg font-bold">Stok Per Penerbit</h3>
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Penerbit</th>
                                    <th class="px-6 py-3 text-right">Stok (Qty)</th>
                                    <th class="px-6 py-3 text-right">Nilai Aset</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($this->getStockByPublisher() as $row)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $row->publisher_name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold">
                                            {{ number_format($row->total_qty, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-blue-600">Rp
                                            {{ number_format($row->asset_value, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>