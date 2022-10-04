@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container-fulid">
        <div class="bg-top" style="background-image:url('{{ asset('images/background/bg-top4.jpeg') }}'); height:100vh; position: relative; filter: brightness(130%);">

            <div class="row">
                <div class="text-center col " style="position: absolute; top:30%;" >
                <p class="fs-3 fst-italic">Write just 4 sentence everyday<br>To interpret myself</p>
                <a href="{{ route('login') }}" class="btn btn-primary mt-3">Start your free diary now!</a>
                </div>

            </div>
        </div>
        
    </div>

        <div class="row justify-content-center mt-5">
        <h1 class="text-center mb-5">Benefit from writing a diary</h1>
        <div class="col-2 text-center" style="height: 200px;">
            <i class="fa-solid fa-user-large" style="font-size: 5rem"></i>
            <h2 class="fs-5 mt-3">Think objectively</h2>
            <p class="small text-muted">To objectively see your actions and inner thoughts, it becomes easier to control your actions.</p>
        </div>

        <div class="col-2 text-center" style="height: 200px;">
            <i class="fa-solid fa-briefcase-medical" style="font-size: 5rem"></i>
            <h2 class="fs-5 mt-3">Get rid of stres</h2>
            <p class="small text-muted">Writing down your worries and dissatisfaction clears your mind and makes you feel refreshed.</p>
        </div>

        <div class="col-2 text-center" style="height: 200px;">
            <i class="fa-solid fa-dumbbell" style="font-size: 5rem"></i>
            <h2 class="fs-5 mt-3">Be confident</h2>
            <p class="small text-muted">You can gain confidence in yourself that you can continue by keeping a diary.</p>
        </div>
        </div>

        <div class="row justify-content-center mt-5">
        <div class="col-2 text-center" style="height: 200px;">
            <i class="fa-solid fa-pen" style="font-size: 5rem"></i>
            <h2 class="fs-5 mt-3">Improve writing skill</h2>
            <p class="small text-muted">Be able to organize thoughts and feelings and put them into sentences quickly.</p>
        </div>

        <div class="col-2 text-center" style="height: 200px;">
            <i class="fa-solid fa-book" style="font-size: 5rem"></i>
            <h2 class="fs-5 mt-3">Keep a record</h2>
            <p class="small text-muted">Past events can also be assets filled with hints for your future self.</p>
        </div>

        <div class="col-2 text-center" style="height: 200px;">
            <i class="fa-solid fa-face-grin-wide" style="font-size: 5rem"></i>
            <h2 class="fs-5 mt-3">Be positive</h2>
            <p class="small text-muted">When I put into words the small joys that I had that day, I can see things in a positive light.</p>
        </div>
        </div>

@endsection