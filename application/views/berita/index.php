        <div class="container mt-5">
            <div class="row">
                <!-- Masthead-->
                <section class="page-section bg-light" id="artikel">
                    <div class="title my-3 mt-3">
                         <h3 class="">Pembangunan Trotoar</h3>
                         <i class="far fa-calendar"> </i> 15 Oktober 2021
                    </div>
                    <div class="news-img">
                         <img class="img-fluid my-2" width="400px" src="assets/img/artikel/Picture1.jpg" alt="..." />
                    </div>
                    <div class="news-detail my-3">
                         <p >Warga kp. kudangsari rt:2 rw:1 sedang bergotong royong membuat trotor dipinggir jalan untuk pejalan kaki, pada tanggal 13 september 2018 kami menerima bantuan dari pemerintah untuk membuat trotor di pinggir jalan buat pejalan kaki</p>
                    </div>
                    <div class="col-lg-4 my-3 my-lg-0 share-section">
                        <p class="section-subheading text-muted">Share:
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-whatsapp"></i></a></p>
                    </div>
                    <div class="text-center">
                        <h2 class="section-heading text-uppercase">"KOMENTAR"</h2>
                        <h3 class="section-subheading text-muted">Berikan Komentar
                        </h3>
                    </div>
                    <form id="komentarForm" data-sb-form-api-token="API_TOKEN">
                        <div class="row align-items-stretch mb-5">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <!-- Name input-->
                                    <input class="form-control" id="name" type="text" placeholder="Nama lengkap"
                                        data-sb-validations="required" />
                                    <div class="invalid-feedback" data-sb-feedback="name:required">Kolom nama harus diisi.</div>
                                </div>
                                <div class="form-group mb-3">
                                    <!-- Email address input-->
                                    <input class="form-control" id="email" type="email" placeholder="Email"
                                        data-sb-validations="required,email" />
                                    <div class="invalid-feedback" data-sb-feedback="email:required">Kolom Email harus diisi.</div>
                                    <div class="invalid-feedback" data-sb-feedback="email:email">Email harus valid.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-textarea mb-md-0">
                                    <!-- Message input-->
                                    <textarea class="form-control" rows="4" id="message" placeholder="Komentar"
                                        data-sb-validations="required"></textarea>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">Kolom komentar harus diisi.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center text-white mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a
                                    href="https://startbootstrap.com/solution/komentar-forms">https://startbootstrap.com/solution/komentar-forms</a>
                            </div>
                        </div>
                        <div class="d-none" id="submitErrorMessage">
                            <div class="text-center text-danger mb-3">Error sending message!</div>
                        </div>
                        <!-- Submit Button-->
                        <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled"
                                id="submitButton" type="submit">kirim</button></div>
                    </form>
                </section>
            </div>
        </div>