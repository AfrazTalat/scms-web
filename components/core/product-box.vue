<template>
  <b-card :title="`${product.name}`" :img-src="previewImage" :img-alt="product.name" img-top class="product-box">
    <b-card-text class="desc"
      style="min-height: 156px; max-height: 156px; height: 156px; overflow: hidden; text-overflow: ellipsis;">
      {{ product.subtitle }}
    </b-card-text>

    <!-- <ul class="flex-data">
      <li>
        <img src="@/assets/img/product_logo_1.webp" alt />
      </li>

      <li>
        <img src="@/assets/img/product_logo_2.webp" alt />
      </li>
    </ul>-->

    <b-card-text class="price">{{ product.price }} ر.س</b-card-text>

    <div class="buttons-contain">
      <NuxtLink :to="localePath(`/products/${product.id.toString()}`)"
        class="btn btn-outline-primary">
        <img src="@/assets/img/blue_arrow.svg" class="standard-img" />

        <span>{{ $t('ecommerce.product_details') }}</span>

        <img src="@/assets/img/blue_arrow.svg" class="hover-img" />
      </NuxtLink>
    </div>
  </b-card>
</template>

<script lang="ts" setup>
import { IProduct } from "~/types/resources/ecommerce";

const props = defineProps<{
  product: IProduct,
}>();

const localePath = useLocalePath();

const previewImage = computed<string | undefined>(() => {
  return props.product.images?.[0]?.preview;
})
</script>

<style lang="scss">
.product-box {
  width: 100%;
  background-color: #fff;
  border-radius: 6px;
  overflow: hidden;
  border: 0px;
  padding-top: 10px;
  box-shadow: 0px 0px 20px rgba($color: #058702, $alpha: 0.06);
  transition: all 0.4s linear;

  .card-img-top {
    width: 100%;
    height: 187px;
    object-fit: contain;
    object-position: center;
  }

  .card-body {
    width: 100%;
    padding: 15px 24px 24px;
    text-align: center;

    .card-title {
      color: var(--dark);
      font-size: 18px;
      font-weight: 900;
      line-height: 30px;
      margin: 0px;
    }

    .desc {
      font-size: 14px;
      font-weight: 500;
      line-height: 25px;
      color: #989898;
      margin: 15px 0px;
    }

    .flex-data {
      width: 100%;
      display: flex;
      align-content: center;
      align-items: center;

      li {
        &:first-child {
          padding-inline-end: 25px;
          border-inline-end: 1px solid #e2e2e2;

          img {
            width: 87px;
          }
        }

        &:last-child {
          padding-inline-start: 25px;

          img {
            width: 60px;
          }
        }

        img {
          height: 24px;
          object-fit: contain;
          object-position: center;
        }
      }
    }

    .price {
      color: var(--secondary-color);
      font-size: 22px;
      font-weight: 900;
      margin: 15px 0px 24px 0px;
    }

    .btn {
      width: 100% !important;
    }
  }

  &:hover {
    transform: translateY(-10px);
  }
}
</style>