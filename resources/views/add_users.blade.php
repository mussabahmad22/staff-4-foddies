<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurants') }}
        </span>
        <button class="btn btn-warning m-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
            style="float: right;">Create New</button>
    </x-slot>
    <br />

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="card-block">
                    <div class="card-body">
                        <h5 class="card-title">{{$title}}</h5>

                        <!-- <h5 class="m-b-10"> {{$title}} </h5> -->
                        <form type="submit" action="{{$url}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ isset($record->name)?$record->name:'' }}">
                                </div>
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ isset($record->email)?$record->email:'' }}">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    value="{{ isset($record->password)?$record->password:'' }}">
                            </div>
                            <button type="submit" class="btn btn-warning">{{$text}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>