<template>
  <section class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="content">
            <h4 class="title">
              {{ $t('brands.all_brands') }}
            </h4>

            <ul class="list">
              <li>
                <NuxtLink :to="localePath('/')" class="link">
                  {{ $t('common.home') }}
                </NuxtLink>
              </li>

              <li>
                <span class="data">
              {{ $t('brands.all_brands') }}
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
const localePath = useLocalePath();
</script>