<template>
  <div>
    <Loader :loading="loading"></Loader>
    <div class="row" v-if="!loading">
      <div class="col-lg-3 col-12 mb-5 px-1" v-for="(product, i) in productsList?.list" :key="i">
        <ProductBox :product="product" />
      </div>
    </div>
    <Pagination :pagination="productsList?.pagination" :loading="loading" @update:page="loadProducts($event)">
    </Pagination>
  </div>
</template>

<script lang="ts" setup>
import ProductBox from '../core/product-box.vue';
import Loader from "../shared/loader.vue";
import Pagination from "../shared/Pagination.vue";
import { useProducts } from "~/stores/ecommerce/products";

const props = withDefaults(defineProps<{
  categoryId?: number,
  featured?: boolean,
  search?: string
}>(), {
  featured: false
});

const products = useProducts();
const loading = ref(true);

const productsList = ref();
productsList.value = await products.fetchProducts({
  category_id: props.categoryId,
})
  .finally(() => loading.value = false);

const loadProducts = (page = 1, search?: string) => {
  if (loading.value) return
  loading.value = true;
  products.fetchProducts({
    page,
    search,
    category_id: props.categoryId,
  }).then((res) => {
    productsList.value = res;
  })
    .finally(() => loading.value = false);
}

const filter = useDebounce((search?: string) => {
  loadProducts(1, search)
}, 500)

watch(() => props.categoryId, (val) => loadProducts())
watch(() => props.search, (val) => filter(val))
</script>

<style scoped></style>