<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FarmFresh - Organic Farm Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .not-logged-in {
            position: relative;
        }

        .not-logged-in>* {
            filter: blur(5px);
            /* Blur only the background content */
            pointer-events: none;
        }

        .not-logged-in::after {
            content: "Please log in to view and comment";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px 25px;
            border-radius: 10px;
            text-align: center;
            white-space: nowrap;
        }

        .not-logged-in .login-btn {
            position: absolute;
            top: calc(50% + 60px);
            /* Position below the message */
            left: 50%;
            transform: translate(-50%, 0);
            z-index: 10;
            background-color: #ff5722;
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
        }

        .not-logged-in .login-btn:hover {
            background-color: #e64a19;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none d-lg-block">
        <div class="row gx-5 py-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-start">
                    <a href="/" class="navbar-brand ms-lg-5">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Farm</span>Fresh</h1>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-end">
                    <a class="btn btn-primary me-2" href="/login">Login</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="index.html" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Farm</span>Fresh</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="/" class="nav-item nav-link">Home</a>
                <a href="{{ route('komunitas.all') }}" class="nav-item nav-link {{ (request()->is('komunitas/*')) ? 'active' : '' }}">Komunitas</a>
                <a href="{{ route('rekomendasi.user') }}" class="nav-item nav-link {{ (request()->is('rekomendasi/*')) ? 'active' : '' }}">Rekomendasi Pelayanan</a>
                <a href="{{ route('panduan.user') }}" class="nav-item nav-link {{ (request()->is('panduan/*')) ? 'active' : '' }}">Panduan</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="mb-5">
                    <div class="row g-5 mb-5">
                        <div class="col-md-6">
                            <img class="img-fluid w-100" src="img/blog-1.jpg" alt="">
                        </div>
                        <div class="col-md-6">
                            <img class="img-fluid w-100" src="img/blog-2.jpg" alt="">
                        </div>
                    </div>
                    <h1 class="mb-4">{{ $show->nama_komunitas }}</h1>

                    @if (Auth::check())
                        @if ($show->members->contains($user))
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                <input type="submit" class="btn btn-success" value="Joined">
                            </form>
                        @else
                            <form action="{{ route('komunitas.join', $show->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                <input type="submit" class="btn btn-outline-success" value="Join">
                            </form>
                        @endif
                    @endif

                    <div style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: break-word;">
                        <p>{{ $show->deskripsi_komunitas }}</p>
                    </div>
                </div>
                <!-- Blog Detail End -->

                <!-- not logged in -->
                <div class="{{ !Auth::check() ? 'not-logged-in' : '' }}">
                    <!-- Comment List Start -->
                    <div class="mb-5">
                        <h2 class="mb-4">{{ $countComment }} Comments</h2>
                        @forelse ($show->comments as $comment)
                            <div class="d-flex mb-4">
                                <img src="https://placehold.co/100" class="img-fluid"
                                    style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6><a href="">{{ $comment->user->name }}</a>
                                        <small><i>{{ $comment->created_at }}</i></small>
                                    </h6>
                                    <p>{{ $comment->isi_komentar }}</p>
                                    <button class="btn btn-sm btn-primary">Reply</button>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">---- No Comment yet ----</p>
                        @endforelse
                    </div>
                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <div class="bg-primary p-5">
                        <h2 class="text-white mb-4">Leave a comment</h2>
                        <form>
                            @if (!Auth::check())
                                <div class="row g-3">
                                    <h3 class="text-white text-center">---- Login to comment ----</h3>
                                </div>
                            @else
                                <form action="" method="post">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <textarea class="form-control bg-white border-0" rows="5" placeholder="Comment"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-secondary w-100 py-3" type="submit">Leave Your
                                                Comment</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </form>
                    </div>
                    <!-- Comment Form End -->
                </div>

                <!-- not logged in -->

            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-primary p-4">
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i
                                class="bi bi-arrow-right me-2"></i>Web Design</a>
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i
                                class="bi bi-arrow-right me-2"></i>Web Development</a>
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i
                                class="bi bi-arrow-right me-2"></i>Web Development</a>
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i
                                class="bi bi-arrow-right me-2"></i>Keyword Research</a>
                        <a class="fs-5 fw-bold text-white" href="#"><i class="bi bi-arrow-right me-2"></i>Email
                            Marketing</a>
                    </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>
                    <div class="bg-primary p-4">
                        <div class="d-flex overflow-hidden mb-3">
                            <img class="img-fluid flex-shrink-0" src="img/blog-1.jpg" style="width: 75px;"
                                alt="">
                            <a href=""
                                class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Lorem ipsum
                                dolor sit amet elit
                            </a>
                        </div>
                        <div class="d-flex overflow-hidden mb-3">
                            <img class="img-fluid flex-shrink-0" src="img/blog-2.jpg" style="width: 75px;"
                                alt="">
                            <a href=""
                                class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Lorem ipsum
                                dolor sit amet elit
                            </a>
                        </div>
                        <div class="d-flex overflow-hidden mb-3">
                            <img class="img-fluid flex-shrink-0" src="img/blog-3.jpg" style="width: 75px;"
                                alt="">
                            <a href=""
                                class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Lorem ipsum
                                dolor sit amet elit
                            </a>
                        </div>
                        <div class="d-flex overflow-hidden mb-3">
                            <img class="img-fluid flex-shrink-0" src="img/blog-1.jpg" style="width: 75px;"
                                alt="">
                            <a href=""
                                class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Lorem ipsum
                                dolor sit amet elit
                            </a>
                        </div>
                        <div class="d-flex overflow-hidden">
                            <img class="img-fluid flex-shrink-0" src="img/blog-2.jpg" style="width: 75px;"
                                alt="">
                            <a href=""
                                class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Lorem ipsum
                                dolor sit amet elit
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Recent Post End -->

                <!-- Image Start -->
                <div class="mb-5">
                    <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
                </div>
                <!-- Image End -->

                <!-- Tags Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Tag Cloud</h2>
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-primary m-1">Design</a>
                        <a href="" class="btn btn-primary m-1">Development</a>
                        <a href="" class="btn btn-primary m-1">Marketing</a>
                        <a href="" class="btn btn-primary m-1">SEO</a>
                        <a href="" class="btn btn-primary m-1">Writing</a>
                        <a href="" class="btn btn-primary m-1">Consulting</a>
                        <a href="" class="btn btn-primary m-1">Design</a>
                        <a href="" class="btn btn-primary m-1">Development</a>
                        <a href="" class="btn btn-primary m-1">Marketing</a>
                        <a href="" class="btn btn-primary m-1">SEO</a>
                        <a href="" class="btn btn-primary m-1">Writing</a>
                        <a href="" class="btn btn-primary m-1">Consulting</a>
                    </div>
                </div>
                <!-- Tags End -->

                <!-- Plain Text Start -->
                <div>
                    <h2 class="mb-4">Plain Text</h2>
                    <div class="bg-primary text-center text-white" style="padding: 30px;">
                        <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita
                            kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet
                            diam</p>
                        <a href="" class="btn btn-secondary py-2 px-4">Read More</a>
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                       
                        <div class="col-lg col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="#"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="/"><i
                                        class="bi bi-arrow-right text-white me-2"></i>About Us</a>
                                <a class="text-white mb-2" href="#"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Komunitas</a>
                                <a class="text-white mb-2" href="{{ route('komunitas.all') }}"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Rekomendasi Pelayanan</a>
                                <a class="text-white mb-2" href="#"><i
                                        class="bi bi-arrow-right text-white me-2"></i>Panduan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-lg-n5">
                    <div
                        class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-secondary p-5">
                        <h4 class="text-white">Newsletter</h4>
                        <h6 class="text-white">Subscribe Our Newsletter</h6>
                        <p>Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">FarmFresh</a>. All Rights
                Reserved. Designed by <a class="text-secondary fw-bold" href="https://htmlcodex.com">HTML Codex</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
