import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';

import {environment} from './../../environments/environment';

@Injectable({
    providedIn: 'root'
})
export class UsersService {

    constructor(private httpClient: HttpClient) {
    }

    /**
     *
     * Function add / register for user profile
     * @param user as a object of user information
     */
    addUser(user: any) {
        return this.httpClient.post(`${environment.apiURL}/users/addUser`, user);
    }
}
