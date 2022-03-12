@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <h3 class="color-darkblue mb-4">EAMUNC 2022</h3>

                    <div class="row mt-5">
                        <img src="assets/img/past.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="letter-container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                                <p>
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                    print, graphic or web designs. The passage is attributed to an unknown typesetter in
                                    the 15th century who is thought to have
                                    scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen
                                    book. It usually begins with:
                                </p>
                                <p>
                                    “Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.”
                                    The purpose of lorem ipsum is to create a natural looking block of text (sentence,
                                    paragraph, page, etc.) that doesn't distract from the layout. A practice not without
                                    controversy, laying out pages with meaningless
                                    filler text can be very useful when the focus is meant to be on design, not content.
                                </p>
                                <p>
                                    The passage experienced a surge in popularity during the 1960s when Letraset used it
                                    on their dry-transfer sheets, and again during the 90s as desktop publishers bundled
                                    the text with their software. Today it's
                                    seen all around the web; on templates, websites, and stock designs. Use our
                                    generator to get your own, or read on for the authoritative history of lorem ipsum.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="updates" class="section-padding pb-0">
        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">EAMUNC In Action</h3>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-4 image-box mb-3 fixed-thumb">
                    <img src="assets/img/action/1.jpg" alt="">
                </div>

                <div class="col-md-4 image-box mb-3 fixed-thumb">
                    <img src="assets/img/action/2.jpg" alt="">
                </div>

                <div class="col-md-4 image-box mb-3 fixed-thumb">
                    <img src="assets/img/action/3.jpg" alt="">
                </div>
                <div class="col-12 text-end">
                    <a href="#" class="more-button">See More</a>
                </div>

            </div>
        </div>

    </section>


    <section id="regulations" class="section-padding">
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Resolutions of EAMUNC 2022</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <button class="download-btn">Download Now</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    @endsection