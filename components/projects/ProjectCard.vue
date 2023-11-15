<template>
  <b-card v-if="project" :title="project.title" :img-src="project.images ? project.images[0]?.preview : undefined"
    :img-alt="project.title" img-top>
    <b-card-text>{{ getShortDescription(project.content) }}</b-card-text>
    <NuxtLink class="see-more-btn" :to="localePath(`/projects/${project.id.toString()}`)">
      <img src="@/assets/img/blue_arrow.svg" />

      <span>{{ $t('common.view_details') }}</span>
    </NuxtLink>
  </b-card>
</template>

<script lang="ts" setup>
import { IProject } from '~/types/content';

const props = defineProps<{
  project: IProject,
}>();

const localePath = useLocalePath();

const getShortDescription = (text: string) => {
  return text.replace(/(&nbsp;|<([^>]+)>)/ig, "").slice(0, 244)
}
</script>