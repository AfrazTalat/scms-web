<template>
  <section class="news">
    <div class="container">
      <Loader :loading="loading"></Loader>
      <div class="row" v-if="!loading">
        <div class="col-lg-4 col-md-6 col-12 mb-3" v-for="(project, i) in projectsList?.list" :key="i">
          <ProjectsProjectCard :project="project" />
        </div>
      </div>

      <div class="mt-4" v-if="projectsList?.pagination">
        <b-pagination v-model="projectsList.pagination.current_page" :total-rows="projectsList.pagination.total"
          :per-page="projectsList.pagination.per_page" class="numbers-list"></b-pagination>
      </div>
    </div>
  </section>
</template>

<script lang="ts" setup>
import Loader from '../shared/loader.vue';
import { useProjects } from '~/stores/content/projects';

const localePath = useLocalePath();

const loading = ref(false);
const projects = useProjects();

const projectsList = await (await useAsyncData("news-list", () => projects.fetchProjects()
  .finally(() => loading.value = false))).data.value;
</script>


<style lang="scss" scoped>
.news {
  width: 100%;
  padding: 90px 0px;
  background-color: #fff;
}
</style>