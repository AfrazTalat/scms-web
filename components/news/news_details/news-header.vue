<template>
  <section class="sub-header">
    <div class="container">
      <Loader :loading="loading"></Loader>
      <div class="row" v-if="!loading">
        <div class="col-12">
          <div class="content">
            <h4 class="title">{{ article.title }}</h4>

            <ul class="list">
              <li>
                <NuxtLink :to="localePath('/')" class="link">{{ $t('common.home') }}</NuxtLink>
              </li>

              <li>
                <NuxtLink :to="localePath('/news')" class="link">{{ $t('articles.all_news') }}</NuxtLink>
              </li>

              <li>
                <span class="data">{{ article.title }}</span>
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
import { IArticle } from "~/types/content"

withDefaults(defineProps<{
  loading?: boolean,
  article: IArticle
}>(), {
  loading: false
})

const localePath = useLocalePath();
</script>


<style lang="scss" scoped>
.sub-header {
  padding-bottom: 150px !important;
}
</style>