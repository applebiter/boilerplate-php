<?php 
$session = $this->request->getSession();
$authUser = null;

if ($session->check('Auth.User'))
{
    $authUser = $session->read('Auth.User');
}
?>

<header class="bg-primary py-5 rounded">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">
                        A boilerplate CakePHP 4 and Qt 6 hybrid application stack.
                    </h1>
                    <p class="lead fw-normal text-white-50 mb-4">
                        Integrated user management with fully interoperable cryptographic 
                        functionality based on libsodium.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">
                            Get Started
                        </a>
                        <a class="btn btn-outline-light btn-lg px-4" href="#!">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                <img class="img-fluid rounded-3 my-5" src="https://dummyimage.com/600x400/aaaaaa/333333" alt="..." />
            </div>
        </div>
    </div>
</header>
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0">The boilerplate code no one asked for.</h2>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <div class="col mb-5 h-100">
                        <h2 class="h5 text-primary">
                            <i class="bi bi-code-square me-2"></i>
                            Free and Open Source
                        </h2>
                        <p class="mb-0">
                            Because I am cheap.
                        </p>
                    </div>
                    <div class="col mb-5 h-100">
                        <h2 class="h5 text-primary">
                            <i class="bi bi-gear-wide-connected me-2"></i>
                            Hybrid Applications
                        </h2>
                        <p class="mb-0">
                            Because web browsers have limitations.
                        </p>
                    </div>
                    <div class="col mb-5 h-100">
                        <h2 class="h5 text-primary">
                            <i class="bi bi-people me-2"></i>
                            User Management
                        </h2>
                        <p class="mb-0">
                            Optional self-registration, password recovery, etc.
                        </p>
                    </div>
                    <div class="col mb-5 h-100">
                        <h2 class="h5 text-primary">
                            <i class="bi bi-tags me-2"></i>
                            Media Management
                        </h2>
                        <p class="mb-0">
                            Upload, download, tag, play, etc.
                        </p>
                    </div>
                    <div class="col mb-5 h-100">
                        <h2 class="h5 text-primary">
                            <i class="bi bi-chat-quote me-2"></i>
                            Community-Building Tools
                        </h2>
                        <p class="mb-0">
                            Whether your community is an open one or a private one.
                        </p>
                    </div>
                    <div class="col mb-5 h-100">
                        <h2 class="h5 text-primary">
                            <i class="bi bi-book me-2"></i>
                            Documentation
                        </h2>
                        <p class="mb-0">
                            Because I will forget how to use it if I don't write it all down.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="py-5 bg-default">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-10 col-xl-7">
                <div class="text-center">
                    <div class="fs-4 mb-4 fst-italic">
                        "If I have to build another user management system from scratch, I'm going to pluck my own 
                        eyes out."
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                        <div class="fw-bold">
                            Me
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>