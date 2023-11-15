<template>
  <img v-if="$setting('app_logo')?.attachment?.preview" :src="$setting('app_logo')?.attachment?.preview"
    class="brand-image" :alt="`${$setting('app_name').value} logo`" />
  <img v-else src="@/assets/img/your-logo.png" class="brand-image" :alt="`${$setting('app_name').value} logo`" />
</template>