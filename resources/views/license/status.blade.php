<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Status - Toko Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <!-- Header -->
        <div
            class="bg-gradient-to-r {{ $isValid ? 'from-green-500 to-emerald-600' : 'from-red-500 to-rose-600' }} p-8 text-center text-white relative overflow-hidden">
            <div
                class="absolute inset-0 bg-white/10 backdrop-blur-sm -skew-y-12 transform origin-bottom-left scale-150">
            </div>
            <div class="relative z-10">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 backdrop-blur-md mb-4 shadow-lg">
                    @if($isValid)
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    @endif
                </div>
                <h1 class="text-2xl font-bold tracking-tight">
                    {{ $isValid ? 'License Active' : 'License Invalid' }}
                </h1>
                <p class="text-white/80 mt-1 text-sm font-medium">
                    {{ $details['client_name'] ?? 'Unknown Client' }}
                </p>
            </div>
        </div>

        <!-- Details -->
        <div class="p-8 space-y-6">

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <label class="block text-gray-400 font-medium mb-1 uppercase text-xs tracking-wider">System
                        Signature</label>
                    <code class="bg-gray-100 text-gray-600 px-2 py-1 rounded block truncate"
                        title="{{ $systemSignature }}">
                        {{ $systemSignature }}
                    </code>
                </div>
                <div>
                    <label class="block text-gray-400 font-medium mb-1 uppercase text-xs tracking-wider">Expiry
                        Date</label>
                    <div class="font-semibold text-gray-700">
                        @if(isset($details['expires_at']) && $details['expires_at'])
                            {{ date('d M Y', $details['expires_at']) }}
                            @if($details['expires_at'] < time())
                                <span class="text-red-500 text-xs ml-1">(Expired)</span>
                            @endif
                        @else
                            <span class="text-green-600">Lifetime License</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 my-6"></div>

            <div>
                <label class="block text-gray-400 font-medium mb-2 uppercase text-xs tracking-wider">License
                    Type</label>
                <div class="flex items-center space-x-3">
                    <div
                        class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">Standard Commercial</div>
                        <div class="text-xs text-gray-500">Authorized for single domain use.</div>
                    </div>
                </div>
            </div>

            @if(!$isValid)
                <div class="mt-8">
                    <a href="{{ route('license.show') }}"
                        class="block w-full bg-gray-900 hover:bg-black text-white text-center font-medium py-3 rounded-lg transition shadow-lg hover:shadow-xl">
                        Activate Now
                    </a>
                </div>
            @endif

            <div class="mt-8 text-center">
                <a href="/"
                    class="text-sm text-gray-400 hover:text-gray-600 transition flex items-center justify-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back to Application</span>
                </a>
            </div>

        </div>
    </div>

</body>

</html>