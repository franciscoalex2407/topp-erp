import { Injectable } from "@angular/core";
import { HttpClient, HttpBackend } from '@angular/common/http';

import { environment } from '../../environments/environment';
import { Observable } from 'rxjs';

@Injectable({
   providedIn: 'root'
})
export class FiscalService {
   public url = environment.url;

   constructor(
      public http: HttpClient
   ) { }

   createNFCe(data: any): Observable<any[]> {
      return this.http.post<any[]>(`${this.url}/nfce`, data);
   }

   cancelNFCe(data: any, id: number): Observable<any[]> {
      return this.http.post<any[]>(`${this.url}/nfce/${id}`, data);
   }

   printNFCe(data: any): Observable<any[]> {
      return this.http.post<any[]>(`${this.url}/nfce/print`, data);
   }

   createNFe(data: any): Observable<any[]> {
      return this.http.post<any[]>(`${this.url}/nfe`, data);
   }

   cancelNFe(data: any, id: number): Observable<any[]> {
      return this.http.post<any[]>(`${this.url}/nfe/${id}`, data);
   }

   printNFe(data: any): Observable<any[]> {
      return this.http.post<any[]>(`${this.url}/nfe/print`, data);
   }

}