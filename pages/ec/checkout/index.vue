<template>
  <div>
    <SharedSubHeader :title="t('ecommerce.checkout')" />
    <CartCheckout />
  </div>
</template>
<script lang="ts" setup>
import CartCheckout from '~/components/products/CartCheckout.vue';
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('ecommerce.checkout')),
});
</script>