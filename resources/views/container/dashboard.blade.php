@extends('adminlayouts.main')
@section('title', 'Dasboard')
@section('content')

<style>
    .dashbord-container .right-content{
              flex: 1 0 auto;
            }
</style>

<div class="right-content">
    <div class="dashboard-title">
        <h1 class="title">Dashboard</h1>
    </div>
    <div class="stratent-img">
        <img src="{{asset('stylecontainer/images/logo@1x 1.png')}}">
     </div>
</div>

@endsection