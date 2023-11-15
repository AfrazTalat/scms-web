<template>
  <div
    v-if="loading"
    class="loader-content w-100 d-flex align-items-center align-content-center justify-content-center flex-column"
  >
    <div class="loader-shape"></div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
  props: {
    loading: {
      type: Boolean,
      default: true,
    }
  },
})
</script>

<style scoped>
</style>
<style lang="scss" scoped>
.loader-shape {
  width: 90px;
  height: 90px;
  position: relative;
  z-index: 9;

  &::after {
    content: "";
    position: absolute;
    height: 90px;
    width: 90px;
    z-index: -1;
    border-radius: 50%;
    top: 0;
    left: 0;
    animation: animate2 1.5s linear infinite;
    clip: rect(0, 80px, 80px, 40px);
  }
}

@keyframes animate2 {
  0% {
    box-shadow: inset #058702 0 0 0 2px;
    transform: rotate(0deg);
  }

  50% {
    box-shadow: inset #14a1d5 0 0 0 4px;
  }

  100% {
    box-shadow: inset #058702 0 0 0 2px;
    transform: rotate(360deg);
  }
}
</style>