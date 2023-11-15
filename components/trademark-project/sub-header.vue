<template>
  <section class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="content">
            <h4 class="title">
              بريسوفاك
            </h4>

            <ul class="list">
              <li>
                <NuxtLink :to="localePath('/')" class="link">
                  {{ $t('common.home') }}
                </NuxtLink>
              </li>

              <li>
                <NuxtLink to="/trademarks" class="link">
                  كل العلامات التجارية
                </NuxtLink>
              </li>

              <li>
                <span class="data">
                  بريسوفاك
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

<style lang="scss" scoped>
.sub-header {
  padding-bottom: 150px !important;
}
</style>