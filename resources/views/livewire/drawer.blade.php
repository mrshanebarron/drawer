<div
    x-data="{ open: @entangle('open') }"
    x-show="open"
    x-cloak
    @if($closeOnEscape) @keydown.escape.window="open = false" @endif
    class="fixed inset-0 z-50"
>
    @if($overlay)
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @if($closeOnOverlay) @click="open = false" @endif
        class="fixed inset-0 bg-black/50"
    ></div>
    @endif

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200"
        @class([
            'fixed bg-white shadow-xl flex flex-col',
            'inset-y-0 right-0' => $position === 'right',
            'inset-y-0 left-0' => $position === 'left',
            'inset-x-0 top-0' => $position === 'top',
            'inset-x-0 bottom-0' => $position === 'bottom',
            'w-80' => $size === 'sm' && in_array($position, ['left', 'right']),
            'w-96' => $size === 'md' && in_array($position, ['left', 'right']),
            'w-[32rem]' => $size === 'lg' && in_array($position, ['left', 'right']),
            'h-64' => $size === 'sm' && in_array($position, ['top', 'bottom']),
            'h-96' => $size === 'md' && in_array($position, ['top', 'bottom']),
            'h-[32rem]' => $size === 'lg' && in_array($position, ['top', 'bottom']),
        ])
        :class="{
            'translate-x-full': !open && '{{ $position }}' === 'right',
            '-translate-x-full': !open && '{{ $position }}' === 'left',
            '-translate-y-full': !open && '{{ $position }}' === 'top',
            'translate-y-full': !open && '{{ $position }}' === 'bottom',
        }"
    >
        <div class="flex items-center justify-between p-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">{{ $title }}</h2>
            <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4">
            {{ $slot }}
        </div>
    </div>
</div>
