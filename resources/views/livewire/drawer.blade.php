@php
$sizes = ['sm' => 'max-w-sm', 'md' => 'max-w-md', 'lg' => 'max-w-lg', 'xl' => 'max-w-xl', 'full' => 'max-w-full'];
$sizeClass = $sizes[$size] ?? $sizes['md'];
$positions = [
    'left' => 'left-0 top-0 h-full',
    'right' => 'right-0 top-0 h-full',
    'top' => 'top-0 left-0 w-full',
    'bottom' => 'bottom-0 left-0 w-full',
];
$posClass = $positions[$position] ?? $positions['right'];
$isHorizontal = in_array($position, ['left', 'right']);
@endphp

<div>
    @if($open)
        <div class="fixed inset-0 z-50 overflow-hidden">
            {{-- Overlay --}}
            <div
                class="absolute inset-0 bg-black bg-opacity-50 transition-opacity"
                @if($closeOnOverlay) wire:click="close" @endif
            ></div>

            {{-- Drawer Panel --}}
            <div
                class="absolute {{ $posClass }} {{ $isHorizontal ? $sizeClass . ' w-full' : 'h-auto max-h-screen' }} bg-white shadow-xl flex flex-col"
                @if($closeOnEscape) x-data @keydown.escape.window="$wire.close()" @endif
            >
                {{-- Header --}}
                @if($title)
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $title }}</h2>
                        <button wire:click="close" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                {{-- Content --}}
                <div class="flex-1 overflow-y-auto p-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    @endif
</div>
