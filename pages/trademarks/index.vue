<template>
  <div>
    <sub-header />
    <trademarks-contain />
  </div>
</template>
<script lang="ts" setup>
import SubHeader from '@/components/trademarks/sub-header.vue';
import TrademarksContain from '@/components/trademarks/trademarks-contain.vue';
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('brands.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('brands.meta.description'),
    }
  ]
});
</script>