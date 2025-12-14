<template>
  <Teleport to="body">
    <Transition name="drawer">
      <div v-if="modelValue" class="fixed inset-0 z-50 overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity" @click="closeOnOverlay && close()"></div>
        <div :class="['absolute bg-white shadow-xl flex flex-col', positionClass, isHorizontal ? sizeClass + ' w-full' : 'h-auto max-h-screen']" @keydown.escape="closeOnEscape && close()">
          <div v-if="title" class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">{{ title }}</h2>
            <button @click="close" class="text-gray-400 hover:text-gray-600">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
          </div>
          <div class="flex-1 overflow-y-auto p-6"><slot></slot></div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script>
import { computed, onMounted, onUnmounted, watch } from 'vue';

export default {
  name: 'SbDrawer',
  props: {
    modelValue: { type: Boolean, default: false },
    position: { type: String, default: 'right' },
    size: { type: String, default: 'md' },
    closeOnOverlay: { type: Boolean, default: true },
    closeOnEscape: { type: Boolean, default: true },
    title: { type: String, default: null }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const sizes = { sm: 'max-w-sm', md: 'max-w-md', lg: 'max-w-lg', xl: 'max-w-xl', full: 'max-w-full' };
    const positions = { left: 'left-0 top-0 h-full', right: 'right-0 top-0 h-full', top: 'top-0 left-0 w-full', bottom: 'bottom-0 left-0 w-full' };
    const sizeClass = computed(() => sizes[props.size] || sizes.md);
    const positionClass = computed(() => positions[props.position] || positions.right);
    const isHorizontal = computed(() => ['left', 'right'].includes(props.position));
    const close = () => emit('update:modelValue', false);
    const handleEscape = (e) => { if (e.key === 'Escape' && props.closeOnEscape && props.modelValue) close(); };
    watch(() => props.modelValue, (val) => { document.body.style.overflow = val ? 'hidden' : ''; });
    onMounted(() => document.addEventListener('keydown', handleEscape));
    onUnmounted(() => { document.removeEventListener('keydown', handleEscape); document.body.style.overflow = ''; });
    return { sizeClass, positionClass, isHorizontal, close };
  }
};
</script>
