import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { CreateUpdatePersonComponent } from './create-update-person/create-update-person.component';
import { HttpServiceService } from './services/http-service.service';
import {animate, state, style, transition, trigger} from '@angular/animations';
import { CeateUpdateContactComponent } from './ceate-update-contact/ceate-update-contact.component';

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

  contactColumns = ['id', 'valor', 'tipo'];

  constructor(
    private _dialog: MatDialog, 
    private httpService: HttpServiceService,
  ) {
    this.expandedElement = null;
  }

  ngOnInit(): void {
    this.getPersonList();  
  }

  openAddEditPerson() 
  {
    const dialog = this._dialog.open(CreateUpdatePersonComponent);
    dialog.afterClosed().subscribe({
      next: (e) => {
        if (e) {
          this.getPersonList();
        }
      },
      error: (err) => {
        console.log(err.message);
      }
    });
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

  deletePerson(personId: number)
  {
    this.httpService.delete(`pessoa/${personId}`).subscribe({
      next: (res: any) => {
        alert(res.message);
        this.getPersonList();
      },
      error: (err) => {
        alert(err.message);
      }
    });
  }

  openEditPerson(data: any) 
  {
    const dialog = this._dialog.open(CreateUpdatePersonComponent, {
      data
    });
    dialog.afterClosed().subscribe({
      next: (e) => {
        if (e) {
          this.getPersonList();
        }
      },
      error: (err) => {
        console.log(err.message);
      }
    });
  }

  openAddEditContact(personId: any) 
  {
    const dialog = this._dialog.open(CeateUpdateContactComponent, {
      data: {
        'pessoa_id': personId
      }
    });
    dialog.afterClosed().subscribe({
      next: (e) => {
        if (e) {
          this.getPersonList();
        }
      },
      error: (err) => {
        console.log(err.message);
      }
    });
  }

  openEditContact(data: any) 
  {
    const dialog = this._dialog.open(CeateUpdateContactComponent, {
      data
    });
    dialog.afterClosed().subscribe({
      next: (e) => {
        if (e) {
          this.getPersonList();
        }
      },
      error: (err) => {
        console.log(err.message);
      }
    });
  }

  deleteContact(id: number)
  {
    this.httpService.delete(`contato/${id}`).subscribe({
      next: (res: any) => {
        alert(res.message);
        this.getPersonList();
      },
      error: (err) => {
        console.log(err);
        alert(err.message);
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
