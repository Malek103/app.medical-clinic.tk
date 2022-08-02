<!DOCTYPE html>
<html lang="ar">
<head>
    @include('layouts.parts.header')
</head>
<body class="form">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">

                <div class="form-container">
 
                    <div class="form-content ptb-50">

                        <h1 class="">{{__('lang.sign_in')}}</h1>
                        <p class="">{{__('lang.sign_in_to_continue')}}</p>
                        @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                <strong>{{$error}}</strong>
                            </div>
                        @endforeach
                        @endif            
                        
                        <form action="/login" method="post" class="text-left">
                            {{csrf_field()}}
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="email">{{__('lang.email')}}</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="{{__('lang.email')}}">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">{{__('lang.password')}}</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="{{__('lang.password')}}">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">{{__('lang.sign_in')}}</button>
                                    </div>
                                </div>

              
                            </div>
                        </form>

                    </div>  
                                  
                </div>
                
            </div>
        </div>
    </div>

    
@include('layouts.parts.footer')