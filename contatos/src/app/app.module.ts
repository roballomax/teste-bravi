import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatToolbarModule} from '@angular/material/toolbar';
import {MatIconModule} from '@angular/material/icon';
import {MatButtonModule} from '@angular/material/button';
import {MatTabsModule} from '@angular/material/tabs';
import { CreateUpdatePersonComponent } from './create-update-person/create-update-person.component';
import {MatDialogModule} from '@angular/material/dialog';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatInputModule} from '@angular/material/input';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import {MatTableModule} from '@angular/material/table';
import { NgFor, NgIf } from '@angular/common';
import { CeateUpdateContactComponent } from './ceate-update-contact/ceate-update-contact.component';
import {MatSelectModule} from '@angular/material/select';
import { NgxMaskDirective, NgxMaskPipe } from 'ngx-mask';



@NgModule({
  declarations: [
    AppComponent,
    CreateUpdatePersonComponent,
    CeateUpdateContactComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MatToolbarModule,
    MatIconModule,
    MatButtonModule,
    MatTabsModule,
    MatDialogModule,
    MatFormFieldModule,
    MatInputModule,
    ReactiveFormsModule,
    HttpClientModule,
    MatTableModule,
    NgFor, 
    NgIf,
    MatSelectModule,
    NgxMaskDirective,
    NgxMaskPipe,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
