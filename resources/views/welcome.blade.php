@extends('layouts.master')

@section('content')
<div class="container-fluid mb-4">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            {{-- <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> --}}
        </ol>
        <div class="carousel-inner rounded-lg">
            <div class="carousel-item active">
                {{-- <img class="img-fluid" src="https://via.placeholder.com/1440x480.png" alt="First slide"> --}}
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                    <rect width="100%" height="100%" fill="#777"></rect>
                </svg>
                <div class="container">
                    <div class="carousel-caption text-center">
                        <h1 class="text-uppercase">Embirrados</h1>
                        <p>Embirrados es un juego superadictivo de preguntas y respuestas donde el tiempo vuela y tus
                            ganas de competir no se detienen! No lo dudes más y comenzá a jugar ya mismo.</p>
                        <p>
                            <a class="btn btn-warning btn-lg" href="/juego" role="button">¡Quiero Jugar!</a>
                            <a class="btn btn-outline-secondary bg-white btn-lg" href="/register" role="button">Registrarme</a>
                        </p>
                    </div>
                </div>
            </div>
            {{-- <div class="carousel-item">
                <img class="img-fluid h-100" src="https://via.placeholder.com/1440x480.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="https://via.placeholder.com/1440x480.png" alt="Third slide">
            </div> --}}
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- SECTION: IR A JUGAR -->
    <section class="mt-4" id="jugar">
        <div class="container">
            <div class="col">
                <div class="row">
                    <h1>¡Comienza a jugar a Embirrados!</h1>
                    <p>Embirrados es un juego superadictivo de preguntas y respuestas donde el tiempo vuela y tus ganas
                        de competir no se detienen! No lo dudes más y comenzá a jugar ya mismo.</p>
                </div>
                <div class="row">
                    <p><a class="btn btn-warning btn-lg" href="/juego" role="button">
                            Quiero Jugar!</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: CONTACTO -->
    <section class="mt-4" id="contacto">
        <div class="container">
            <h2>Contactate con nosotros</h2>
            <form>
                <label for="inputNombre" class="sr-only">Nombre</label>
                <input type="text" id="inputEmail" class="form-control mb-3" placeholder="Nombre completo" required>

                <label for="inputEmail" class="sr-only">Correo electrónico</label>
                <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Correo electrónico" required>

                <label for="inputAsunto" class="sr-only">Asunto</label>
                <input type="text" id="inputAsunto" class="form-control mb-3" placeholder="Asunto" required>

                <label for="inputMensaje" class="sr-only">Mensaje</label>
                <textarea name="mensaje" class="form-control mb-3" id="inputMensaje" cols="30" rows="5"
                    placeholder="Escribe tu mensaje aquí..." required></textarea>

                <br>
                <button class="btn btn-warning btn-lg" type="submit">Enviar</button>

            </form>
        </div>
    </section>
    @endsection
