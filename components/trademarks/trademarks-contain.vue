<template>
  <section class="trade-mark">
    <div class="container">
      <loader v-if="loading"></loader>
      <div class="row" v-if="!loading">
        <div class="col-lg-3 col-12 mb-3" v-for="(brand, i) in brandsList?.list" :key="i">
          <brand-box :brand="brand"></brand-box>
        </div>
      </div>
      <div class="mt-4" v-if="brandsList?.pagination">
        <b-pagination
          v-model="brandsList.pagination.current_page"
          :total-rows="brandsList.pagination.total"
          :per-page="brandsList.pagination.per_page"
          class="numbers-list"
        ></b-pagination>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import { mapState } from 'pinia';
import Vue from 'vue';
import BrandBox from '../core/brand-box.vue';
import TradeBox from '../core/trade-box.vue';
import Loader from '../shared/loader.vue';
import { useBrands } from '~/stores/common/brands';


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
}
</style>