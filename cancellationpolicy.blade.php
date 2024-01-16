@extends('common.tamplate')

@section('title') {{ ucfirst($title) }} @endsection

@section('header')
@parent
@endsection

@section('content')

    <section>
          <div class="container">
               <div class="text-center">
                    <h1>Cancellation Policy / Rules</h1>
                    <br>
               </div>
          </div>
     </section>
     <section class="section-background">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-xs-12">
                         <div class="about-info">
                              <figure>
                                   <figcaption>
                                        <p>Trip Cancellation : The trip cancellation rules are listed below:</p>
                                        <ul>
                                            <li>50% of Ryde fee will be charged for cancellation 10-15mins before Ryde is scheduled.</li>
                                            <li>100% of Ryde fee will be charged for cancellation 5mins or less before Ryde is scheduled.</li>
                                            <li>Ryde can be cancelled for free 16 mins or more before Ryde is scheduled.</li>
                                        <ul>
                                   </figcaption>
                              </figure>
                         </div>
                    </div>
               </div>
          </div>
     </section>

@parent
@endsection

@section('footer')
@parent
@endsection
