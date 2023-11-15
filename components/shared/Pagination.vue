<template>
  <div class="mt-4" v-if="pagination">
    <b-pagination v-model="pagination.current_page" :total-rows="pagination.total" :per-page="pagination.per_page"
      class="numbers-list" :disabled="loading" @change="$emit('update:page', $event)"></b-pagination>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { IPagination } from '~/types/common/interface';

export default defineComponent({
  props: {
    pagination: {
      type: Object as () => IPagination,
    },
    loading: {
      type: Boolean,
      default: false,
    }
  }
})
</script>
