import { CrudResource } from "~/types/common/http";

export const defaultCrudState: CrudResource = {
  list: [],
  loading: false,
  pagination: undefined
}


export const objectToFormData = (object: Record<string, any>) => {
  const formData = new FormData();
  const loopData = (object: Record<string, any>) => {
    if (!object) return;
    const keys = Object.keys(object);
    if (keys.length === 0) return;
    for (const key of keys) {
      if (object[key] === undefined) {
        continue;
      }
      if (
        typeof object[key] === "object" &&
        !(object[key] instanceof File)
      ) {
        if (object[key] instanceof Date) {
          formData.append(key, object[key].toUTCString());
          continue;
        }
        if (Array.isArray(object[key])) {
          if (object[key].length === 0) {
            formData.append(`${key}[]`, "");
            continue;
          }

          object[key].map((i: any) => {
            if (i instanceof File) {
              formData.append(`${key}[]`, i);
              return;
            }
            if (typeof i !== 'object') {
              formData.append(`${key}[]`, i);
              return;
            }
            formData.append(`${key}[]`, JSON.stringify(i));
          });
          continue;
        }
        if (object[key] !== undefined && object[key] !== null) {
          formData.set(key, JSON.stringify(object[key]))
        }
        continue;
      }
      if (
        typeof object[key] === "boolean"
      ) {
        //loopData(object[key]);
        formData.set(key, object[key] === true ? '1' : '0')
        continue;
      }
      formData.append(key, object[key])
    }
  };
  loopData(object);
  return formData;
}
