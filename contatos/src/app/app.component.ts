import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { CreateUpdatePersonComponent } from './create-update-person/create-update-person.component';
import { HttpServiceService } from './services/http-service.service';

import {animate, state, style, transition, trigger} from '@angular/animations';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.less'],
  animations: [
    trigger('detailExpand', [
      state('collapsed', style({height: '0px', minHeight: '0'})),
      state('expanded', style({height: '*'})),
      transition('expanded <=> collapsed', animate('225ms cubic-bezier(0.4, 0.0, 0.2, 1)')),
    ]),
  ],
})
export class AppComponent implements OnInit{
  title = 'contatos';

  typeContact: Array<string> = [
    'Telefone', 'Whatsapp', 'E-mail'
  ]
  dataSource = [];
  columnsToDisplay = ['id', 'nome'];
  columnsToDisplayWithExpand = [...this.columnsToDisplay, 'expand'];
  expandedElement: Person | null;

  constructor(private _dialog: MatDialog, private httpService: HttpServiceService) {
    this.expandedElement = null;
  }

  ngOnInit(): void {
    this.getPersonList();  
  }

  openAddEditPerson() 
  {
    this._dialog.open(CreateUpdatePersonComponent);
  }

  getPersonList()
  {
    this.httpService.get('pessoa').subscribe({
      next: (res: any) => {
        this.dataSource = res.data;
      },
      error: (err) => {
        console.log(err);
      }
    });
  }
}

export interface Person {
  id: number;
  nome: string;
  created_at: string;
  updated_at: string;
  contacts: Array<any>;
}
