import { Component } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';

import { LoadingController } from '@ionic/angular';

interface Player {
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
  public players: Player[] = [];
  public isPlayers: boolean = false;

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
      this.getPlayers('');

      await new Promise((f) => setTimeout(f, 2000));
      this.isPlayers = true;
    } catch (error) {
      console.log(error);
      await loading.dismiss();
    }
  }

  ionViewDidEnter() {}

  handleInput(event: any) {
    const searchText = event.target.value;

    this.getPlayers(searchText);
  }

  getPlayers(search: string) {
    const params = new HttpParams().set('search', search);

    this.http
      .get('http://localhost/crud-angular-mysql/backend/players.php', {
        params,
        observe: 'response',
      })
      .subscribe((response) => {
        console.log(response);

         this.players = response.body as Player[];
      });
  }
}
