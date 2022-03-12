@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">Feedback Form</h3>

                    <span class="blue-block"></span>

                    <div class="form-container">
                        <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Delegate Name*</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Email*</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Committee*</label>
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
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Country Represented*</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Committee*</label>
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
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Do you plan to attend this conference in the future? *</label>
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
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">How would you grade this conference from the scale of 1 to 10
                                            *</label>
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
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">How satisfied are you with the quality of networking opportunities
                                            at EAMUNC *</label>
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
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">How likely are you to recommend this conference to your peers?
                                            *</label>
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
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">How would you grade your bureau members? *</label>
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

                                <div class="col-12">
                                    <span class="spacer"></span>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">How can we improve for next year? *</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">What did you like the most about E.A.MUNC? *</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Which topics would you like to explore in future sessions?
                                            *</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">How did the conference influence your perception about MUNC?
                                            *</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">What were your favorite experiences or moments at this conference?
                                            *</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Do you have any other suggestions or feedback that you would like
                                            to share? *</label>
                                        <input type="text" class="form-control" id="" aria-describedby="textHelp"
                                            placeholder="Your Answer">
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