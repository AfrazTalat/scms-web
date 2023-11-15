<template>
  <section class="news">
    <div class="container">
      <Loader :loading="loading"></Loader>
      <BTable :fields="tableFields" :items="downloadsList?.list" responsive bordered>
        <template #cell(description)="row">
          <div v-html="row.item.description"></div>
        </template>
        <template #cell(download)="row">
          <a v-if="row.item.file" :href="(row.item.file as any).preview"
            class="btn btn-sm btn-primary w-auto d-inline-block px-4" :download="true">
            {{ $t('shared.download') }}
          </a>
        </template>
      </BTable>
    </div>

    <div class="mt-4" v-if="downloadsList?.pagination">
      <b-pagination v-model="downloadsList.pagination.current_page" :total-rows="downloadsList.pagination.total"
        :per-page="downloadsList.pagination.per_page" class="numbers-list"></b-pagination>
    </div>
  </section>
</template>

<script lang="ts" setup>
import { BTable, TableField } from 'bootstrap-vue-next';
import Loader from '../shared/loader.vue';
import { useDownloads } from '~/stores/content/downloads';

const localePath = useLocalePath();
const { t } = useI18n();

const loading = ref(false);
const downloads = useDownloads();

const tableFields = ref<TableField[]>([
  {
    key: 'title',
    label: t('common.title'),
  },
  {
    key: 'description',
    label: t('common.description'),
  },
  {
    key: 'download',
    label: t('common.download'),
  },
])

const downloadsList = await (await useAsyncData("news-list", () => downloads.fetchDownloads()
  .finally(() => loading.value = false))).data.value;
</script>


<style lang="scss" scoped>
.news {
  width: 100%;
  padding: 90px 0px;
  background-color: #fff;
}
</style>