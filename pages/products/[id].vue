<template>
  <div v-if="product">
    <ProductHeader :loading="loading" :product="product" :key="`product-head-${product.id}`" />
    <ProductDetails :loading="loading" :product="product" :key="`product-body-${product.id}`" />
  </div>
</template>
<script lang="ts" setup>
import ProductDetails from '~/components/ecommerce/product-view/product-details.vue';
import ProductHeader from '~/components/ecommerce/product-view/product-header.vue';
import { useProducts } from '~/stores/ecommerce/products';
import { useSettings } from "~/stores/settings";
import { IProduct } from "~/types/resources/ecommerce";

const route = useRoute();
const { t } = useI18n();
const { webTitle } = useSettings();
const products = useProducts();

const loading = ref(false);
const productReq = await useAsyncData<IProduct>("product", () => products.getProduct(+route.params.id));
const product = ref(productReq.data.value);

useHead({
  title: webTitle(product.value?.name),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: product.value?.subtitle,
    }
  ]
});

watch(() => route.params.id, (val) => productReq.refresh().then(() => product.value = productReq.data.value))
</script>