import { useAlerts } from "~/stores/interface/alerts";
import { IAlert } from "~/types/common/interface";

export const useApi = <T>(baseUri: string) => {
  const config = useRuntimeConfig();
  const app = useNuxtApp();
  const apiUrl = `${config.public.apiUrl}/${config.public.apiVersion}/${baseUri}`;


  const handleApiErrorResponse = (response: Record<string, any>) => {
    const data = response.response?._data;

    if (data.message || data.title) {
      const errors = data.errors;
      useAlerts().add(<IAlert>{
        title: data.message ?? data.title,
        message: !errors ? undefined : (typeof (errors) !== 'string' ? Object.values(errors).join("\n") : errors),
        type: 'danger',
        displaySeconds: 3
      });
    }
  }


  const handleApiResponse = (response: Record<string, any>) => {
    const data = response.response?._data;

    if (data.message || data.title) {
      const messages = data.errors ?? data.message;
      useAlerts().add(<IAlert>{
        title: data.title ?? data.message,
        message: !messages ? undefined : (typeof (messages) !== 'string' ? Object.values(messages).join("\n") : messages),
        type: data.status === 'success' ? 'success' : 'danger',
        displaySeconds: 3
      });
    }
  }

  const request = (uri: string, method: 'GET' | 'POST' | 'PATCH' | 'PUT' | 'DELETE' = 'GET', options?: { params?: Record<string, any>, data?: Record<string, any>, headers?: Record<string, any> }) => {
    const defaultOptions: typeof options = {
      ...{ params: {}, headers: {}, data: {} },
      ...options
    }

    return $fetch<Record<string, any>>(`${apiUrl}${uri ?? ''}`, {
      method,
      params: defaultOptions.params,
      body: method === 'GET' ? undefined : defaultOptions.data,
      headers: {
        ClientLocale: app.$i18n.locale.value,
        ...defaultOptions.headers
      },
      onResponseError: handleApiErrorResponse,
      onResponse: handleApiResponse,
    })
  }


  const get = (uri: string, options?: { params?: Record<string, any>, headers?: Record<string, any> }) => {
    return request(uri, 'GET', options);
  }

  const post = (uri: string, options?: { params?: Record<string, any>, data?: Record<string, any>, headers?: Record<string, any> }) => {
    return request(uri, 'POST', options);
  }

  const patch = (uri: string, options?: { params?: Record<string, any>, data?: Record<string, any>, headers?: Record<string, any> }) => {
    return request(uri, 'PATCH', options);
  }

  const put = (uri: string, options?: { params?: Record<string, any>, data?: Record<string, any>, headers?: Record<string, any> }) => {
    return request(uri, 'PUT', options);
  }

  const del = (uri: string, options?: { params?: Record<string, any>, headers?: Record<string, any> }) => {    
    return request(uri, 'DELETE', options);
  }


  return {
    get,
    post,
    patch,
    put,
    del
  }
}