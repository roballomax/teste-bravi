import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CeateUpdateContactComponent } from './ceate-update-contact.component';

describe('CeateUpdateContactComponent', () => {
  let component: CeateUpdateContactComponent;
  let fixture: ComponentFixture<CeateUpdateContactComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CeateUpdateContactComponent]
    });
    fixture = TestBed.createComponent(CeateUpdateContactComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
