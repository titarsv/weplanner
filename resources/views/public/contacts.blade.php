@extends('public.layouts.main', ['partition' => 'contacts', 'wrapper_class' => 'contacts-page'])
@section('meta')
    <title>Контакты Weplanner</title>
    <meta name="description" content="Контакты Weplanner">
@endsection

@section('content')
    <section class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2564.29709497923!2d36.23446391571533!3d50.00578647941652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a0de6da556e3%3A0xd35868884dfd4986!2z0LLRg9C70LjRhtGPINCh0YPQvNGB0YzQutCwLCA3Miwg0KXQsNGA0LrRltCyLCDQpdCw0YDQutGW0LLRgdGM0LrQsCDQvtCx0LvQsNGB0YLRjCwgNjEwMDA!5e0!3m2!1sru!2sua!4v1475833593887" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
    <section class="contacts">
        <div class="container-custom">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-block">
                        <div class="icon-block ">
                            <span class="addres"></span>
                        </div>
                        <div class="contact">
                            <h3>Our Address</h3>
                            <p>Kharkiv, Ukraine</p>
                            <p>Sumska str., 72</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-block">
                        <div class="icon-block">
                            <span class="tel"></span>
                        </div>
                        <div class="contact">
                            <h3>Our Address</h3>
                            <p>Office: +38 (057) 123-45-67</p>
                            <p>Mob.: +38 (095) 765-43-21</p>
                            <p>Mob.: +38 (067) 543-12-76</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-block">
                        <div class="icon-block">
                            <span class="online"></span>
                        </div>
                        <div class="contact">
                            <h3>Connect Online</h3>
                            <p>Email: <a href="mailto:hello@weplaner.com">hello@weplaner.com</a></p>
                            <ul class="social black">
                                <li><a class="fb" href="#"></a></li>
                                <li><a class="vk" href="#"></a></li>
                                <li><a class="in" href="#"></a></li>
                                <li><a class="insta" href="#"></a></li>
                                <li><a class="pt" href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="write-us">
        <h2>Drop us a line just now</h2>
        <div class="section-desc">You can write ypu letter for <b>Wedding</b> <span>&amp;</span> <b>Event</b> by form below.</div>
        <form action="" method="post">
            <div class="row p-bot">
                <div class="col-md-12">
                    <input class="op-place name" type="text" placeholder="Your Name" name="name">
                </div>
            </div>
            <div class="row p-bot">
                <div class="col-md-6">
                    <input class="op-place email" type="text" placeholder="Email Address" name="email">
                </div>
                <div class="col-md-6">
                    <input class="op-place phone" type="text" placeholder="Phone Number" name="phone">
                </div>
            </div>
            <div class="row p-bot">
                <div class="col-md-12">
                    <textarea placeholder="Your Message" name="message"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="send" type="submit">Send Message</button>
                </div>
            </div>
        </form>
    </section>
@endsection