<template>
  <section class="trade-mark">
    <div class="container">
      <div class="general-heading">
        <h1>{{ $t('brands.brands') }}</h1>

        <p>{{ $t('brands.brands_subtitle') }}</p>

        <img src="@/assets/img/head_icon.svg" />
      </div>

      <loader :loading="loading"></loader>
      <div class="row">
        <div class="col-lg-3 col-12 mb-5" v-for="(brand, i) in brandsList?.list" :key="i">
          <brand-box :brand="brand" />
        </div>

        <div class="buttons-contain">
          <NuxtLink :to="localePath('/trademarks')" class="btn btn-primary">
            <img src="@/assets/img/arrow_left.svg" class="standard-img" />

            <span>{{ $t('ecommerce.view_all_brands') }}</span>

            <img src="@/assets/img/arrow_left.svg" class="hover-img" />
          </NuxtLink>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import { useBrands } from '~/stores/common/brands';
import BrandBox from '../core/brand-box.vue';
import Loader from '../shared/loader.vue';

const localePath = useLocalePath();

const loading = ref(false);
const brands = useBrands();

const brandsList = (await useAsyncData("home-brands", () => brands.fetchBrands()
  .finally(() => loading.value = false))).data.value;

</script>
<style lang="scss">
.trade-mark {
  width: 100%;
  padding: 90px 0px;
  background-color: #fff;

  .buttons-contain {
    width: 100%;
    justify-content: center !important;

    .btn-primary {
      width: 220px !important;
    }
  }
}
</style>