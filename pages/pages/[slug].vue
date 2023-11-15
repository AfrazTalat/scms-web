<template>
  <div>
    <section class="sub-header">
      <div class="container">
        <Loader :loading="loading"></Loader>
        <div class="row" v-if="!loading">
          <div class="col-12">
            <div v-if="page" class="content">
              <h4 class="title">{{ page.title }}</h4>

              <ul class="list">
                <li>
                  <nuxt-link :to="localePath('/')" class="link">{{ $t('common.home') }}</nuxt-link>
                </li>
                <li>
                  <span class="data">{{ page.title }}</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="page-details">
      <div class="container" v-if="page">
        <div v-html="page.content"></div>
      </div>
    </section>
  </div>
</template>
<script lang="ts" setup>
import Loader from "~/components/shared/loader.vue";
import { useSettings } from '~/stores/settings';
import { usePages } from '~/stores/content/pages';
import { IPage } from '~/types/content';



const route = useRoute();
const localePath = useLocalePath();
const { t } = useI18n();
const { webTitle } = useSettings();

const loading = ref(false);

const pageReq = await useAsyncData<IPage>("page-view", () => usePages().getPage(route.params.slug as string));
const page = ref(pageReq.data.value);
const pageContent = ref('')

useHead({
  title: webTitle(page.value?.title),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: page.value?.title,
    }
  ]
});

watch(() => route.params.id, (val) => pageReq.refresh().then(() => page.value = pageReq.data.value))
</script>

<style lang="scss" scoped>
.page-details {
  width: 100%;
  padding: 90px 0px;
  background-color: var(--light);
}
</style>