@php
    $config = config('cookie-consent');
    $hasConsent = request()->hasCookie($config['cookie_name']);
@endphp
@if (!request()->cookies->has(config('cookie-consent.cookie_name')))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = true, 10)" x-show="show" style="min-height: 80px;"
        class="fixed z-50 flex flex-col gap-4 p-6 bg-white border border-teal-500 shadow-2xl opacity-65 bottom-4 inset-x-4 rounded-xl dark:bg-gray-900 md:flex-row md:items-center md:justify-between">
        <div class="text-sm text-gray-700 dark:text-gray-200">
            <p>
                Wir verwenden Cookies, um dir die bestmögliche Nutzererfahrung zu bieten und unsere Dienste zu
                verbessern.
                Weitere Informationen findest du in unserer
                <a href="{{ url('/datenschutz') }}" class="text-teal-600 underline hover:text-teal-800">
                    Datenschutzerklärung
                </a>.
            </p>
        </div>

        <div class="flex justify-end gap-3">
            <form method="POST" action="{{ route('cookie-consent.decline') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 text-sm text-gray-700 border border-gray-400 rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                    Ablehnen
                </button>
            </form>

            <form method="POST" action="{{ route('cookie-consent.accept') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-teal-600 rounded-lg shadow-md hover:bg-teal-700">
                    Alle akzeptieren
                </button>
            </form>
        </div>
    </div>
@endif
