<template>
  <slot></slot>

  <Teleport to="body">
    <div class="alerts-provider">
      <div v-for="alert in alertsList" class="alert mb-0" :class="{
        [`alert-${alert.type}`]: true
      }">
        <h5>{{ alert.title }}</h5>
        <div style="white-space: pre-line;">{{ alert.message }}</div>
      </div>
    </div>
  </Teleport>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { useI18n } from 'vue-i18n';
import { useAlerts } from '~/stores/interface/alerts';


const alerts = useAlerts();
const { alerts: alertsList } = storeToRefs(alerts);

const { t } = useI18n();

alerts.$subscribe((mut, state) => {
  state.alerts.forEach((alert) => {
    if (alert.fired) return;
    alert.fired = true;

    if (alert.displayForever) return;
    setTimeout(() => {
      if (!alert.id) return;
      alerts.remove(alert.id);
    }, (alert.displaySeconds || 3) * 1000);
  })
})
</script>
<style lang="scss" scoped>
.alerts-provider {
  display: flex;
  position: fixed;
  right: 4px;
  bottom: 4px;
  z-index: 100;
  min-width: 366px;
  max-width: 25%;
  max-height: 100vh;
  flex-direction: column;
  gap: 0.5rem;

  .alert {
    width: 100%;
  }
}
</style>