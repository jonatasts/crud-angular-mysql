import { Component } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';

import { LoadingController } from '@ionic/angular';

import { Racer } from 'src/app/models/racer.model';
import { RacerService } from 'src/app/services/racer.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {
  public racers: Racer[] = [];
  public initialized: boolean = false;
  public isRacers: boolean = false;

  constructor(
    private http: HttpClient,
    private loadingCtrl: LoadingController,
    private racerService: RacerService
  ) {}

  async ngOnInit(): Promise<void> {
    const loading = await this.loadingCtrl.create({
      message: 'Carregando...',
      duration: 2000,
    });

    try {
      loading.present();
      this.getRacers();

      await new Promise((f) => setTimeout(f, 2000));
      this.isRacers = true;
      this.initialized = true;
    } catch (error) {
      console.log(error);

      this.initialized = true;
      await loading.dismiss();
    }
  }

  ionViewDidEnter() {}

  handleInput(event: any) {
    const searchText = event.target.value;

    this.searchRacers(searchText);
  }

  private async searchRacers(search: string) {
    this.racers = await this.racerService.searchRacers(search);
  }

  private async getRacers() {
    this.racers = await this.racerService.selectRacers();
  }
}
