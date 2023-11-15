<template>
  <section class="sub-header">
    <div class="container">
      <Loader :loading="loading"></Loader>
      <div class="row" v-if="!loading">
        <div class="col-12">
          <div class="content">
            <h4 class="title">{{ product.name }}</h4>

            <ul class="list">
              <li>
                <NuxtLink :to="localePath('/')" class="link">{{ $t('common.home') }}</NuxtLink>
              </li>

              <li>
                <NuxtLink :to="localePath('/products')" class="link">{{ $t('ecommerce.all_products') }}</NuxtLink>
              </li>

              <li v-if="product.category">
                <NuxtLink :to="localePath(`/products/category/${product.category.id}`)" class="link">
                  {{
                    product.category.name
                  }}
                </NuxtLink>
              </li>

              <li>
                <span class="data">{{ product.name }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import Loader from "~/components/shared/loader.vue"
import { IProduct } from "~/types/resources/ecommerce"

const localePath = useLocalePath();

const props = withDefaults(defineProps<{
  loading?: boolean,
  product: IProduct
}>(), {
  loading: false
})
</script>

<style scoped></style>