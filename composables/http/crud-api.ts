import { useAlerts } from "~/stores/interface/alerts";
import { CrudResource } from "~/types/common/http";
import { IAlert } from "~/types/common/interface";
import { objectToFormData } from "~/utilities/http";

export const useCrudApi = <T>(crudState: Ref<CrudResource<T>>, baseUri: string) => {
  type STATE_TYPE = typeof crudState.value;
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

  const fetch = (options?: { params?: Record<string, any>, page?: number, cache?: boolean, save?: boolean }): Promise<STATE_TYPE | undefined> => {
    const defaultOptions: typeof options = {
      ...{ params: {}, page: 1, cache: false, save: true },
      ...options
    }

    if (crudState.value.loading) {
      throw new Error("Wait until the request is loaded.");
    };

    const requestParams = {
      ...defaultOptions.params,
      page: defaultOptions.page
    };

    return $fetch<Record<string, any>>(apiUrl, {
      method: 'GET',
      params: requestParams,
      headers: {
        ClientLocale: app.$i18n.locale.value
      },
      onResponseError: handleApiErrorResponse,
    })
      .then((response) => {
        const returnData: STATE_TYPE | undefined = response.data ? {
          loading: false,
          list: response.data,
          pagination: response.meta?.pagination ?
            response.meta.pagination :
            response.pagination ?
              response.pagination :
              { ...response, data: undefined },
        } : undefined;


        if (defaultOptions.save && returnData) {
          crudState.value.list = returnData.list;
          crudState.value.pagination = returnData.pagination;
        }
        return returnData;
      }).catch((err) => {
        console.log(6666, err);
        return err;
      })
  }

  const get = (id: number | string, options?: { params?: Record<string, any>, cache?: boolean }) => {
    const defaultOptions: typeof options = {
      ...{ params: {}, cache: false },
      ...options
    }
    const apiUrl = `${config.public.apiUrl}/${config.public.apiVersion}/${baseUri}/${id}`;
    if (defaultOptions.cache) {
      const storeItem = Array.isArray(crudState.value.list) ? crudState.value.list.find((e: any) => e['id'] == id) : crudState.value.list;
      if (storeItem) {
        return Promise.resolve(storeItem);
      }
    }

    const requestParams = {
      ...defaultOptions.params,
    };


    return $fetch<Record<string, any>>(apiUrl, {
      method: 'GET',
      params: requestParams,
      headers: {
        ClientLocale: app.$i18n.locale.value
      },
      onResponseError: handleApiErrorResponse,
    }).then((res) => {
      return res.data ?? res;
    })
  }


  const create = (data?: Record<string, any>, options?: { uri?: string, useFormData?: boolean }) => {
    const defaultOptions: typeof options = {
      ...{ useFormData: false },
      ...options
    }

    const apiUrl = `${config.public.apiUrl}/${config.public.apiVersion}/${baseUri}${defaultOptions.uri ? `${defaultOptions.uri}` : ''}`;

    return $fetch<Record<string, any>>(apiUrl, {
      method: 'POST',
      body: defaultOptions.useFormData && data ? objectToFormData(data) : data,
      headers: {
        ClientLocale: app.$i18n.locale.value
      },
      onResponseError: handleApiErrorResponse,
      onResponse: handleApiResponse,
    }).then((res) => {
      return res.data ?? res;
    }).catch((err) => {
      console.log(6666, err);
      return err;
    })

    // return httpClient.post(resource_url, useFormData ? objectToFormData(data) : data)
    //   .then((res) => {
    //     const item = res.data.data ?? res.data;
    //     if (!item) {
    //       return;
    //     }
    //     if (Array.isArray(this.list)) {
    //       const storedIndex = this.list.findIndex((i: any) => i['id'] == item['id']);
    //       if (storedIndex < 0) {
    //         this.list = [item, ...this.list];
    //         return;
    //       }
    //       this.list.splice(
    //         this.list.findIndex((i: any) => i['id'] == item['id']),
    //         1,
    //         item,
    //       );
    //       return item;
    //     }
    //     this.list = item;
    //     return item;
    //   })
  }
  // update(data: any, { useFormData = false } = {}) {
  //   return httpClient.post(
  //     `${resource_url}${data.id ? `/${data.id}` : ''}`,
  //     useFormData ? objectToFormData(data) : data
  //   )
  //     .then((res) => {
  //       const item = res.data.data ?? res.data;
  //       if (!item) {
  //         return;
  //       }
  //       if (Array.isArray(this.list)) {
  //         const storedIndex = this.list.findIndex((i: any) => i['id'] == item['id']);
  //         if (storedIndex < 0) {
  //           this.list = [item, ...this.list];
  //           return;
  //         }
  //         this.list.splice(
  //           this.list.findIndex((i: any) => i['id'] == item['id']),
  //           1,
  //           item,
  //         );
  //         return item;
  //       }
  //       this.list = item;
  //       return item;
  //     })
  // }
  const del = (id: string | number, options?: { alert?: boolean }) => {

    const defaultOptions: typeof options = {
      ...{ alert: true },
      ...options
    }

    const apiUrl = `${config.public.apiUrl}/${config.public.apiVersion}/${baseUri}/${id}`;

    return $fetch<Record<string, any>>(apiUrl, {
      method: 'DELETE',
      headers: {
        ClientLocale: app.$i18n.locale.value
      },
      onResponseError: handleApiErrorResponse,
    }).then((res) => {
      return res.data ?? res;
    })

    // const action = () => {
    //   return httpClient.delete(`${resource_url}/${id}`)
    //     .then((res) => {
    //       this.list = this.list.filter((i: any) => i.id !== id);
    //     });
    // }
    // if (alert) {
    //   const nDialogs = useDialog();
    //   nDialogs.error({
    //     title: 'Delete Item',
    //     content: "Are you sure you want to delete this ?",
    //     positiveText: 'Yes',
    //     negativeText: 'No',
    //     onPositiveClick: () => {
    //       action();
    //     }
    //   })
    //   return Promise.resolve();
    // }
    // return action();
  }


  return {
    fetch,
    get,
    create,
    del
  }
}