import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {AuthenticationService} from '../_services/authentication.service';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

    model: any = {};
    loading = false;
    returnUrl: string;
    apiResponse: any;
    CurrentUser = localStorage.getItem('currentUser');

    constructor(
        private router: Router,
        private authenticationService: AuthenticationService,
    ) {
    }

    LoginForm = new FormGroup({
        username: new FormControl(null, Validators.required),
        password: new FormControl(null, [Validators.required, Validators.minLength(8)]),
    });

    ngOnInit() {
        this.returnUrl = '/admin';
        if (this.CurrentUser) {
            this.router.navigate([this.returnUrl]);
        }
    }

    login() {
        this.loading = true;
        let formData = new FormData();
        formData.append('username', this.LoginForm.get('username').value);
        formData.append('password', this.LoginForm.get('password').value);
        this.authenticationService.login(formData).subscribe(
            user => {
                this.apiResponse = user;
                if (user.result.status === 'success') {
                    this.router.navigate([this.returnUrl]);
                }
            },
            error => console.log(error)
        );
    }

}
