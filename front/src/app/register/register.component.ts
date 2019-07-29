import {Component, OnInit} from '@angular/core';
import {UsersService} from '../_services/users.service';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import {IMyDpOptions} from 'mydatepicker';


@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
    private BirthDatePickerOptions: IMyDpOptions = {
        dateFormat: 'yyyy-mm-dd'
    };


    formSubmitted = false;
    apiResponse: any;
    user: any = {};

    UserForm = new FormGroup({
        username: new FormControl(null, Validators.required),
        password: new FormControl(null, [Validators.required, Validators.minLength(8)]),
        gender: new FormControl('', Validators.required),
        name: new FormControl(null, Validators.required),
        surname: new FormControl(null, Validators.required),
        email: new FormControl(null, [Validators.required, Validators.email]),
        birth: new FormControl(null, Validators.required),
        phone: new FormControl(),
        mobile: new FormControl(null, Validators.required),
        picture_path: new FormControl()
    });

    constructor(private usersService: UsersService) {
    }

    ngOnInit() {
    }

    addUser() {
        let formData = new FormData();

        this.formSubmitted = true;
        formData.append('username', this.UserForm.get('username').value);
        formData.append('password', this.UserForm.get('password').value);
        formData.append('gender', this.UserForm.get('gender').value);
        formData.append('name', this.UserForm.get('name').value);
        formData.append('surname', this.UserForm.get('surname').value);
        formData.append('email', this.UserForm.get('email').value);
        formData.append('birth', this.UserForm.get('birth').value.formatted);
        formData.append('phone', this.UserForm.get('phone').value);
        formData.append('mobile', this.UserForm.get('mobile').value);
        this.usersService.addUser(formData).subscribe(
            success => {
                this.apiResponse = success;
            },
            error => console.log(error)
        );
    }
}
