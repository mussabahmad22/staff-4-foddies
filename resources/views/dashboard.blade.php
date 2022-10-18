<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
   <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-12 mt-4">
                <div class="card text-dark bg-warning mb-3">
                  <div class="card-header">Total Restaurant</div>
                  <div class="card-body">
                    <span class="display-1">{{ $rest_count }}</span>
                    <p class="card-text">Total Restaurant</p>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12 mt-4">
                <div class="card text-dark bg-warning mb-3">
                  <div class="card-header">Total Users</div>
                  <div class="card-body">
                    <span class="display-1">{{ $rest_count_users }}</span>
                    <p class="card-text"> Total Users</p>
                  </div>
                </div>
            </div>
        </div>
   </div>

</x-app-layout>
