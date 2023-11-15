<template>
  <section class="products general-pattern">
    <div class="container">
      <div class="general-heading">
        <h1>{{ $t('ecommerce.our_products') }}</h1>
        <p>{{ $t('ecommerce.our_products_subtitle') }}</p>
        <img src="@/assets/img/head_icon.svg" />
      </div>

      <Loader :loading="loading"></Loader>

      <div class="row" v-if="!loading">

        <div class="col-12 mb-5">
          <b-tabs content-class="mt-3" class="custom-tabs" lazy>
            <b-tab v-for="(category, i) in categoriesList?.list" :title="category.name" :key="i">
              <product-category-list :category-id="category.id" :featured="true"></product-category-list>
            </b-tab>
          </b-tabs>
        </div>

        <div class="buttons-contain">
          <NuxtLink :to="localePath('/products')" class="btn btn-primary">
            <img src="@/assets/img/arrow_left.svg" class="standard-img" />

            <span>{{ $t('ecommerce.view_all_products') }}</span>

            <img src="@/assets/img/arrow_left.svg" class="hover-img" />
          </NuxtLink>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import { useCategories } from '~/stores/common/categories';
import ProductCategoryList from '../ecommerce/ProductCategoryList.vue';
import Loader from '../shared/loader.vue';

const localePath = useLocalePath();

const loading = ref(false);
const categories = useCategories();

const categoriesList = (await useAsyncData("categories", () => categories.fetchCategories()
  .finally(() => loading.value = false))).data.value;

</script>

<style lang="scss">
.products {
  background-color: rgba($color: #058702, $alpha: 0.03);
  width: 100%;
  padding: 90px 0px;

  .general-heading {
    margin-bottom: 50px !important;
  }

  .activeTab {
    animation: fadeInLeft 0.4s linear;
  }

  .buttons-contain {
    width: 100%;
    justify-content: center !important;

    .btn-primary {
      width: 220px !important;
    }
  }
}
</style>