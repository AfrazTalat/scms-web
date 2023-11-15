<template>
  <section class="all-products">
    <div class="container">
      <div class="row">
        <div class="col-12 mb-5">

          <div class="row">
            <div class="col-lg-4 mb-3">
              <label class="form-label">{{ $t('common.search') }}</label>
              <input v-model="search" type="text" class="form-control"
                :placeholder="$t('ecommerce.search_products_by_name').toString()" />
            </div>
          </div>

          <b-tabs content-class="mt-3" class="custom-tabs" lazy v-model="activeTab">
            <b-tab :title="$t('ecommerce.all_products')">
              <ProductCategoryList :search="search"></ProductCategoryList>
            </b-tab>
            <b-tab v-for="(category, i) in categoriesList?.list" :title="category.name" :key="i">
              <ProductCategoryList :category-id="category.id" :search="search"></ProductCategoryList>
            </b-tab>
          </b-tabs>

          <!-- <div class="row">
            <div class="col-lg-3 col-12 mb-5 px-1" v-for="(product, i) in products" :key="i">
              <ProductBox :product="product" />
            </div>
          </div> -->
        </div>
      </div>

      <!-- <div class="mt-4" v-if="pagination">
        <b-pagination v-model="pagination.current_page" :total-rows="pagination.total" :per-page="pagination.per_page"
          class="numbers-list"></b-pagination>
      </div> -->
    </div>
  </section>
</template>


<script lang="ts" setup>
import ProductCategoryList from '../ecommerce/ProductCategoryList.vue';
import { useCategories } from '~/stores/common/categories';

const categories = useCategories();

const activeTab = ref(0);
const search = ref('');

const categoriesList = (await useAsyncData("categories", () => categories.fetchCategories())).data.value;

</script>

<style lang="scss">
.all-products {
  width: 100%;
  padding: 90px 0px;
  background-color: var(--light);

  .activeTab {
    animation: fadeInLeft 0.4s linear;
  }
}
</style>