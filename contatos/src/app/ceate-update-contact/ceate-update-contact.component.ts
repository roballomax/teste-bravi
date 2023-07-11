import { Component, Inject, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpServiceService } from '../services/http-service.service';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { provideNgxMask } from 'ngx-mask';

@Component({
  selector: 'app-ceate-update-contact',
  templateUrl: './ceate-update-contact.component.html',
  styleUrls: ['./ceate-update-contact.component.less'],
  providers: [provideNgxMask()]
})
export class CeateUpdateContactComponent implements OnInit {
  contactForm: FormGroup;
  typeContact: Array<any> = [
    {"id" : 1, "value" : 'Telefone'},
    {"id" : 2, "value" : 'Whatsapp'},
    {"id" : 3, "value" : 'E-mail'},
  ];
  mask: string;
  typeInput: string;

  constructor(
    private formBuilder: FormBuilder, 
    private httpService: HttpServiceService, 
    private dialogRef: MatDialogRef<CeateUpdateContactComponent>,
    @Inject(MAT_DIALOG_DATA) public data: any
  ) 
  {
    this.mask = '';
    this.typeInput = 'email';
    this.contactForm = this.formBuilder.group({
      'valor': '',
      'tipo_id': '',
      'pessoa_id': ''
    });
  }

  ngOnInit() {
    const {valor, tipo_id, pessoa_id} = this.data;
   
   if (!tipo_id) {
    this.contactForm.controls['pessoa_id'].setValue(this.data.pessoa_id);
    return;
   }
   
    this.contactForm.patchValue({
      valor,
      "tipo_id": `${tipo_id}`,
      pessoa_id
    });

    this.onchangeType(tipo_id, false);

  }

  onchangeType(typeContact: any, cleanInput: boolean = true) {

    if (this.contactForm.controls['tipo_id'].getRawValue() && cleanInput) {
      this.contactForm.controls['valor'].setValue('');
    }

    switch(typeContact) {
      case "1": 
        this.mask = '(00) 0000-0000';
        this.typeInput = 'text';
        break;
      case "2": 
        this.mask = '(00) 00000-0000';
        this.typeInput = 'text';
        break;
      case "3": 
        this.mask = '';
        this.typeInput = 'email';
        break;
    }

  }

  onFormSubmit() 
  {
    if (this.contactForm.valid) {
      if (this.data.valor) {
       
        this.httpService.put(`contato/${this.data.id}`, this.contactForm.value).subscribe({
          next: (e: any) => {
            alert(e.message);
            this.dialogRef.close(true);
          }, 
          error: (err: any) => {
            alert(err.error.message);
          }
        });
       
        return; 
      }

      this.httpService.post('contato/', this.contactForm.value).subscribe({
        next: (e: any) => {
          alert(e.message);
          this.dialogRef.close(true);
        }, 
        error: (err: any) => {
          alert(err.error.message);
          this.dialogRef.close(false);
        }
      });
    }
  }



}
