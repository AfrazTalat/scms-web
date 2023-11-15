import { useSettings } from "~/stores/settings";

export default defineNuxtPlugin(async () => {
  const settings = useSettings();
  const response = await useAsyncData("settings", () => settings.fetchSettings());

  if (response.data.value)
    settings.settings = response.data.value;

  return {
    provide: {
      setting: settings.setting,
      settings: settings.settings,
    }
  }
})