import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';

import { lastValueFrom } from 'rxjs';

import { environment } from '../../environments/environment';
import { WebApiService } from './core/webapi.service';

import { Racer } from '../models/racer.model';

@Injectable({
  providedIn: 'root',
})
export class RacerService extends WebApiService {
  serviceUrl: string = environment.racerServer;
  webApiSuffix: string = 'backend/racers/api/';

  public get racerServiceUrl(): string {
    return this.serviceUrl + this.webApiSuffix + 'index.php';
  }

  public constructor(httpClient: HttpClient) {
    super(httpClient);
  }

  public async selectRacers(): Promise<Racer[]> {
    try {
      const result = this.httpClient.get(this.racerServiceUrl);

      return (await lastValueFrom(result)) as Racer[];
    } catch (e) {
      console.log('Erro', e);
      throw e;
    }
  }

  public async searchRacers(search: string): Promise<Racer[]> {
    try {
      const params = new HttpParams().set('search', search);

      const result = this.httpClient.get(this.racerServiceUrl, {
        params,
      });

      return (await lastValueFrom(result)) as Racer[];
    } catch (e) {
      console.log('Erro', e);
      throw e;
    }
  }
}
