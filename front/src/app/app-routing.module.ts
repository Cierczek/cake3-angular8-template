import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {HomeComponent} from './home/home.component';
import {RegisterComponent} from './register/register.component';
import {LoginComponent} from './login/login.component';
import {AuthGuardGuard} from './_guard/auth-guard.guard';
import {AdminComponent} from './admin/admin.component';


const routes: Routes = [
    {path: 'admin', component: AdminComponent, canActivate: [AuthGuardGuard]},
    {path: '', component: HomeComponent},
    {path: 'register', component: RegisterComponent, canDeactivate: [AuthGuardGuard]},
    {path: 'login', component: LoginComponent},
    {path: '**', redirectTo: '/'}
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
