@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">Registration for ISG Students</h3>

                    <div class="row mt-5">
                        <img src="assets/img/isg.jpg" alt="">
                    </div>
                    <span class="spacer"></span>

                    <div class="form-container">
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Delegate Name*</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email*</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Class & Section*</label>
                                        <select class="form-control" id="" placeholder="Select">
                                            <option> Select your choice </option>
                                            <option> committee 1</option>
                                            <option> committee 2</option>
                                            <option> committee 3</option>
                                            <option> committee 4</option>
                                            <option> committee 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Committee of Choice*</label>
                                        <select class="form-control" id="" placeholder="Select">
                                            <option> Select your choice </option>
                                            <option> committee 1</option>
                                            <option> committee 2</option>
                                            <option> committee 3</option>
                                            <option> committee 4</option>
                                            <option> committee 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Country of Choice*</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">WhatsApp Number with country code*</label>
                                        <select class="form-control" id="" placeholder="Select">
                                            <option> Select your choice </option>
                                            <option> committee 1</option>
                                            <option> committee 2</option>
                                            <option> committee 3</option>
                                            <option> committee 4</option>
                                            <option> committee 5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">MUN Experience (if any) *</label>
                                        <select class="form-control" id="" placeholder="Select">
                                            <option> Select your choice </option>
                                            <option> committee 1</option>
                                            <option> committee 2</option>
                                            <option> committee 3</option>
                                            <option> committee 4</option>
                                            <option> committee 5</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="download-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <span class="spacer"></span>

                </div>
            </div>

        </div>
    </section>
    @endsection