<template>
  <SharedPageNotFound></SharedPageNotFound>
</template>

<script setup>
import { useSettings } from './stores/settings';

const props = defineProps({
  error: Object
})

const { t } = useI18n();
const { webTitle } = useSettings();

definePageMeta({
  layout: 'void',
});

useHead({
  title: webTitle(t('common.not_found_title')),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: t('common.meta.not_found_description'),
    }
  ]
});
</script>