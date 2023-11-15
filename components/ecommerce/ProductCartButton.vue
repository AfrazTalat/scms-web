<template>
  <BButton variant="primary" @click="addProductToCart()" loading-mode="fill" :loading="loading">{{ $t('ecommerce.add_to_cart') }}</BButton>
</template>

<script setup lang="ts">
import { useCart } from '~/stores/ecommerce/cart';


const props = defineProps<{
  productId: number,
}>()

const cart = useCart();

const loading = ref(false);

const addProductToCart = async () => {
  if (loading.value) return;
  loading.value = true;
  await cart.addProduct(props.productId, {
    qty: 1
  });
  loading.value = false;
}


</script>

<style scoped></style>