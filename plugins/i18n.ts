import { LocaleObject } from "@nuxtjs/i18n/dist/runtime/composables";

export default defineNuxtPlugin(nuxtApp => {

  const i18n = useNuxtApp().$i18n;
  const currentLocaleInfo = (i18n.locales.value as LocaleObject[]).find((locale) => locale.code === i18n.locale.value);
  if (currentLocaleInfo) {
    useHead({
      htmlAttrs: {
        dir: currentLocaleInfo.dir
      }
    })
  }

  // called right before setting a new locale
  nuxtApp.hook('i18n:beforeLocaleSwitch', ({ oldLocale, newLocale, initialSetup, context }) => {
    console.log('onBeforeLanguageSwitch', oldLocale, newLocale, initialSetup)
  })

  // called right after a new locale has been set
  nuxtApp.hook('i18n:localeSwitched', ({ oldLocale, newLocale }) => {
    console.log('onLanguageSwitched', oldLocale, newLocale)
  })
})