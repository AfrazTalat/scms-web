<template>
  <b-card :title="brand.name" :img-src="brand.logo ? brand.logo.preview : undefined" :img-alt="brand.name" img-top
    class="trade-box">
    <!-- <img :src="`/assets/img/${flagImg}.svg`" class="flag-img" alt /> -->

    <b-card-text class="desc">{{ brand.description }}</b-card-text>

    <NuxtLink class="product-Number" v-if="brand.products_count && brand.products_count > 0"
      :to="localePath({ name: 'products-brands-brand', params: { brand: brand.id.toString() } })">
      {{ brand.products_count }} {{ $t('ecommerce.products') }}
    </NuxtLink>
    <b-card-text class="product-Number" v-else>
      0 {{ $t('ecommerce.products') }}
    </b-card-text>
  </b-card>
</template>

<script lang="ts" setup>
import { IBrand } from '~/types/resources/common';

defineProps<{
  brand: IBrand,
}>();

const localePath = useLocalePath();
</script>

<style lang="scss">
.trade-box {
  width: 100%;
  padding: 24px 13px;
  background-color: #fff;
  border: 1px solid rgba($color: #14a1d5, $alpha: 0.06);
  box-shadow: 0px 0px 20px rgba($color: #058702, $alpha: 0.06);
  border-radius: 6px;
  position: relative;
  text-align: center;
  display: block;
  transition: all 0.3s linear;
  overflow: hidden;
  z-index: 9;

  &::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 0%;
    top: 0;
    left: 0;
    border-radius: 6px;
    transition: all 0.3s linear;
    z-index: -1;
    background-color: rgba($color: #14a1d5, $alpha: 0.02);
  }

  .card-img-top {
    width: 100px;
    height: 100px;
    object-fit: contain;
    margin: auto;
  }

  .flag-img {
    position: absolute;
    top: 24px;
    right: 13px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
  }

  .card-body {
    padding: 0px !important;
  }

  .card-title {
    font-size: 18px;
    font-weight: 900;
    line-height: 50px;
    color: var(--dark);
    margin: 10px 0px 15px 0px;
  }

  .desc {
    font-size: 14px;
    font-weight: 500;
    color: #989898;
    line-height: 20px;
  }

  .product-Number {
    font-size: 16px;
    font-weight: 700;
    line-height: 20px;
    color: var(--primary-color);
    margin: 0px !important;
  }

  &:hover {
    transform: translateY(-10px);
    border-color: rgba($color: #14a1d5, $alpha: 0.1);

    &::after {
      height: 100%;
    }
  }
}
</style>