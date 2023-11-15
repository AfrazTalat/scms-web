<template>
  <div>
    <sub-header />
    <products-contain />
  </div>
</template>
<script lang="ts" setup>
import ProductsContain from '@/components/products/products-contain.vue';
import SubHeader from '@/components/products/sub-header.vue';
import { useSettings } from '~/stores/settings';


const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('ecommerce.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('ecommerce.meta.description'),
    }
  ]
});
</script>