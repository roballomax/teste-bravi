import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { HttpServiceService } from '../services/http-service.service';
import { DialogRef } from '@angular/cdk/dialog';

@Component({
  selector: 'app-create-update-person',
  templateUrl: './create-update-person.component.html',
  styleUrls: ['./create-update-person.component.less']
})
export class CreateUpdatePersonComponent {
  personForm: FormGroup;

  constructor(
    private formBuilder: FormBuilder, 
    private httpService: HttpServiceService, 
    private dialogRef: DialogRef<CreateUpdatePersonComponent>
  ) 
  {
    this.personForm = this.formBuilder.group({
      'nome': ''
    });
  }

  onFormSubmit() 
  {
    if (this.personForm.valid) {
      this.httpService.post('pessoa/', this.personForm.value).subscribe({
        next: (e: any) => {
          alert(e.message);
          this.dialogRef.close();
        }, 
        error: (err: any) => {
          alert(err.message);
          this.dialogRef.close();
        }
      });
    }
  }
}
