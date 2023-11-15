<template>
  <section class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="content">
            <h4 class="title">
              {{ brand ? brand.name : $t('ecommerce.all_products') }}
            </h4>

            <ul class="list">
              <li>
                <NuxtLink :to="localePath('/')" class="link">
                  {{ $t('common.home') }}
                </NuxtLink>
              </li>

              <template v-if="!brand">
                <li>
                  <span class="data">
                    {{ $t('ecommerce.all_products') }}
                  </span>
                </li>
              </template>

              <template v-if="brand">
                <li>
                  <NuxtLink :to="localePath('/trademarks')" class="link">
                    {{ $t('brands.all_brands') }}
                  </NuxtLink>
                </li>
                <li>
                  <span class="data">
                    {{ brand.name }}
                  </span>
                </li>
              </template>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import { IBrand } from '~/types/resources/common';

defineProps<{
  brand?: IBrand
}>()

const localePath = useLocalePath();
</script>