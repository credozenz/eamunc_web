<!DOCTYPE html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Certificate</title>
            <style>
                body {
                    font-family: Arial, Helvetica, sans-serif;
                }
                #certificate {
                    background: #fff;
                    width: 700px;
                    height: auto;
                    margin: 0px auto;
                    padding: 10px;
                }
                #background {
                    background-image: url(./assets/admin/img/bg.jpg);
                    background-size: cover;
                    width: 100%;
                    height: 494px;
                    position: relative;
                }
                #logo {
                    height: 70px;
                    margin-top: 30px;
                }
                h1 {
                    color: red;
                    text-transform: uppercase;
                    margin-top: 5px;
                    margin-bottom: 0px;
                }
                p {
                    font-size: 17px;
                    margin-top: 5px;
                }
                #underline {
                    width: 75%;
                    display: inline-block;
                    border-bottom: 1px solid #007eff;
                    margin-top: 20px;
                    margin-bottom: 10px;
                }
                span {
                    border-bottom: 1px solid #000;
                    width: 70px;
                    display: inline-block;
                }
                #signatures {
                    position: absolute;
                    width: 800px;
                    height: auto;
                    left: 0;
                    right: 0;
                    bottom: 30px;
                }
                .signature {
                    width: 130px;
                    float: left;
                    text-align: center;
                    margin-left: 80px;
                }
                .signature h6 {
                    margin-bottom: 0px;
                    margin-top: 0px;
                    font-size: 15px;
                }
                .signature p {
                    margin-bottom: 0px;
                    margin-top: 0px;
                    font-size: 12px;
                }
                .underline-signature {
                    display: block;
                    border-bottom: 1px solid #007eff;
                    margin-bottom: 5px;
                }
            </style>
        </head>
        <body>
            <div id="certificate">
                <div id="background">
                    <div style="width: 100%; text-align: center;">
                        <img src="{{ asset("/admin/img/logo.png") }}" id="logo" alt="">
                        <h1>Certificate of participation</h1>
                        <p>The Secretariat proudly recognizes the efforts of</p>
                        <p id="underline"></p>
                        <p>as a delegate from <span></span> Committee, for successfully participating<br/>
                            at The E.Ahamed Model United Nations Conference.<br/>
                            02 - 05 November 2023<br/>
                            Muscat, Sultanate of Oman.</p>
                    </div>
                    <div id="signatures">
                        <div class="signature">
                            <p class="underline-signature"></p>
                            <h6>Papri Ghosh</h6>
                            <p>ISG Principal</p>
                        </div>
                        <div class="signature">
                            <p class="underline-signature"></p>
                            <h6>Ahmed Rayees</h6>
                            <p>Chairman, E.A.MUNC</p>
                        </div>
                        <div class="signature">
                            <p class="underline-signature"></p>
                            <h6>Ahmed Rayees</h6>
                            <p>Chairman, E.A.MUNC</p>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>