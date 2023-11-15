<template>
  <div>
    <SharedSubHeader :title="t('ecommerce.shopping_cart')" />
    <Cart />
  </div>
</template>
<script lang="ts" setup>
import Cart from '~/components/products/Cart.vue';
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('ecommerce.shopping_cart')),
});
</script>