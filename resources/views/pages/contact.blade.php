@extends("layouts.front")
@section('title')
    Kontakt
@endsection



@section('content')
    <!-- Page Content -->
    <div id="contact">
        <div class="container">
            @if(session()->has('successEmail'))
                <div class="alertEmail">
                    <div class="container">
                        <div class="row">
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{session()->get('successEmail')}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        <!-- Page Heading/Breadcrumbs -->
        <!-- Contact Form -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <h3>Kontakt forma</h3>
                    <form name="sentMessage" id="contactForm"  action="{{ route('kontaktPosalji') }}" method="post" >
                        {{csrf_field()}}
                        <div class="control-group form-group ">
                            <div class="controls">
                                <label for="name">Ime i prezime:</label>
                                <input type="text" class="form-control" id="name" name="name" >
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" >
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label for="headline">Naslov:</label>
                                <input type="text" class="form-control" id="headline" name="headline" >
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label for="message">Poruka:</label>
                                <textarea rows="10" cols="100" class="form-control" id="message" name="message" maxlength="999" style="resize:none"></textarea>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-primary" id="sendMessageButton">Pošaljite</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <!-- /.container -->
    </div>
@endsection
