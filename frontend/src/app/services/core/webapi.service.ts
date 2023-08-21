import { HttpHeaders, HttpClient } from '@angular/common/http';

export abstract class WebApiService {
  protected abstract serviceUrl: string;
  protected abstract webApiSuffix: string;

  protected readonly httpOptionsJson = {
    headers: new HttpHeaders({
      'content-type': 'application/json',
    }),
  };

  constructor(protected httpClient: HttpClient) {}
}
