import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {map} from 'rxjs/operators';
import {environment} from './../../environments/environment';
import {Router} from '@angular/router';

@Injectable({
    providedIn: 'root'
})
export class AuthenticationService {


    constructor(private http: HttpClient, private router: Router) {
    }

    login(formData) {
        return this.http.post<any>(`${environment.apiURL}/users/login`, formData)
            .pipe(map(user => {
                if (user && user.result.token) {
                    localStorage.setItem('currentUser', JSON.stringify(user.result.data));
                    localStorage.setItem('currentUserToken', JSON.stringify(user.result.token));
                }
                return user;
            }));
    }

    logout() {

        if (localStorage.getItem('currentUser')) {
            localStorage.removeItem('currentUser');
            localStorage.removeItem('currentUserToken');
            this.router.navigate(['/']);
        }
    }

}
