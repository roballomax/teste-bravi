import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HttpServiceService {

  uri: string = 'http://localhost/api/';

  constructor(private http: HttpClient) { }

  post(url:string, data: any): Observable<any>
  {
    return this.http.post(this.uri + url, data);
  }

  put(url:string, data: any): Observable<any>
  {
    return this.http.put(this.uri + url, data);
  }

  get(url: string): Observable<any> 
  {
    return this.http.get(this.uri + url);
  }

  delete(url: string): Observable<any> 
  {
    return this.http.delete(this.uri + url);
  }

}
