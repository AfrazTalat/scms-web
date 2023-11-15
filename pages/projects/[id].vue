<template>
  <div v-if="project">
    <SharedSubHeader :title="project.title" :links="[{ label: $t('projects.all_projects'), link: '/projects' }]" />
    <section>
      <div class="container">
        <div class="row" v-if="!loading">
          <div class="col-12">
            <div class="d-flex flex-column align-items-center justify-content-center w-100 py-3">
              <h4 class="h2 fw-bold mb-4">{{ project.title }}</h4>

              <b-carousel v-if="project.images && project.images.length > 0" indicators>
                <b-carousel-slide v-for="image in project.images" :img-src="image?.preview" />
              </b-carousel>

              <div class="border-top border-bottom my-5 py-3 " v-html="project.content"></div>

              <ShareIconsBox :title="project.title"></ShareIconsBox>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script lang="ts" setup>
import { useProjects } from '~/stores/content/projects';
import { useSettings } from '~/stores/settings';
import { IProject } from '~/types/content';
import ShareIconsBox from "~/components/shared/ShareIconsBox.vue";

const route = useRoute();
const { t } = useI18n();
const { webTitle } = useSettings();

const loading = ref(false);

const projectReq = await useAsyncData<IProject>("project-view", () => useProjects().getProject(+route.params.id));
const project = ref(projectReq.data.value);

useHead({
  title: webTitle(project.value?.title),
  meta: [
    {
      hid: 'description',
      name: 'description',
      content: project.value?.title,
    }
  ]
});

watch(() => route.params.id, (val) => projectReq.refresh().then(() => project.value = projectReq.data.value))
</script>