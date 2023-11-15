export default defineI18nLocale((locale) => {
  const config = useRuntimeConfig();
  // for example, fetch locale messages from nuxt server
  return $fetch(`${config.public.apiUrl}/${config.public.apiVersion}/assets/locales/web-${locale}`).then((val) => JSON.parse(val))
})