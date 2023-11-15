<template>
  <div>
    <SubHeader :brand="brand" />
    <section class="all-products">
      <div class="container">
        <Loader :loading="loading"></Loader>
        <div class="row" v-if="!loading">
          <div class="col-lg-3 col-12 mb-5 px-1" v-for="(product, i) in productsList?.list" :key="i">
            <ProductBox v-if="product" :product="product" />
          </div>
        </div>
        <Pagination :pagination="products.products.pagination" :loading="loading"></Pagination>
      </div>
    </section>
  </div>
</template>

<script lang="ts" setup>
import SubHeader from '@/components/products/sub-header.vue';
import ProductBox from '~/components/core/product-box.vue';
import Loader from '~/components/shared/loader.vue';
import Pagination from '~/components/shared/Pagination.vue';
import { useProducts } from '~/stores/ecommerce/products';
import { useSettings } from '~/stores/settings';
import { IBrand } from '~/types/resources/common';


const { t } = useI18n();
const { webTitle } = useSettings();
const route = useRoute();

const products = useProducts();

const loading = ref(false)
const brand = ref<IBrand>();

useHead({
  title: webTitle(brand.value?.name),
});

const productsList = (await useAsyncData("products", () => products.fetchProducts({
  brand_id: route.params.brand
})
  .finally(() => loading.value = false))).data.value;

</script>