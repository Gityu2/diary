@extends('layouts.app')

@section('style')
    <link href="{{ mix('css/top.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fulid">
        <div class="bg-top bg">

            <div class="row">
                <div class="message">
                    <h1>Write just 4 sentence everyday<br>To interpret myself</h1>
                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Start your free diary now!</a>
                    <a href="#benefit-detail" class="arrow"></a>
                    <p>See benefits</p>
                </div>
            </div>
                
        </div>

    </div>

    <section id="benefit-detail">
        <div class="d-flex justify-content-center align-items-center h-100">

            <div class="row benefit-width">
                <h1>Benefit from writing a diary</h1>
                
                <div class="col-6 col-md-4 benefit">
                    <i class="fa-solid fa-user-large"></i>
                    <h2>Think objectively</h2>
                    <p>To objectively see your actions and inner thoughts, it becomes easier to control your actions.</p>
                </div>

                <div class="col-6 col-md-4 benefit">
                    <i class="fa-solid fa-briefcase-medical"></i>
                    <h2>Get rid of stres</h2>
                    <p>Writing down your worries and dissatisfaction clears your mind and makes you feel refreshed.</p>
                </div>

                <div class="col-6 col-md-4 benefit">
                    <i class="fa-solid fa-dumbbell"></i>
                    <h2>Be confident</h2>
                    <p>You can gain confidence in yourself that you can continue by keeping a diary.</p>
                </div>

                <div class="col-6 col-md-4 benefit">
                    <i class="fa-solid fa-pen"></i>
                    <h2>Improve writing skill</h2>
                    <p>Be able to organize thoughts and feelings and put them into sentences quickly.</p>
                </div>

                <div class="col-6 col-md-4 benefit">
                    <i class="fa-solid fa-book"></i>
                    <h2>Keep a record</h2>
                    <p>Past events can also be assets filled with hints for your future self.</p>
                </div>

                <div class="col-6 col-md-4 benefit">
                    <i class="fa-solid fa-face-grin-wide"></i>
                    <h2>Be positive</h2>
                    <p>When I put into words the small joys that I had that day, I can see things in a positive light.</p>
                </div>
            </div>
        </div>
    </section>

@endsection