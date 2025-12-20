# Drawer

A slide-out panel component for Laravel applications. Slides in from any edge of the screen. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/drawer
```

## Livewire Usage

### Basic Usage

```blade
<button wire:click="$set('showDrawer', true)">Open Drawer</button>

<livewire:sb-drawer wire:model="showDrawer" title="Settings">
    <p>Drawer content here</p>
</livewire:sb-drawer>
```

### Different Positions

```blade
<!-- Right side (default) -->
<livewire:sb-drawer wire:model="show" position="right" title="Right Drawer">
    Content
</livewire:sb-drawer>

<!-- Left side -->
<livewire:sb-drawer wire:model="show" position="left" title="Left Drawer">
    Content
</livewire:sb-drawer>

<!-- Top -->
<livewire:sb-drawer wire:model="show" position="top" title="Top Drawer">
    Content
</livewire:sb-drawer>

<!-- Bottom -->
<livewire:sb-drawer wire:model="show" position="bottom" title="Bottom Drawer">
    Content
</livewire:sb-drawer>
```

### Different Sizes

```blade
<livewire:sb-drawer wire:model="show" size="sm" />
<livewire:sb-drawer wire:model="show" size="md" />
<livewire:sb-drawer wire:model="show" size="lg" />
<livewire:sb-drawer wire:model="show" size="xl" />
<livewire:sb-drawer wire:model="show" size="full" />
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `wire:model` | boolean | required | Controls visibility |
| `position` | string | `'right'` | Edge: `left`, `right`, `top`, `bottom` |
| `size` | string | `'md'` | Width/height: `sm`, `md`, `lg`, `xl`, `full` |
| `title` | string | `null` | Header title |
| `close-on-overlay` | boolean | `true` | Close on backdrop click |
| `close-on-escape` | boolean | `true` | Close on Escape key |

## Vue 3 Usage

### Setup

```javascript
import { SbDrawer } from './vendor/sb-drawer';
app.component('SbDrawer', SbDrawer);
```

### Basic Usage

```vue
<template>
  <button @click="showDrawer = true">Open Drawer</button>

  <SbDrawer v-model="showDrawer" title="My Drawer">
    <p>Drawer content goes here</p>
  </SbDrawer>
</template>

<script setup>
import { ref } from 'vue';
const showDrawer = ref(false);
</script>
```

### Positions

```vue
<template>
  <!-- Right (default) -->
  <SbDrawer v-model="show" position="right">...</SbDrawer>

  <!-- Left -->
  <SbDrawer v-model="show" position="left">...</SbDrawer>

  <!-- Top -->
  <SbDrawer v-model="show" position="top">...</SbDrawer>

  <!-- Bottom -->
  <SbDrawer v-model="show" position="bottom">...</SbDrawer>
</template>
```

### Sizes

```vue
<template>
  <SbDrawer v-model="show" size="sm">...</SbDrawer>   <!-- max-w-sm -->
  <SbDrawer v-model="show" size="md">...</SbDrawer>   <!-- max-w-md -->
  <SbDrawer v-model="show" size="lg">...</SbDrawer>   <!-- max-w-lg -->
  <SbDrawer v-model="show" size="xl">...</SbDrawer>   <!-- max-w-xl -->
  <SbDrawer v-model="show" size="full">...</SbDrawer> <!-- max-w-full -->
</template>
```

### Mobile Navigation Example

```vue
<template>
  <button @click="menuOpen = true" class="lg:hidden">
    <MenuIcon />
  </button>

  <SbDrawer v-model="menuOpen" position="left" title="Menu">
    <nav class="space-y-2">
      <a href="/" class="block px-4 py-2 hover:bg-gray-100">Home</a>
      <a href="/products" class="block px-4 py-2 hover:bg-gray-100">Products</a>
      <a href="/about" class="block px-4 py-2 hover:bg-gray-100">About</a>
      <a href="/contact" class="block px-4 py-2 hover:bg-gray-100">Contact</a>
    </nav>
  </SbDrawer>
</template>
```

### Shopping Cart Drawer

```vue
<template>
  <button @click="cartOpen = true">
    Cart ({{ cart.length }})
  </button>

  <SbDrawer v-model="cartOpen" title="Shopping Cart" size="lg">
    <div v-if="cart.length === 0" class="text-center py-8 text-gray-500">
      Your cart is empty
    </div>

    <div v-else class="space-y-4">
      <div v-for="item in cart" :key="item.id" class="flex gap-4 border-b pb-4">
        <img :src="item.image" class="w-16 h-16 object-cover rounded" />
        <div class="flex-1">
          <h4 class="font-medium">{{ item.name }}</h4>
          <p class="text-gray-600">${{ item.price }}</p>
        </div>
        <button @click="removeItem(item.id)">Remove</button>
      </div>

      <div class="border-t pt-4">
        <div class="flex justify-between font-bold">
          <span>Total</span>
          <span>${{ total }}</span>
        </div>
        <button class="w-full mt-4 bg-blue-600 text-white py-2 rounded">
          Checkout
        </button>
      </div>
    </div>
  </SbDrawer>
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | Boolean | `false` | Visibility (v-model) |
| `position` | String | `'right'` | Slide from: `left`, `right`, `top`, `bottom` |
| `size` | String | `'md'` | Panel size |
| `title` | String | `null` | Header title |
| `closeOnOverlay` | Boolean | `true` | Close on backdrop |
| `closeOnEscape` | Boolean | `true` | Close on Escape |

### Events

| Event | Description |
|-------|-------------|
| `update:modelValue` | Emitted when visibility changes |

## Size Reference (Left/Right)

| Size | Max Width |
|------|-----------|
| `sm` | 24rem (384px) |
| `md` | 28rem (448px) |
| `lg` | 32rem (512px) |
| `xl` | 36rem (576px) |
| `full` | 100% |

## Features

- **Four Positions**: Slide from any screen edge
- **Multiple Sizes**: From small to full-width
- **Body Scroll Lock**: Prevents background scrolling
- **Overlay Backdrop**: Semi-transparent background
- **Keyboard Support**: Escape to close

## Accessibility

- Focus management
- Escape key handling
- Proper modal behavior

## Styling

Uses Tailwind CSS:
- White background
- Shadow for depth
- Smooth slide transitions
- Header with close button

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
