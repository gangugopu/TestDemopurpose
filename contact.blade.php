@extends('common.tamplate')

@section('title') {{ ucfirst($title) }} @endsection

@section('header')
@parent
@endsection

@section('content')

<section class="contactbg">
          <div class="container">
               <div class="text-center">
                    <h1> </h1>

                    <br>

                    <p class="lead"> </p>
               </div>
          </div>
     </section>


<section style="padding-top:50px;">
          <div class="container">
               <div class="text-center">
                    <h2>Contact Us</h2>

                    <br>

                    <p class="lead">Have a question or ready to book your ride? Our friendly customer support team is here to assist you. Reach out to us via phone or email, and we'll be delighted to help you plan your transportation needs.</p>
               </div>
          </div>
     </section>


     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{Session::get('error')}}
                                    </div>
                        @endif
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">
                            {{Session::get('fail')}}
                            </div>
                        @endif
                    <div class="col-md-6 col-sm-12">
                         <form id="contact-form" role="form" action="{{route('savecontact')}}" method="post">
                             @csrf
                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" placeholder="Enter full name" name="fullname" required>
                                    @if ($errors->has('fullname'))
                                        <div class="text-danger">{{ $errors->first('fullname') }}</div>
                                    @endif
                                   <input type="email" class="form-control" placeholder="Enter email address" name="email" required>
                                    @if ($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                   <textarea class="form-control" rows="6" placeholder="Tell us about your message" name="message" required></textarea>
                                   @if ($errors->has('message'))
                                        <div class="text-danger">{{ $errors->first('message') }}</div>
                                   @endif
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <button type="submit" class="btn btn-info btn-lg" >Submit</button>
                              </div>

                         </form>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="contact-image">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.6116021853077!2d-58.163916825481785!3d6.8170038931806705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8dafef0c2254d201%3A0x1c31e061f3f31a7e!2sRR8Q%2BV93%2C%2091%20Middle%20St%2C%20Georgetown%2C%20Guyana!5e0!3m2!1sen!2sin!4v1693365114318!5m2!1sen!2sin" width="100%" height="270px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
