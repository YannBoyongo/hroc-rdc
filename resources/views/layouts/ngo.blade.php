<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Healing and Rebuilding Our Communities (HROC RDC) - Organisation non gouvernementale œuvrant pour la paix, les droits de l'homme, la gouvernance et le développement durable en RDC.">

    <title>@yield('title', 'HROC RDC - Healing and Rebuilding Our Communities')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if(config('app.env') === 'production')
        @php
            $manifestPath = public_path('build/manifest.json');
            $manifest = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
        @endphp
        @if($manifest)
            @if(isset($manifest['resources/css/app.css']))
                <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
            @endif
            @if(isset($manifest['resources/js/app.js']))
                <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>
            @endif
        @else
            {{-- Fallback si le manifest n'existe pas --}}
            <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
            <script type="module" src="{{ asset('build/assets/app.js') }}"></script>
        @endif
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    @stack('styles')
    
    <!-- Google Translate -->
    <style>
        /* Hide Google Translate bar completely */
        .goog-te-banner-frame,
        .goog-te-banner-frame.skiptranslate,
        body {
            top: 0 !important;
        }
        .goog-te-banner-frame {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            max-height: 0 !important;
            overflow: hidden !important;
        }
        /* Hide the Google Translate top bar */
        .skiptranslate {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            max-height: 0 !important;
            overflow: hidden !important;
        }
        /* Ensure body doesn't get pushed down */
        body {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
    </style>
    <script type="text/javascript">
        window.googleTranslateInit = function() {
            if (typeof google !== 'undefined' && google.translate) {
                new google.translate.TranslateElement({
                    pageLanguage: 'fr',
                    includedLanguages: 'fr,en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    autoDisplay: false
                }, 'google_translate_element');
                
                // Hide the Google Translate banner immediately after initialization
                setTimeout(() => {
                    const banner = document.querySelector('.goog-te-banner-frame');
                    if (banner) {
                        banner.style.display = 'none';
                        banner.style.visibility = 'hidden';
                        banner.style.height = '0';
                        banner.style.maxHeight = '0';
                        banner.style.overflow = 'hidden';
                    }
                    const skipTranslate = document.querySelector('.skiptranslate');
                    if (skipTranslate) {
                        skipTranslate.style.display = 'none';
                        skipTranslate.style.visibility = 'hidden';
                        skipTranslate.style.height = '0';
                        skipTranslate.style.maxHeight = '0';
                        skipTranslate.style.overflow = 'hidden';
                    }
                    // Remove top margin/padding from body
                    document.body.style.marginTop = '0';
                    document.body.style.paddingTop = '0';
                }, 100);
            }
        };
        
        function googleTranslateElementInit() {
            window.googleTranslateInit();
        }
        
        // Load Google Translate script
        if (typeof google === 'undefined' || !google.translate) {
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            script.async = true;
            document.head.appendChild(script);
        } else {
            googleTranslateElementInit();
        }
        
        // Continuously hide Google Translate banner
        setInterval(() => {
            const banner = document.querySelector('.goog-te-banner-frame');
            if (banner) {
                banner.style.display = 'none';
                banner.style.visibility = 'hidden';
                banner.style.height = '0';
                banner.style.maxHeight = '0';
                banner.style.overflow = 'hidden';
            }
            const skipTranslate = document.querySelector('.skiptranslate');
            if (skipTranslate) {
                skipTranslate.style.display = 'none';
                skipTranslate.style.visibility = 'hidden';
                skipTranslate.style.height = '0';
                skipTranslate.style.maxHeight = '0';
                skipTranslate.style.overflow = 'hidden';
            }
            document.body.style.marginTop = '0';
            document.body.style.paddingTop = '0';
        }, 100);
        
        // Helper function to trigger Google Translate language change
        window.triggerGoogleTranslate = function(langCode) {
            // Set cookie first
            document.cookie = `googtrans=/auto/${langCode};path=/;max-age=31536000`;
            
            // Try to find and trigger the select element
            const tryTrigger = () => {
                const selectElement = document.querySelector('#google_translate_element select');
                if (selectElement && selectElement.options && selectElement.options.length > 0) {
                    const options = Array.from(selectElement.options);
                    let targetIndex = -1;
                    
                    if (langCode === 'fr') {
                        targetIndex = 0; // First option is usually original language
                    } else {
                        // Find option containing the target language
                        for (let i = 0; i < options.length; i++) {
                            const val = options[i].value;
                            if (val && val.includes(langCode)) {
                                targetIndex = i;
                                break;
                            }
                        }
                    }
                    
                    if (targetIndex >= 0 && selectElement.selectedIndex !== targetIndex) {
                        selectElement.selectedIndex = targetIndex;
                        selectElement.dispatchEvent(new Event('change', { bubbles: true }));
                        return true;
                    }
                }
                return false;
            };
            
            // Try immediately
            if (tryTrigger()) {
                return;
            }
            
            // Wait a bit and try again
            setTimeout(() => {
                if (!tryTrigger()) {
                    // Fallback: reload page to apply cookie
                    window.location.reload();
                }
            }, 500);
        };
    </script>
    <div id="google_translate_element" style="display: none !important; position: absolute; left: -9999px; width: 0; height: 0; overflow: hidden;"></div>
</head>
<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex flex-col">
        @include('components.navbar')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('components.footer')
        
        @include('components.back-to-top')
        
        @stack('scripts')
    </div>
</body>
</html>

