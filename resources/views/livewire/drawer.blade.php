@php
$sizeWidths = [
    'sm' => '20rem',
    'md' => '28rem',
    'lg' => '36rem',
    'xl' => '42rem',
    'full' => '100%'
];
$sizeWidth = $sizeWidths[$size] ?? $sizeWidths['md'];

$positionStyles = [
    'left' => 'left: 0; top: 0; height: 100%;',
    'right' => 'right: 0; top: 0; height: 100%;',
    'top' => 'top: 0; left: 0; width: 100%;',
    'bottom' => 'bottom: 0; left: 0; width: 100%;',
];
$posStyle = $positionStyles[$position] ?? $positionStyles['right'];

$isHorizontal = in_array($position, ['left', 'right']);
$panelStyle = $posStyle . ' position: absolute; background-color: white; box-shadow: -10px 0 15px -3px rgba(0,0,0,0.1); display: flex; flex-direction: column;';
if ($isHorizontal) {
    $panelStyle .= " width: 100%; max-width: {$sizeWidth};";
} else {
    $panelStyle .= ' height: auto; max-height: 100vh;';
}
@endphp

<div
    x-data
    @if($closeOnEscape) x-on:keydown.escape.window="$wire.close()" @endif
>
    @if($open)
        <div style="position: fixed; inset: 0; z-index: 50; overflow: hidden;">
            {{-- Overlay --}}
            <div
                style="position: absolute; inset: 0; background-color: rgba(0,0,0,0.5); transition: opacity 0.3s;"
                @if($closeOnOverlay) wire:click="close" @endif
            ></div>

            {{-- Drawer Panel --}}
            <div style="{{ $panelStyle }}">
                {{-- Header --}}
                @if($title)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb;">
                        <h2 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">{{ $title }}</h2>
                        <button
                            wire:click="close"
                            style="color: #9ca3af; background: none; border: none; cursor: pointer; padding: 0.25rem;"
                            onmouseover="this.style.color='#4b5563'"
                            onmouseout="this.style.color='#9ca3af'"
                        >
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                {{-- Content --}}
                <div style="flex: 1; overflow-y: auto; padding: 1.5rem;">
                    {{ $slot }}
                </div>
            </div>
        </div>
    @endif
</div>
