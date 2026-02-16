<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate License - Toko Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 bg-gray-800 rounded-2xl shadow-xl border border-gray-700">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                License Required
            </h1>
            <p class="text-gray-400 mt-2">
                Verify this installation to continue.
            </p>
        </div>

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('license.activate') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">System Signature</label>
                <div class="flex items-center space-x-2">
                    <code
                        class="w-full bg-gray-900/50 block px-4 py-3 rounded-lg text-gray-300 font-mono text-sm border border-gray-700 select-all">
                        {{ $signature }}
                    </code>
                </div>
                <p class="text-xs text-gray-500 mt-1">Provide this signature to the developer to get a license key.</p>
            </div>

            <div>
                <label for="license_key" class="block text-sm font-medium text-gray-400 mb-1">License Key</label>
                <textarea name="license_key" rows="4"
                    class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-gray-600"
                    placeholder="Paste your license key here..."></textarea>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-medium py-3 rounded-lg transition-all shadow-lg hover:shadow-blue-500/25">
                Activate Software
            </button>
        </form>

        <div class="mt-8 text-center text-xs text-gray-600">
            &copy; {{ date('Y') }} Toko Buku App. Verify via secure activation.
        </div>
    </div>

</body>

</html>