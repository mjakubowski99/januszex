export class Converter {

  public static objectToFormData(object: any): FormData {
    const formData = new FormData();

    for (const [key, value] of Object.entries(object)) {
      formData.append(key, String(value));
    }

    return formData;
  }
}
