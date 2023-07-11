import { Component, Inject, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpServiceService } from '../services/http-service.service';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-create-update-person',
  templateUrl: './create-update-person.component.html',
  styleUrls: ['./create-update-person.component.less']
})
export class CreateUpdatePersonComponent implements OnInit {
  personForm: FormGroup;

  constructor(
    private formBuilder: FormBuilder, 
    private httpService: HttpServiceService, 
    private dialogRef: MatDialogRef<CreateUpdatePersonComponent>,
    @Inject(MAT_DIALOG_DATA) public data: any
  ) 
  {
    this.personForm = this.formBuilder.group({
      'nome': ''
    });
  }

  ngOnInit() {
    this.personForm.patchValue(this.data);
  }


  onFormSubmit() 
  {
    if (this.personForm.valid) {
      if (this.data) {
       
        this.httpService.put(`pessoa/${this.data.id}`, this.personForm.value).subscribe({
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
      this.httpService.post('pessoa/', this.personForm.value).subscribe({
        next: (e: any) => {
          alert(e.message);
          this.dialogRef.close(true);
        }, 
        error: (err: any) => {
          alert(err.error.message);
        }
      });
    }
  }
}
