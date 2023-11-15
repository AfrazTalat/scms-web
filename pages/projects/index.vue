<template>
  <div>
    <SharedSubHeader :title="t('projects.page_title')" />
    <ProjectsList />
  </div>
</template>
<script lang="ts" setup>
import { useSettings } from '~/stores/settings';

const { t } = useI18n();
const { webTitle } = useSettings();

useHead({
  title: webTitle(t('projects.page_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('projects.meta.description'),
    }
  ]
});

</script>