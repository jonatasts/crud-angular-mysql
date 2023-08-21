import { Component } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';

import { LoadingController } from '@ionic/angular';

interface Racer {
  id: string;
  name: string;
  wins: string;
  years: string;
  photo: string;
}

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
    private loadingCtrl: LoadingController
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

  private searchRacers(search: string) {
    const params = new HttpParams().set('search', search);

    this.http
      .get('http://localhost/crud-angular-mysql/backend/api/racers.php', {
        params,
        observe: 'response',
      })
      .subscribe((response) => {
        this.racers = response.body as Racer[];
      });
  }

  private getRacers() {
    this.http
      .get('http://localhost/crud-angular-mysql/backend/api/racers.php', {
        observe: 'response',
      })
      .subscribe((response) => {
        this.racers = response.body as Racer[];
      });
  }
}
